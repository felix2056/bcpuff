@extends('layouts.master')

@section('title')
    Cart
@endsection

@section('content')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            @if(session('cart'))
            <div class="col-12 col-lg-8">
                <div class="box">
                    <div class="box-header bg-primary">
                        <h4 class="box-title"><strong>YOUR CART ({{ count((array) session('cart')) }} ITEMS)</strong></h4>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table product-overview">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product info</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th style="text-align:center">Total</th>
                                        <th style="text-align:center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $total = 0 ?>

                                    @foreach(session('cart') as $id => $details)
                                    <?php $total += $details['price'] * $details['quantity'] ?>
                                    
                                    <tr class="cart-{{ $id }}">
                                        <td>
                                            <img src="{{ $details['photo'] }}" alt="{{ $details['name'] }}" width="80">
                                        </td>
                                        
                                        <td>
                                            <h5>{{ $details['name'] }}</h5>
                                        </td>
                                        
                                        <td>${{ $details['price'] }}</td>
                                        
                                        <td width="70">
                                            <input type="number" class="form-control quantity" value="{{ $details['quantity'] }}" min="1">
                                        </td>
                                        
                                        <td width="100" align="center" class="font-weight-900">${{ $details['price'] * $details['quantity'] }}</td>

                                        <td align="center">
                                            <a href="javascript:void(0)"
                                                data-id="{{ $id }}"
                                                class="update-cart btn btn-circle btn-success btn-xs" title="Update" data-toggle="tooltip"
                                                data-original-title="Update"><i class="ti-save"></i>
                                            </a>

                                            <a href="javascript:void(0)"
                                                data-id="{{ $id }}"
                                                class="remove-from-cart btn btn-circle btn-danger btn-xs" title="Remove" data-toggle="tooltip"
                                                data-original-title="Delete"><i class="ti-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach

                                    @php
                                        $shipping = 10;
                                        $percent = 12;
                                        $tax = Helper::calculateTax($percent, $total);

                                        $overallTotal = $total + $shipping + $tax;
                                    @endphp
                                </tbody>
                            </table>
                            
                            <a class="btn btn-success pull-right" href="{{ route('checkout') }}">
                                <i class="fa fa fa-shopping-cart"></i>
                                Checkout
                            </a>
                            
                            <a class="btn btn-info" href="{{ route('products.index') }}">
                                <i class="fa fa-arrow-left"></i> Continue shopping
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4">
                <div class="box">
                    <div class="box-header bg-info">
                        <h4 class="box-title"><strong>Cart Summary</strong></h4>
                    </div>

                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table simple mb-0">
                                <tbody>
                                    <tr>
                                        <td>Total</td>
                                        <td class="text-right font-weight-700">${{ $total }}</td>
                                    </tr>
                                    <tr>
                                        <td>Shipping</td>
                                        <td class="text-right font-weight-700">${{ $shipping }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tax</td>
                                        <td class="text-right font-weight-700">${{ $tax }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bt-1">Payable Amount</th>
                                        <th class="bt-1 text-right font-weight-900 font-size-18">${{ $overallTotal }}</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="box-footer">
                        <a href="{{ route('index') }}" class="btn btn-danger">Cancel Order</a>
                        <a href="{{ route('checkout') }}" class="btn btn-primary pull-right">Place Order</a>
                    </div>
                </div>

                <div class="box">
                    <div class="box-header bg-dark">
                        <h4 class="box-title"><strong>Support</strong></h4>
                    </div>

                    <div class="box-body">
                        <h4 class="font-weight-800"><i class="ti-mobile"></i> +1800 123 1234 <span
                                class="text-info">(Toll Free)</span></h4>
                        <p>Contact us for any queries. We are avalible 24x7x365.</p>
                    </div>
                </div>

            </div>

            @else
            <div class="col-12">
                <div class="box">
                    <div class="box-header bg-primary">
                        <h4 class="box-title"><strong>YOUR CART (0 ITEMS)</strong></h4>
                    </div>

                    <div class="box-body">
                        <p>Your Shopping Cart Is Empty</p>

                        <div class="shop-more">
                            <a href="{{ route('products.index') }}" class="btn btn-success">
                            Shop Products <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
</div>

<!---------cart item details--------->
{{-- <div class="small-container cart-page">
    @if(session('cart'))
    <table>
        <tr>
            <th>PRODUCT</th>
            <th>QUANTITY</th>
            <th>SUBTOTAL</th>
        </tr>

        <?php $total = 0 ?>

        @foreach(session('cart') as $id => $details)
        <?php $total += $details['price'] * $details['quantity'] ?>

        <tr class="cart-{{ $id }}">
            <td>
                <div class="cart-info">
                    <img src="{{ $details['photo'] }}">
                    <div>
                        <p>{{ $details['name'] }}</p>
                        <small>PRICE: ${{ $details['price'] }}</small>
                        <br>
                        <span style="display: flex;">
                            <a href="#" data-id="{{ $id }}" style="padding: 3px;" class="update-cart badge-success">
                                <i class="fa fa-upload"></i> UPDATE
                            </a>
                            <a href="#" data-id="{{ $id }}" style="padding: 3px;" class="remove-from-cart badge-danger">
                                REMOVE <i class="fa fa-trash"></i>
                            </a>
                        </span>
                    </div>
                </div>
            </td>
            <td><input type="number" value="{{ $details['quantity'] }}" min="1" class="quantity"></td>
            <td>${{ $details['price'] * $details['quantity'] }}</td>
        </tr>
        @endforeach
    </table>

    <div class="total-price">
        <table>
            <tr>
                <td>TAX</td>
                <td>$5.00</td>
            </tr>
            <tr>
                <td>TOTAL</td>
                <td>${{ $total }}</td>
            </tr>

            <tr>
                <td>
                    <a href="{{ route('checkout') }}" class="btn btn-success text-center">
                        Checkout <i class="fa fa-angle-right"></i>
                    </a>
                </td>

                <td>
                    <a href="{{ route('products.index') }}" class="btn btn-warning text-center">
                        <i class="fa fa-angle-left"></i> Continue Shopping</a>
                </td>
            </tr>
        </table>
    </div>
    
    @else
    <div class="main">
        <p>Your Shopping Cart Is Empty!</p>

        <div class="shop-more">
            <a href="{{ route('products.index') }}" class="btn btn-warning">
                <i class="fa fa-angle-left"></i> Shop Products
            </a>
        </div>
    </div>
    @endif
</div> --}}
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(".update-cart").click(function (e) {
           e.preventDefault();
           var ele = $(this);

            $.ajax({
               url: '{{ route('cart.update') }}',
               method: "patch",
               data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("tr").find(".quantity").val()},
               success: function (response) {
                   window.location.reload();
               }
            });
        });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('cart.remove') }}',
                        method: "DELETE",
                        data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                }
            });
        });
</script>
@endsection