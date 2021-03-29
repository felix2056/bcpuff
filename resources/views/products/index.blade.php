@extends('layouts.master')

@section('title')
Products
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
                @auth
                @if (Auth::user()->isAdmin())
                <div class="d-inline-block align-items-center">
                    <li class="breadcrumb-item active">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary"> <i class="fa fa-plus"></i> New</a>
                    </li>
                </div>
                @endif
                @endauth

                <div class="btn-group">
                    <button class="btn btn-rounded btn-dark dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Categories</button>
                    <div class="dropdown-menu dropdown-menu-right" style="will-change: transform;">
                        @foreach ($categories as $category)
                            <a class="dropdown-item" href="{{ route('products.index', ['category' => $category->name, 'id' => $category->id]) }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                  </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        @if (count($products) > 0)
        <div class="row fx-element-overlay">
            @foreach ($products as $product)
            <div class="col-12 col-md-3">
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
                <div class="box box-default">
                    <div class="fx-card-item">
                        <div class="fx-card-avatar fx-overlay-1">
                            <a href="{{ route('products.single', ['slug' => $product->slug]) }}">
                                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                            </a>
                            
                            @auth
                            @if (Auth::user()->isAdmin())
                            <div class="fx-overlay scrl-up">
                                <ul class="fx-info">
                                    <li>
                                        <a class="btn btn-outline image-popup-vertical-fit" href="{{ route('products.single', ['slug' => $product->slug]) }}">
                                            <i class="mdi mdi-magnify"></i>
                                        </a>
                                    </li>
                                    
                                    
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
                                </ul>
                            </div>
                            @endif
                            @endauth
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

{{-- <div class="small-container">
    <b>
        <i>
            <h1 class="title">PRODUCTS</h1>
        </i>
    </b>
    
    @if (count($products) > 0)
    <div class="main row">
        @foreach ($products as $product)
        <div class="col-4">
            <a href="{{ route('products.single', ['slug' => $product->slug]) }}">
                <img src="{{ $product->image_url }}">
            </a>
            <a href="{{ route('products.single', ['slug' => $product->slug]) }}">
                <h4>{{ $product->name }}</h4>
            </a>
            <P>${{ $product->price }}</P>
        </div>
        @endforeach
    </div>
    @endif
</div> --}}
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