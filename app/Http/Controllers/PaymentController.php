<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\Order;
use App\Models\Receipt;
use App\Models\User;

class PaymentController extends Controller
{
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

        foreach($cart as $product) {
            $order = new Order();
            $order->user_id = $user->id;
            $order->product = $product['name'];
            $order->photo = $product['photo'];
            $order->qty = $product['quantity'];
            $order->status = 'paid';

            $order->save();
        }

        session()->forget('cart');

        //  Send mail to admin
        Mail::send('emails.sendPurchaseNotify', array(
            'name' => $user->name,
            'order_id' => $order->id,
            'product' => $order->product,
            'quantity' => $order->qty,
        ), function($message) use ($request){
            $message->from('order-confirmation@bcpuff.com');
            $message->to('bcpuff.co@gmail.com', 'BCPuff')->subject('Someone Purchased A Product!');
        });

        return session()->flash('success', 'Payment has been made successfully');   
    }
}
