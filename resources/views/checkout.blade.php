@extends('layouts.master')

@section('title')
Checkout
@endsection

@section('content')
<div class="small-container">
    <!-- Main content -->
    <div class="main">
        <div class="row">
            @if(session('cart'))
            <div class="col-12">
                <div class="box">
                    <div class="box-header">
                        <h4 class="box-title">Product Summary</h4>
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
                                        <td><img src="{{ $details['photo'] }}" alt="{{ $details['name'] }}" width="80">
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
                                        <th colspan="3" class="text-right font-size-24 font-weight-700">Payable Amount
                                        </th>
                                        <th class="font-size-24 font-weight-700">${{ $overallTotal }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <hr>

                        {{-- <h4 class="box-title mb-15">Choose payment Option</h4> --}}
                        <h4 class="box-title mb-15">Pay with PayPal</h4>
                        
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            {{-- <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#debit-card"
                                    role="tab"><span class="hidden-sm-up"><i class="fa fa-cc"></i></span> <span
                                        class="hidden-xs-down">Debit Card</span></a> </li> --}}
                            <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#paypal" role="tab"><span
                                        class="hidden-sm-up"><i class="fa fa-paypal"></i></span> <span
                                        class="hidden-xs-down">Paypal</span></a> </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border">
                            <div class="tab-pane active" id="debit-card" role="tabpanel">
                                <div class="p-30">
                                    <div class="row">
                                        <div class="col-lg-7 col-md-6 col-12">
                                            {{-- <div id="dropin-container"></div> --}}
                                            <div class="col-md-8 offset-md-2 mt-20">
                                                <div id="paypal-button-container"></div>
                                            </div>

                                            {{-- <button id="make-payment" class="btn btn-success">Make Payment</button> --}}
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
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

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