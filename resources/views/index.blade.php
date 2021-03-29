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
            <div class="item"><img src="/img/slider/slider1.jpg" alt="Owl Image"></div>
            <div class="item"><img src="/img/slider/slider2.jpg" alt="Owl Image"></div>
            <div class="item"><img src="/img/slider/slider3.jpg" alt="Owl Image"></div>
            <div class="item"><img src="/img/slider/slider4.jpg" alt="Owl Image"></div>
            <div class="item"><img src="/img/slider/slider5.jpg" alt="Owl Image"></div>
        </div>

        <div class="mt-10"></div>

        <div class="row">
            <div class="col-md-8">
                <div class="bodered col-md-12">
                    <p class="text-center">{{ App\Models\Setting::first()->sub_title }}</p>
                </div>

                <div class="mt-10 col-md-12"></div>

                <div class="bodered col-md-12">
                    <div class="text-transform-none">
                        {!! App\Models\Setting::first()->info !!}
                    </div>
                </div>
            </div>

            <div class="right-sidebar bodered col-md-4">
                <img src="{{ App\Models\Setting::first()->logo_url }}" alt="{{ App\Models\Setting::first()->title }}">
            </div>
        </div>

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
                navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
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
