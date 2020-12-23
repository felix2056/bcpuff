@extends('layouts.master')

@section('title')
Search Results For {{ $query }}
@endsection

@section('styles')
<style>
    .box {
        background: none;
        border: 2px solid #fff;
    }
</style>
@endsection

@section('content')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <div class="d-inline-block align-items-center">
                    <h3>Search Results For <b>[{{ $query }}]</b></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        @if (count($products) > 0)
        <div class="row fx-element-overlay">
            @foreach ($products as $product)
            @auth
            @if (Auth::user()->isAdmin())
                <!-- DELETE PRODUCT FORM -->
                <form style="display: none;" action="{{ route('admin.products.destroy', ['id' => $product->id]) }}" method="post"
                    id="{{ 'delete-product-' .$product->id }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                </form>
                <!-- /DELETE PRODUCT FORM -->
            @endif
            @endauth

            <div class="col-12 col-lg-6 col-xl-4">
                <div class="box box-default">
                    <div class="fx-card-item">
                        <div class="fx-card-avatar fx-overlay-1">
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                            
                            <div class="fx-overlay scrl-up">
                                <ul class="fx-info">
                                    <li>
                                        <a class="btn btn-outline image-popup-vertical-fit" href="{{ route('products.single', ['slug' => $product->slug]) }}">
                                            <i class="mdi mdi-magnify"></i>
                                        </a>
                                    </li>
                                    
                                    @auth
                                    @if (Auth::user()->isAdmin())
                                    <li>
                                        <a onclick="event.preventDefault(); deleteProduct({{ $product->id }})" class="btn btn-outline" href="javascript:void(0);">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
                                    </li>
                                    
                                    
                                    <li>
                                        <a class="btn btn-outline" href="{{ route('admin.products.edit', ['slug' => $product->slug]) }}">
                                            <i class="mdi mdi-settings"></i>
                                        </a>
                                    </li>
                                    @endif
                                    @endauth
                                </ul>
                            </div>
                        </div>
                
                        <div class="fx-card-content text-left mb-0">
                            <div class="product-text">
                                <h2 class="pro-price text-blue">${{ $product->price }}</h2>
                                <a href="{{ route('products.single', ['slug' => $product->slug]) }}">
                                <h4 class="box-title mb-0">{{ $product->name }}</h4>
                                </a>
                                <small class="text-muted db">{{ $product->short_description }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            @endforeach
        </div>
        @endif
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