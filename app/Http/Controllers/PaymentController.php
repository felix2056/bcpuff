<?php

namespace App\Http\Controllers;

use App\Helper\Helper;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use App\Models\Order;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\User;

class PaymentController extends Controller
{
    public function placeOrder(Request $request)
    {
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'city' => 'required',
            'province' => 'required',
            'address' => 'required',
            'postal_code' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Be sure to fill up all required fields!')->withErrors($validator)->withInput();
        }

        $user = User::find(Auth::user()->id);
        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        $all_orders = [];
        $total = 0;

        $invoice = new Invoice();
        $invoice->user_id = $user->id;
        $invoice->status = 'pending';
        $invoice->due_date = Carbon::now()->addDays(1)->format('Y-m-d H:i:s');

        $invoice->first_name = $request->get('first_name');
        $invoice->last_name = $request->get('last_name');
        $invoice->city = $request->get('city');
        $invoice->province = $request->get('province');
        $invoice->address = $request->get('address');
        $invoice->postal_code = $request->get('postal_code');

        $invoice->save();

        if ($invoice) {
            foreach($cart as $product) {
                $total += $product['price'] * $product['quantity'];
    
                $order = new Order();
                $order->user_id = $user->id;
                $order->invoice_id = $invoice->id;
                $order->product = $product['name'];
                $order->photo = $product['photo'];
                $order->qty = $product['quantity'];
                $order->price = $product['price'];
                $order->total = $product['price'] * $product['quantity'];
                $order->status = 'pending';
    
                $order->save();
                array_push($all_orders, $order);
            }

            $shipping = 10;
            $percent = 12;
            $tax = Helper::calculateTax($percent, $total);

            $overallTotal = $total + $shipping + $tax;

            $update_invoice = Invoice::find($invoice->id);
            $update_invoice->total = $overallTotal;
            $update_invoice->save();

            //  Send mail to admin
            Mail::send('emails.sendOrderConfirmation', array(
                'name' => $user->name,
                'orders' => $all_orders,
                'total' => $total,
                'recipent_name' => 'bcorders',
                'recipent_email' => 'bcorders100@gmail.com',
                'question' => 'Best Song',
                'answer' => 'ShookOnes'
            ), function($message) use ($user){
                $message->from('order-confirmation@bcpuff.com');
                $message->to($user->email, $user->name)->subject('Complete Your Order!');
            });

            //  Send mail to admin
            // Mail::send('emails.sendPurchaseNotify', array(
            //     'name' => $user->name,
            //     'order_id' => $order->id,
            //     'product' => $order->product,
            //     'quantity' => $order->qty,
            //     'total' => $overallTotal
            // ), function($message) use ($request){
            //     $message->from('order-confirmation@bcpuff.com');
            //     $message->to('bcorders100@gmail.com', 'BCPuff')->subject('Someone Purchased A Product!');
            // });
            
            foreach($cart as $product) {
                $product = Product::find($product['id'])->decrement('stock', 1);
            }

            session()->forget('cart');

            session()->flash('success', 'Payment has been made successfully');

            return view('thankyou');
        }
    }

    public function checkout()
    {
        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        return view('checkout');

        // $gateway = new \Braintree\Gateway([
        //     'environment' => env('BRAINTREE_ENVIRONMENT'),
        //     'merchantId' => env("BRAINTREE_MERCHANT_ID"),
        //     'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
        //     'privateKey' => env("BRAINTREE_PRIVATE_KEY")
        // ]);
        
        // $clientToken = $gateway->clientToken()->generate();
        // return view('checkout', ['token' => $clientToken]);
    }

    // public function braintree(Request $request)
    // {
    //     $gateway = new \Braintree\Gateway([
    //         'environment' => env('BRAINTREE_ENVIRONMENT'),
    //         'merchantId' => env("BRAINTREE_MERCHANT_ID"),
    //         'publicKey' => env("BRAINTREE_PUBLIC_KEY"),
    //         'privateKey' => env("BRAINTREE_PRIVATE_KEY")
    //     ]);

    //     $user = User::find(Auth::user()->id);

    //     if($request->input('nonce') != null){
    //         var_dump($request->input('nonce'));

    //         $cart = session()->get('cart');

    //         // if cart is empty then this the first product
    //         if(!$cart) {
    //             return session()->flash('error', 'Your cart is empty!');
    //         }

    //         $nonceFromTheClient = $request->input('nonce');
    //         $total = $request->input('total');
        
    //         $paid = $gateway->transaction()->sale([
    //             'amount' => $total . '.00',
    //             'paymentMethodNonce' => $nonceFromTheClient,
    //             'options' => [
    //                 'submitForSettlement' => True
    //             ]
    //         ]);

    //         if ($paid) {
    //             $receipt = new Receipt();
    //             $receipt->user_id = $user->id;
    //             $receipt->agent = 'Braintree Debit Card';
    //             $receipt->status = 'Paid';
    //             $receipt->tax = 5;
    //             $receipt->total = $total;

    //             $receipt->save();

    //             if (!$receipt) {
    //                 return session()->flash('error', 'Something Went Wrong!');
    //             }

    //             foreach($cart as $product) {
    //                 $order = new Order();
    //                 $order->user_id = $user->id;
    //                 $order->receipt_id = $receipt->id;
    //                 $order->product = $product['name'];
    //                 $order->photo = $product['photo'];
    //                 $order->qty = $product['quantity'];
    //                 $order->status = 'paid';

    //                 $order->save();
    //             }

    //             session()->forget('cart');
    //             return session()->flash('success', 'Payment has been made successfully');
    //         }
    //     }
    // }

    public function paypal(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $cart = session()->get('cart');

        // if cart is empty then this the first product
        if(!$cart) {
            return session()->flash('error', 'Your cart is empty!');
        }

        $total = 0;

        foreach($cart as $product) {
            $total += $product['price'] * $product['quantity'];

            $order = new Order();
            $order->user_id = $user->id;
            $order->product = $product['name'];
            $order->photo = $product['photo'];
            $order->qty = $product['quantity'];
            $order->status = 'paid';

            $order->save();
        }

        $shipping = 10;
        $percent = 12;
        $tax = Helper::calculateTax($percent, $total);

        $overallTotal = $total + $shipping + $tax;

        session()->forget('cart');

        //  Send mail to admin
        Mail::send('emails.sendPurchaseNotify', array(
            'name' => $user->name,
            'order_id' => $order->id,
            'product' => $order->product,
            'quantity' => $order->qty,
            'total' => $overallTotal
        ), function($message) use ($request){
            $message->from('order-confirmation@bcpuff.com');
            $message->to('bcorders100@gmail.com', 'BCPuff')->subject('Someone Purchased A Product!');
        });

        return session()->flash('success', 'Payment has been made successfully');   
    }
}
