@extends('layouts.authApp')

@section('content')

    <div style="text-align: center;">
        {{--        <img class="responsive-img" style="width: 180px;height: 150px;" src="{{asset('img/login-image.png')}}" />--}}
{{--        <div class="section"></div>--}}

{{--        <div class="section"></div>--}}

        <div class="container" >
            <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 15px 15px 0px 15px; border: 1px solid #EEE;">

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class='rowsmall'>
                        <div class='col s12'>
                            <h6>Register</h6>
                        </div>
                    </div>

                    <div class='rowsmall'>
                        <div class='input-field col s12' style="margin-bottom:0.3rem">
                            <input class='validate @error('name') is-invalid @enderror' type='text' name='name' id='name'  value="{{ old('name') }}" required />
                            <label class="active" for='name'>Enter your name</label>
                        </div>
                    </div>
                    <div class='rowsmall'>
                        <div class='input-field col s12' style="margin-bottom:0.3rem">
                            <input class='validate @error('email') is-invalid @enderror' type='email' name='email' id='email'  value="{{ old('email') }}" required />
                            <label class="active" for='email'>Enter your email</label>
                        </div>
                    </div>
                    <div class='rowsmall'>
                        <div class='input-field col s12' style="margin-bottom:0.3rem">
                            <input class='validate @error('mobile') is-invalid @enderror' type='text' name='mobile' id='mobile'  value="{{ old('mobile') }}" required/>
                            <label class="active" for='mobile'>Enter your Contact Number</label>
                        </div>
                    </div>

                    <div class='rowsmall'>
                        <div class='input-field col s12' style="margin-bottom:0.3rem">
                            <input class='validate @error('designation') is-invalid @enderror' type='text' name='designation' id='designation'  value="{{ old('designation') }}" />
                            <label class="active" for='designation'>Enter your Designation</label>
                        </div>
                    </div>

                    <div class='rowsmall'>
                        <div class='input-field col s12' style="margin-bottom:0.3rem">
                            <input class='validate @error('password') is-invalid @enderror' type='password' name='password' id='password' required />
                            <label class="active "  for='password'>Enter your password</label>
                        </div>

                        <div class='input-field col s12' style="margin-bottom:0.3rem">
                            <input class='validate ' type='password' name='password_confirmation' id='password_confirmation' required />
                            <label class="active "  for='password_confirmation'>Confirm your password</label>
                        </div>

{{--                        <label  style='float: left;'>--}}
{{--                            <input type="checkbox"  name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}  />--}}
{{--                            <span>Remember Me</span>--}}
{{--                        </label>--}}
{{--                        @if (Route::has('password.request'))--}}
{{--                            <label style='float: right;'>--}}
{{--                                <a class='pink-text' href="{{ route('password.request') }}"><b>Forgot Password?</b></a>--}}
{{--                            </label>--}}
{{--                        @endif--}}
                    </div>

                    <br />
                    <div style="text-align: center;">
                        <div class='row'>
                            <button type='submit' name='btn_login' class='col s12 btn waves-effect indigo'>Register</button>
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













{{--    <div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Register') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('register') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>--}}

{{--                                @error('name')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Register') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
@endsection
@section('javaScript')
    @error('email')
    <script>
        PNotify.alert({
            text: '{{$message}}',
            type:'error',
        });
    </script>
    @enderror
    @error('password')
    <script>
        PNotify.alert({
            text: "{{$message}}",
            type:'error',
        });
    </script>
    @enderror
@stop