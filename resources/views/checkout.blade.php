@extends('layouts.master')

@section('title')
Checkout
@endsection

@section('styles')
<style>
    .box {
        height: 100%;
    }

    .pay-t {
        font-size: 14px;
    }

    .main-footer {
        display: none;
    }
</style>
@endsection

@section('content')
<div class="small-container">
    <!-- Main content -->
    <div class="main">
        <!-- ORDER FORM -->
        <form id="order-form" action="{{ route('payment.place-order') }}" method="POST">
            @csrf
            <div class="row">
                @if(session('cart'))
                <div class="col-md-4">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">Billing Details</h4>
                        </div>
                        <!-- /.box-header -->

                        @if(Session::has('success'))
                        <div class="badge badge-success">
                            {{ Session::get('success') }}
                            @php
                            Session::forget('success');
                            @endphp
                        </div>
                        @endif

                            <div class="box-body">
                                <hr class="my-15">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>First Name</label>
                                            <input type="text" name="first_name" class="form-control"
                                                placeholder="First Name" value="{{ old('first_name') }}">
                                        </div>

                                        @if ($errors->has('first_name'))
                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Last Name</label>
                                            <input type="text" name="last_name" class="form-control"
                                                placeholder="Last Name" value="{{ old('last_name') }}">
                                        </div>

                                        @if ($errors->has('last_name'))
                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Town / City</label>
                                            <input class="form-control" name="city" type="text"
                                                value="{{ old('city') }}" placeholder="Town / City">
                                        </div>

                                        @if ($errors->has('city'))
                                        <span class="text-danger">{{ $errors->first('city') }}</span>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Province</label>
                                            <input type="text" name="province" class="form-control"
                                                placeholder="Province" value="{{ old('province') }}">
                                        </div>

                                        @if ($errors->has('province'))
                                        <span class="text-danger">{{ $errors->first('province') }}</span>
                                        @endif
                                    </div>

                                    <hr class="col-md-12 my-15">

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Street Address</label>
                                            <input type="text" name="address" class="form-control"
                                                placeholder="Street Address" value="{{ old('address') }}">
                                        </div>

                                        @if ($errors->has('address'))
                                        <span class="text-danger">{{ $errors->first('address') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Postal Code</label>
                                            <input type="text" name="postal_code" class="form-control"
                                                placeholder="Province" value="{{ old('postal_code') }}">
                                        </div>

                                        @if ($errors->has('postal_code'))
                                        <span class="text-danger">{{ $errors->first('postal_code') }}</span>
                                        @endif
                                    </div>

                                    <div class="col-md-12">
                                        <p class="text text-success mt-25">
                                            Get some percentage(s) off with a valid coupon code.
                                        </p>

                                        <div class="form-group">
                                            <label>Coupon Code</label>
                                            <input type="text" name="code" class="form-control"
                                                placeholder="Apply Coupon Code (optional)" value="{{ old('coupon') }}">
                                        </div>

                                        @if ($errors->has('coupon'))
                                        <span class="text-danger">{{ $errors->first('coupon') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- /.box -->
                </div>

                <div class="col-md-4">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Order Review</h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th class="w-200">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $total = 0; ?>

                                        @foreach(session('cart') as $id => $details)
                                        <?php $total += $details['price'] * $details['quantity'] ?>

                                        <tr class="cart-{{ $id }}">
                                            <td><img src="{{ $details['photo'] }}" alt="{{ $details['name'] }}"
                                                    width="80">
                                            </td>
                                            <td>{{ $details['name'] }}</td>
                                            <td>{{ $details['quantity'] }}</td>
                                            <td>${{ $details['price'] }}</td>
                                        </tr>
                                        @endforeach

                                        @php
                                        $shipping = 10;
                                        $percent = 12;
                                        $tax = Helper::calculateTax($percent, $total);

                                        $overallTotal = $total + $shipping + $tax;
                                        @endphp

                                        <tr>
                                            <th colspan="3" class="text-right">Total</th>
                                            <th>${{ $total }}</th>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="right">Shipping</td>
                                            <td>${{ $shipping }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="right">Tax</td>
                                            <td>${{ $tax }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-right font-size-24 font-weight-700">Payable
                                                Amount
                                            </th>
                                            <th class="font-size-24 font-weight-700">${{ $overallTotal }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="box">
                        <div class="box-header">
                            <h4 class="box-title">Payment Methods</h4>
                        </div>
                        <div class="box-body">
                            <h4 class="box-title mb-15">E-TRANSFER</h4>
                            <p class="pay-t">
                                Once you have placed your order, you will promptly receive a payment request email.
                                This email contains important information on how to ensure we can accept your payment by
                                e-transfer.
                                We are not able to process E-transfer sent without this specific information. Thank you
                                for your business.
                            </p>

                            <p class="pay-t">
                                We also accept crypto payments
                                <img src="/images/Bitcoin-Emblem.png" style="width: 100px;" alt="crypto">
                            </p>

                            <div class="checkbox">
                                <input type="checkbox" required id="basic_checkbox_1">
                                <label for="basic_checkbox_1">I have read and agree to the website's terms and
                                    conditions.</label>
                            </div>

                            <h4>Grand Total: ${{ $overallTotal }}</h4>

                            <button type="submit" id="make-payment" class="btn btn-success">PLACE ORDER</button>


                            <!-- Nav tabs -->
                            <!-- <ul class="nav nav-tabs" role="tablist">
                                {{-- <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#debit-card"
                                                role="tab"><span class="hidden-sm-up"><i class="fa fa-cc"></i></span> <span
                                                    class="hidden-xs-down">Debit Card</span></a> </li> --}}
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#paypal" role="tab"><span
                                            class="hidden-sm-up"><i class="fa fa-paypal"></i></span> <span
                                            class="hidden-xs-down">Paypal</span></a> </li>
                            </ul>-->

                            <!-- Tab panes -->
                            <!--<div class="tab-content tabcontent-border">
                                <div class="tab-pane active" id="debit-card" role="tabpanel">
                                    <div class="p-30">
                                        <div class="row">
                                            <div class="col-lg-7 col-md-6 col-12">
                                                {{-- <div id="dropin-container"></div> --}}
                                                <div class="col-md-8 offset-md-2 mt-20">
                                                    <div id="paypal-button-container"></div>
                                                </div>

                                                <button id="make-payment" class="btn btn-success">Make Payment</button>
                                            </div>

                                            <div class="col-lg-5 col-md-6 col-12">
                                                <h3 class="box-title mt-10">General Info</h3>
                                                <h2><i class="fa fa-cc-visa text-info"></i>
                                                    <i class="fa fa-cc-mastercard text-danger"></i>
                                                    <i class="fa fa-cc-discover text-success"></i>
                                                    <i class="fa fa-cc-amex text-warning"></i>
                                                </h2>
                                                {{-- <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has
                                                            roots in a piece of classical Latin literature from 45 BC, making it
                                                            over 2000 years old. Richard McClintock.</p>
                                                        <p>It is a long established fact that a reader will be distracted by the
                                                            readable content of a page when looking at its layout. </p> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="paypal" role="tabpanel">
                                    <div class="p-30">
                                        You can pay your money through paypal, for more info
                                        <a href="">click here</a>
                                        <br><br>

                                        <div class="col-md-4">
                                            <div id="paypal-button-container"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </form>
        <!-- /ORDER FORM -->

    </div>
    <!-- /.content -->
</div>
@endsection

@section('scripts')
<script>
    paypal.Buttons({
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            currency: 'CAD',
            value: "{{ $overallTotal }}",
            details: {
                shipping: "{{ $shipping }}",
                tax: "{{ $tax }}"
            },
          }
        }]
      });
    },
    onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
        // This function shows a transaction success message to your buyer.
        (function($) {
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let totalPrice = "{{ $overallTotal }}";
                
                $.ajax({
                    type: "POST",
                    url: "{{ route('payment.paypal') }}",
                    data: { total : totalPrice},
                    success: function (data) {
                        window.location.href = "{{ route('orders') }}";
                    },
                    error: function (data) {
                        window.location.reload();
                    }
                });
            });
        })(jQuery);
      });
    }
  }).render('#paypal-button-container');
</script>

{{-- <script>
    var button = document.querySelector('#make-payment');
        
        braintree.dropin.create({
            authorization: '{{ $token }}',
container: '#dropin-container'
}, function (createErr, instance) {
button.addEventListener('click', function () {
instance.requestPaymentMethod(function (err, payload) {
(function($) {
$(function() {
$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

let totalPrice = "{{ $total + 5 }}";

$.ajax({
type: "POST",
url: "{{ route('payment.braintree') }}",
data: { nonce : payload.nonce, total : totalPrice},
success: function (data) {
console.log('success', payload.nonce)
window.location.href = "{{ route('orders') }}";
},
error: function (data) {
console.log('error', payload.nonce)
//window.location.reload();
}
});
});
})(jQuery);
});
});
});
</script> --}}
@endsection