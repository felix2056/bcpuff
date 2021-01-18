<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $data = array();

        $data['total_products'] = Product::count();
        $data['total_users'] = User::count();
        $data['total_admins'] = User::where('type', User::ADMIN_TYPE)->count();
        $data['total_orders'] = Order::count();

        return view('admin.index', compact('data'));
    }

    public function products()
    {
        $products = Product::get();
        return view('admin.products.index', compact('products'));
    }

    public function productSingle($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return abort(404);
        }

        return view('admin.products.single', compact('product'));
    }

    public function productCreate(Request $request)
    {
        if ($request->isMethod('post')) {
            $rules = [
                'name' => 'required|min:5|max:1000',
                'description' => 'required|min:5',
                'price' => 'required|numeric',
                'stock' => 'required|numeric',
                'image' => 'max:2048'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Be sure to fill up all required fields!')->withErrors($validator)->withInput();
            }

            $user = User::find(Auth::user()->id);

            $data = [
                'name' => $request->name,
                'price' => $request->price,
                'stock' => $request->stock,
                'description' => $request->description,
                'slug' => Str::slug($request->name, '-')
            ];
            

            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $imagename = 'product' . '_' . time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('public/products/', $imagename);

                if ($path) {
                    $data['image'] = $imagename;
                }
            }

            $product = $user->products()->create($data);

            return redirect()->route('products.index')->with('success', 'Successfully Added New Product: ' . $product->name);
        }

        return view('products.add');
    }

    public function productEdit(Request $request, $slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return abort(404);
        }
        
        if ($request->isMethod('post')) {
            $rules = [
                'name' => 'required|min:5|max:1000',
                'description' => 'required|min:5',
                'price' => 'required|numeric',
                'stock' => 'required|numeric',
                'image' => 'max:2048'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Be sure to fill up all required fields!')->withErrors($validator)->withInput();
            }

            $user = User::find(Auth::user()->id);

            $product->name = $request->name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->description = $request->description;
            $product->slug = Str::slug($request->name, '-');
            

            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $exists = Storage::exists('products/'. $product->image);

                if ($exists) {
                    Storage::delete('products/'. $product->image);
                }

                $imagename = 'product' . '_' . time() . '_' . $image->getClientOriginalName();
                $path = $image->storeAs('public/products/', $imagename);

                if ($path) {
                    $product->image = $imagename;
                }
            }

            $product->save();
            return redirect()->route('products.single', ['slug' => $product->slug])->with('success', 'Successfully Edited Product: ' . $product->name);
        }

        return view('products.edit', compact('product'));
    }

    public function productDestroy(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'This product does not exist!');
        }

        if (!empty($product->image)) {
            $image_exists = Storage::exists('public/products/' . $product->image);
    
            if ($image_exists) {
              Storage::delete('public/products/' . $product->image);
            }
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product has been deleted!');
    }

    public function users()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function invoices()
    {
        $invoices = Invoice::all();

        $data['total_invoice'] = Invoice::count();
        $data['paid_invoice'] = Invoice::where('status', 'paid')->count();
        $data['pending_invoice'] = Invoice::where('status', 'pending')->count();
        $data['delivered_invoice'] = Invoice::where('status', 'delivered')->count();
        $data['cancelled_invoice'] = Invoice::where('status', 'cancelled')->count();

        return view('admin.invoices', compact('invoices', 'data'));
    }

    public function invoiceOrders($id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return abort(404);
        }

        $orders = $invoice->orders()->get();
        return view('admin.invoiceOrders', compact('invoice', 'orders'));
    }

    public function updateInvoice(Request $request)
    {
        $invoice = Invoice::find($request->invoice_id);

        if (!$invoice) {
            return response('Invoice Does Not Exist!', 404);
        }

        $status = $request->invoice_status;

        switch ($status) {
            case 'pending':
                $status = 'pending';
                break;

            case 'paid':
                $status = 'paid';
                break;

            case 'delivered':
                $status = 'delivered';
                break;

            case 'cancelled':
                $status = 'cancelled';
                break;
            
            default:
                $status = 'pending';
                break;
        }

        $invoice->status = $status;
        $invoice->save();

        //$this->sendMail($invoice, $status);

        return response('Successfully updated status of invoice BCP-2020-' . $invoice->id . ' to ' . $invoice->status . ', Member: ' . $invoice->user->name . ' will receive a follow up email!');
    }

    protected function sendMail($invoice, $status)
    {
        $user = User::find($invoice->user->id);

        switch ($status) {
            case 'paid':
                Mail::send('emails.sendOrderPaid', array(
                    'name' => $user->name,
                    'order_id' => $invoice->id,
                    'order_status' => $status,
                    'order_due_date' => $invoice->due_date,
                    'order_total' => $invoice->total
                ), function($message) use ($user){
                    $message->from('order-confirmation@bcpuff.com');
                    $message->to($user->email, $user->name)->subject('Your Order Is Processing!');
                });

                break;

            case 'delivered':
                Mail::send('emails.sendOrderDelivered', array(
                    'name' => $user->name,
                    'order_id' => $invoice->id,
                    'order_status' => $status,
                    'order_due_date' => $invoice->due_date,
                    'order_total' => $invoice->total
                ), function($message) use ($user){
                    $message->from('order-confirmation@bcpuff.com');
                    $message->to($user->email, $user->name)->subject('Your Order Has Been Delivered! Thank You');
                });
    
                break;

            case 'cancelled':
                Mail::send('emails.sendOrderCancelled', array(
                    'name' => $user->name,
                    'order_id' => $invoice->id,
                    'order_status' => $status,
                    'order_due_date' => $invoice->due_date,
                    'order_total' => $invoice->total
                ), function($message) use ($user){
                    $message->from('order-confirmation@bcpuff.com');
                    $message->to($user->email, $user->name)->subject('Your Order Was Cancelled!');
                });
    
                break;
        }
    }
}
