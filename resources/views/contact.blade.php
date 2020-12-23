@extends('layouts.master')

@section('title')
Contact Us
@endsection

@section('styles')
    <style>

    </style>
@endsection

@section('content')
<div class="container-full">
    <section class="content">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Send Us A Message</h4>
                    </div>
                    <!-- /.box-header -->

                    @if(Session::has('success'))
                        <div class="badge badge-success">
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                        </div>
                    @endif

                    <form action="{{ route('send-mail') }}" method="post" class="form">
                        @csrf
                        <div class="box-body">
                            <hr class="my-15">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name" @auth value="{{ Auth::user()->name }}" @else value="{{ old('name') }}" @endauth>
                                    </div>
                                    
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>E-mail</label>
                                        <input type="email" name="email" class="form-control" placeholder="E-mail" @auth value="{{ Auth::user()->email }}" @else value="{{ old('email') }}" @endauth>
                                    </div>

                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>

                            <hr class="my-15">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input class="form-control" name="phone" type="tel" value="{{ old('phone') }}" placeholder="+555">
                                    </div>
        
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Subject</label>
                                        <input type="text" name="subject" class="form-control" placeholder="Subject" value="{{ old('subject') }}">
                                    </div>

                                    @if ($errors->has('subject'))
                                        <span class="text-danger">{{ $errors->first('subject') }}</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Message</label>
                                <textarea rows="4" name="message" class="form-control" placeholder="Message">{{ old('message') }}</textarea>
                            </div>

                            @if ($errors->has('message'))
                                <span class="text-danger">{{ $errors->first('message') }}</span>
                            @endif
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer text-right">
                            <button type="submit" class="btn btn-rounded btn-success">
                                <i class="ti-email"></i> Send
                            </button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>
</div>
@endsection