@extends('layouts.guest')

@section('title')
Register
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
                        <h2 class="text-light">Get started with Us</h2>
                        <p class="mb-0">Register a new membership</p>							
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
                        <form action="{{ route('register') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control pl-15 bg-transparent" placeholder="Full Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent"><i class="ti-email"></i></span>
                                    </div>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control pl-15 bg-transparent" placeholder="Email">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
                                    </div>
                                    <input type="password" name="password" required autocomplete="new-password" class="form-control pl-15 bg-transparent" placeholder="Password">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-transparent"><i class="ti-lock"></i></span>
                                    </div>
                                    <input type="password" name="password_confirmation" required autocomplete="new-password" class="form-control pl-15 bg-transparent" placeholder="Retype Password">
                                </div>
                            </div>
                              <div class="row">
                                <div class="col-12">
                                  <div class="checkbox">
                                    <input type="checkbox" required id="basic_checkbox_1">
                                    <label for="basic_checkbox_1">I confirm that I am above 19 years of age.</a></label>
                                  </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-12 text-center">
                                  <button type="submit" class="btn btn-info margin-top-10">SIGN IN</button>
                                </div>
                                <!-- /.col -->
                              </div>
                        </form>				
                        <div class="text-center">
                            <p class="mt-15 mb-0">Already have an account?<a href="{{ route('login') }}" class="text-danger ml-5"> Sign In</a></p>
                        </div>
                    </div>
                </div>								

                {{-- <div class="text-center">
                  <p class="mt-20 text-white">- Register With -</p>
                  <p class="gap-items-2 mb-20">
                      <a class="btn btn-social-icon btn-round btn-facebook" href="#"><i class="fa fa-facebook"></i></a>
                      <a class="btn btn-social-icon btn-round btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
                      <a class="btn btn-social-icon btn-round btn-instagram" href="#"><i class="fa fa-instagram"></i></a>
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

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}
