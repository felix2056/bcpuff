@extends('layouts.master')

@section('title')
    Home
@endsection

@section('styles')
    <link rel="stylesheet" href="/assets/owlcarousel/dist/owl.carousel.min.css">
    <link rel="stylesheet" href="/assets/owlcarousel/dist/owl.theme.default.min.css">

    <style>
        @media screen and (min-width: 768px) {
            .owl-prev {
                width: 15px;
                height: 100px;
                position: absolute;
                top: 40%;
                margin-left: -20px;
                display: block !important;
                border:0px solid black;
            }

            .owl-next {
                width: 15px;
                height: 100px;
                position: absolute;
                top: 40%;
                right: 0;
                display: block !important;
                border: 0px solid black;
            }
            .owl-prev i, .owl-next i {transform : scale(2,3); color: #ccc;}
        }

        .owl-carousel .owl-stage {
            display: flex !important;
        }

        .owl-carousel .owl-item {
           height: 485px;
           width: 100%;
        }

        .right-sidebar {
            position: -webkit-sticky;
            position: sticky;
            top: 0;
            height: 100%;
        }

        .bodered {
            border: 2px solid #fff;
            padding: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div id="image-slider" class="owl-carousel owl-theme">
            @if (count($images) > 0)
            @foreach ($images as $image)
                <div class="item">
                    <img src="{{ $image->url }}" alt="{{ $image->position }}">
                </div>
            @endforeach
            @else
                <div class="item"><img src="/img/slider/slider1.jpg" alt="Owl Image"></div>
                <div class="item"><img src="/img/slider/slider2.jpg" alt="Owl Image"></div>
                <div class="item"><img src="/img/slider/slider3.jpg" alt="Owl Image"></div>
                <div class="item"><img src="/img/slider/slider4.jpg" alt="Owl Image"></div>
                <div class="item"><img src="/img/slider/slider5.jpg" alt="Owl Image"></div>
            @endif
        </div>

        <div class="h-50"></div>

        <div class="row">
            <div class="col-md-8">
                <div class="col-md-12">
                    <p class="text-center">{{ App\Models\Setting::first()->sub_title }}</p>
                </div>

                <div class="mt-10 col-md-12"></div>

                <div class="col-md-12">
                    <div class="text-transform-none">
                        {!! App\Models\Setting::first()->info !!}
                    </div>
                </div>
            </div>

            <div class="right-sidebar col-md-4">
                <img src="{{ App\Models\Setting::first()->logo_url }}" alt="{{ App\Models\Setting::first()->title }}">
            </div>
        </div>

        <div class="h-50"></div>

        <h2 class="text-white mb-20 font-weight-500">Featured Products</h2>

        <!-- Featured products -->
        <section class="content">
            @if (count($featured) > 0)
            <div class="row fx-element-overlay">
                @foreach ($featured as $product)
                <div class="col-12 col-md-4">
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
                                    <small class="text-muted db">{{ $product->summary }}</small>
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
        <!-- / Featured products -->

        {{-- <img src="/images/face.png" alt="bcpuff"> --}}
        {{-- <b>
            <h1>WARNING</h1>
        </b> --}}

        {{-- <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3 col-12">
                    <div class="container">
                        <p>NICOTINE IS A DANGEROUS AND HIGHLY ADDICTIVE CHEMICAL.
                            IT CAN CAUSE AN INCREASE IN BLOOD PRESSURE,HEART RATE,
                            FLOW OF BLOOD TO THE HEART AND A NARROWING OF THE THE ARTERIES
                            NICOTINE MAY ALSO CONTRIBUTE TO THE HARDENING OF THE ARTERIAL WALLS,
                            WHICH IN TURN, MAY LEAD TO A HEART ATTACK.</P>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection

@section('scripts')
    <!-- javascript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/assets/owlcarousel/dist/owl.carousel.min.js"></script>

    <script>
        jQuery(document).ready(function($) {
            $('#image-slider').owlCarousel({
                nav: true, // Show next and prev buttons
                navText : ["<i class='fa fa-arrow-left'></i>","<i class='fa fa-arrow-right'></i>"],
                slideSpeed: 300,
                paginationSpeed: 400,
                items: 1,
                animateOut: 'fadeOut',
                loop: true,
                autoplay: true,
                autoplayTimeout: 10000,
                autoplayHoverPause: true
            });
        });
    </script>
@endsection
