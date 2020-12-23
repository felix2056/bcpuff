@extends('layouts.guest')

@section('title')
Login
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
<div class="row align-items-center justify-content-md-center h-p100">
    <div class="col-12">
        <div class="row justify-content-center no-gutters">
            <div class="col-lg-5 col-md-5 col-12">
                <div class="rounded30 shadow-lg text-uppercase">
                    <div class="content-top-agile p-20 pb-0">
                        <h2 class="text-light">Let's Get Started</h2>
                        <p class="mb-0">Sign in to continue to BCPuff</p>
                    </div>

                    <div class="content-top-agile p-20 pb-0">
                        <x-jet-validation-errors class="mb-4 bg bg-danger" />

                        @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                        @endif
                    </div>

                    <div class="p-40">
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control pl-15 bg-transparent" placeholder="Username">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" value="{{ old('password') }}" class="form-control pl-15 bg-transparent"
                                        placeholder="Password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="checkbox">
                                        <input type="checkbox" name="remember" id="basic_checkbox_1">
                                        <label for="basic_checkbox_1">Remember Me</label>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-6">
                                    <div class="fog-pwd text-right">
                                        <a href="{{ route('password.request') }}" class="hover-warning"><i
                                                class="ion ion-locked"></i> Forgot pwd?</a><br>
                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-danger mt-10">SIGN IN</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>

                        <div class="text-center">
                            <p class="mt-15 mb-0">Don't have an account? 
                                <a href="{{ route('register') }}" class="text-primary ml-5">Sign Up</a>
                            </p>
                        </div>
                    </div>
                </div>
                {{-- <div class="text-center">
                    <p class="mt-20 text-white">- Sign With -</p>
                    <p class="gap-items-2 mb-20">
                        <a class="btn btn-social-icon btn-round btn-facebook" href="#"><i
                                class="fa fa-facebook"></i></a>
                        <a class="btn btn-social-icon btn-round btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
                        <a class="btn btn-social-icon btn-round btn-instagram" href="#"><i
                                class="fa fa-instagram"></i></a>
                    </p>
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endsection
{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
</div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div>
        <x-jet-label for="email" value="{{ __('Email') }}" />
        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
            autofocus />
    </div>

    <div class="mt-4">
        <x-jet-label for="password" value="{{ __('Password') }}" />
        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required
            autocomplete="current-password" />
    </div>

    <div class="block mt-4">
        <label for="remember_me" class="flex items-center">
            <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
    </div>

    <div class="flex items-center justify-end mt-4">
        @if (Route::has('password.request'))
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
            {{ __('Forgot your password?') }}
        </a>
        @endif

        <x-jet-button class="ml-4">
            {{ __('Login') }}
        </x-jet-button>
    </div>
</form>
</x-jet-authentication-card>
</x-guest-layout> --}}