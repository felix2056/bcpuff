@extends('layouts.guest')

@section('title')
Thank You
@endsection

@section('styles')
    <style>
        .rounded30 {
            border: 2px solid;
        }

        ul li {
            list-style: none;
        }
    </style>
@endsection

@section('content')
<div class="row h-p100 align-items-center justify-content-center text-center">
    <div class="col-lg-7 col-md-10 col-12">
        <div class="rounded30 text-uppercase p-50 shadow-lg">
            <h1 class="font-size-180 font-weight-bold error-page-title"> <i class="fa fa-credit-card fa-spin"></i></h1>
            <h1>ORDER IS BEING PROCESSED!</h1>
            <h3>Thank you for your order. You will receive an email notification with instructions on how to proceed with payment.</h3>
            <h4>Please check your email.</h4>
            
            <a class="btn btn-info" href="{{ route('products.index') }}">
                <i class="fa fa-arrow-left"></i> Continue shopping
            </a>
        </div>
    </div>				
</div>
@endsection