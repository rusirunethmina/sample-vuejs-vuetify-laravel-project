@extends('layouts.authApp')
@section('content')
    {{--    <div class="container">--}}
    {{--        <div class="row justify-content-center">--}}
    {{--            <div class="col-md-8">--}}
    {{--                <div class="card">--}}
    {{--                    <div class="card-header">{{ __('Reset Password') }}</div>--}}

    {{--                    <div class="card-body">--}}
    {{--                        <form method="POST" action="{{ route('password.update') }}">--}}
    {{--                            @csrf--}}

    {{--                            <input type="hidden" name="token" value="{{ $token }}">--}}

    {{--                            <div class="form-group row">--}}
    {{--                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

    {{--                                <div class="col-md-6">--}}
    {{--                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>--}}

    {{--                                    @error('email')--}}
    {{--                                    <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                    @enderror--}}
    {{--                                </div>--}}
    {{--                            </div>--}}

    {{--                            <div class="form-group row">--}}
    {{--                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

    {{--                                <div class="col-md-6">--}}
    {{--                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

    {{--                                    @error('password')--}}
    {{--                                    <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                    @enderror--}}
    {{--                                </div>--}}
    {{--                            </div>--}}

    {{--                            <div class="form-group row">--}}
    {{--                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

    {{--                                <div class="col-md-6">--}}
    {{--                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
    {{--                                </div>--}}
    {{--                            </div>--}}

    {{--                            <div class="form-group row mb-0">--}}
    {{--                                <div class="col-md-6 offset-md-4">--}}
    {{--                                    <button type="submit" class="btn btn-primary">--}}
    {{--                                        {{ __('Reset Password') }}--}}
    {{--                                    </button>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </form>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <div style="text-align: center;">
        <div class="section"></div>

        <h6 class="indigo-text">Update Your Password</h6>
        <div class="section"></div>

        <div class="container">
            <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 15px 15px 0px 15px; border: 1px solid #EEE;">

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">
                    <label>If Anything went wrong...please contact our customer support 07X-XXXXXXX</label>
                    <label>Or Mail us support@geoit.lk</label>

                    <div class='row'>
                        <div class='input-field col s12'>
                            <input class='validate @error('email') is-invalid @enderror' type='email' name='email' id='email'  value="{{ old('email') }}" required autocomplete="email"/>
                            <label class="active" for='email'>Enter your email</label>
                        </div>
                    </div>

                    <div class='row'>
                        <div class='input-field col s12'>
                            <input class='validate @error('password') is-invalid @enderror' type='password' name='password' id='password' required autocomplete="current-password"/>
                            <label class="active "  for='password'>Enter your password</label>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='input-field col s12'>
                            <input id="password-confirm" type="password"  name="password_confirmation" required autocomplete="new-password">
                            <label class="active "  for='password-confirm'>Confirm your password</label>
                        </div>
                    </div>

                    <br />
                    <div style="text-align: center;">
                        <div class='row'>
                            <button type='submit' name='btn_login' class='col s12 btn btn-large waves-effect indigo'>Update Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="section"></div>
    <div class="section"></div>
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