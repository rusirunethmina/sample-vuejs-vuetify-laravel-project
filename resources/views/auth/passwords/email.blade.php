@extends('layouts.authApp')
@section('content')

    <div style="text-align: center;">
{{--        <img class="responsive-img" style="width: 120px;height: 100px;" src="{{asset('images/world-2.gif')}}" />--}}
        <div class="section"></div>

        <h6 class="indigo-text">Reset Your Password</h6>
        <div class="section"></div>

        <div class="container" style="margin-top: 30px">
            <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 15px 15px 0px 15px; border: 1px solid #EEE;">

                <form method="POST" action="{{ route('password.email')  }}">
                    @csrf
                    <label>If Anything went wrong...please contact our customer support 07X-XXXXXXX</label>
                    <label>Or Mail us info@celatatech.com</label>
                    <div class='row'>
                        <div class='input-field col s12'>
                            <input class='validate @error('email') is-invalid @enderror' type='email' name='email' id='email'  value="{{ old('email') }}" required autocomplete="email"/>
                            <label class="active" for='email'>Enter your email</label>
                        </div>
                    </div>
                    <br />
                    <div style="text-align: center;">
                        <div class='row'>
                            <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo'>Send Reset Link</button>
                        </div>
                        <div class="row">
                            <label style='float: left;'>
                                <a class='blue-text' href="{{ route('login') }}"><b>Back to login</b></a>
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop
{{--<div class="container">--}}
{{--<div class="row justify-content-center">--}}
{{--<div class="col-md-8">--}}
{{--<div class="card">--}}
{{--<div class="card-header">{{ __('Reset Password') }}</div>--}}

{{--<div class="card-body">--}}
{{--@if (session('status'))--}}
{{--<div class="alert alert-success" role="alert">--}}
{{--{{ session('status') }}--}}
{{--</div>--}}
{{--@endif--}}

{{--<form method="POST" action="{{ route('password.email') }}">--}}
{{--@csrf--}}

{{--<div class="form-group row">--}}
{{--<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--<div class="col-md-6">--}}
{{--<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--@error('email')--}}
{{--<span class="invalid-feedback" role="alert">--}}
{{--<strong>{{ $message }}</strong>--}}
{{--</span>--}}
{{--@enderror--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group row mb-0">--}}
{{--<div class="col-md-6 offset-md-4">--}}
{{--<button type="submit" class="btn btn-primary">--}}
{{--{{ __('Send Password Reset Link') }}--}}
{{--</button>--}}
{{--</div>--}}
{{--</div>--}}
{{--</form>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
@section('javaScript')
    @error('email')
    <script>
        PNotify.alert({
            text: "Invalid Email !",
            type:'error',
        });
    </script>
    @enderror
    @if (session('status'))
        <script>
            PNotify.alert({
                text: " {{ session('status') }}",
                type:'info',
            });
        </script>
    @endif
@stop
