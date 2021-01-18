<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('index');
Route::get('/contact-us', 'MailController@index')->name('contact');
Route::get('/faqs', 'HomeController@faqs')->name('faqs');

Route::get('test-cart/{id}', function ($id) {
    $cart = session()->get('cart');
    foreach($cart as $product) {
        $product = \App\Models\Product::find($product['id'])->decrement('stock', 1);
    }
});

Route::group(['prefix' => 'products'], function () {
    Route::get('/', 'ProductsController@index')->name('products.index');
    Route::get('/{slug}', 'ProductsController@show')->name('products.single');
});

Route::group(['prefix' => 'cart'], function () {
    Route::get('/', 'CartController@index')->name('cart.index');
    Route::post('/{id}/add', 'CartController@add')->name('cart.add');
    Route::patch('update', 'CartController@update')->name('cart.update');
    Route::delete('remove', 'CartController@remove')->name('cart.remove');
});

Route::get('/search', 'SearchController@index')->name('search');

//Send mail
Route::post('/mail', 'MailController@sendMail')->name('send-mail');

//social logins
Route::group(['prefix' => 'social'], function () {
    //Social auth routes
    Route::get('/login/{provider}', 'SocialController@redirect')->name('social.login');
    Route::get('/{provider}/callback','SocialController@callback')->where('provider', '.*')->name('social.callback');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/orders', 'HomeController@orders')->name('orders');
});

Route::group(['middleware' => ['auth', 'is_admin']], function () {
    Route::group(['prefix' => 'administration'], function () {
        Route::get('/', 'AdminController@index')->name('admin.index');
        Route::any('/product/add', 'AdminController@productCreate')->name('admin.products.create');
        Route::any('/products/{slug}/edit', 'AdminController@productEdit')->name('admin.products.edit');
        Route::post('/products/{id}/delete', 'AdminController@productDestroy')->name('admin.products.destroy');

        Route::get('/invoices/{id}/orders', 'AdminController@invoiceOrders')->name('admin.invoiceOrders');
        Route::get('/invoices', 'AdminController@invoices')->name('admin.invoices');
        Route::post('/update-invoice', 'AdminController@updateInvoice')->name('admin.update_invoice');

        //Users
        Route::get('/users', 'AdminController@users')->name('admin.users.index');
    });
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/checkout', 'PaymentController@checkout')->name('checkout');

    Route::group(['prefix' => 'payment'], function () {
        Route::post('/place-order', 'PaymentController@placeOrder')->name('payment.place-order');

        //Braintree
        Route::post('/braintree', 'PaymentController@braintree')->name('payment.braintree');

        //Paypal
        Route::post('/paypal', 'PaymentController@paypal')->name('payment.paypal');
    });
});