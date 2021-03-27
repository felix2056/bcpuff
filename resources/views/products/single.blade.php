@extends('layouts.master')

@section('title')
    {{ $product->name }}
@endsection

@section('styles')
    <style>
        form input, .btn {
            width: auto !important;
        }
    </style>
@endsection

@section('content')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <!-- DELETE PRODUCT FORM -->
                            <form style="display: none;" action="{{ route('admin.products.destroy', ['id' => $product->id]) }}" method="post"
                                id="{{ 'delete-product-' .$product->id }}">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                            </form>
                            <!-- /DELETE PRODUCT FORM -->

                            <div class="col-md-4 col-sm-6">
                                <div class="box box-body b-1 text-center no-shadow">
                                    <img src="{{ $product->image_url }}" id="product-image" class="img-fluid"
                                        alt="{{ $product->name }}">
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="col-md-8 col-sm-6">
                                <h2 class="box-title mt-0">{{ $product->name }}</h2>
                                
                                <h1 class="pro-price mb-0 mt-20">${{ $product->price }}
                                    <span class="text-danger">{{ $product->stock }} <strong class="badge badge-danger">in stock</strong></span>
                                </h1>
                                <hr>
                                <p>{!! $product->description !!}</p>
                            
                                <hr>

                                <form action="{{ route('cart.add', ['id' => $product->id]) }}" method="post">
                                    @csrf
                                    <input type="number" name="quantity" value="1" min="1" class="form-control">
                                    
                                    <div class="gap-items mt-3">
                                        <button type="submit" class="btn btn-primary"><i class="mdi mdi-cart-plus"></i> ADD TO CART</button>
                                        
                                        <a href="{{ route('checkout') }}" class="btn btn-success"><i class="mdi mdi-shopping"></i> Checkout!</a>

                                        @auth
                                        @if (Auth::user()->isAdmin())
                                        <a href="{{ route('admin.products.edit', ['slug' => $product->slug]) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                        <button type="button" class="btn btn-danger" type="button" onclick="event.preventDefault(); deleteProduct({{ $product->id }})"><i class="mdi mdi-delete-forever"></i> Delete</button>
                                        @endif
                                        @endauth
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
@endsection

@section('scripts')
    <script>
        function deleteProduct(product_id) {
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
                    document.getElementById("delete-product-" + product_id).submit();
                }
            });
        }
    </script>
@endsection