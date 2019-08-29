@extends('layouts.guest')

@section('title', __('Login'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-login mx-auto">
            <div class="text-center mb-2"><img src="{{ asset('images/sample_logo.png') }}" alt="Wira Toyota Logo" width="170px"></div>

            <div class="card">
                <div class="card-body p-6">
                    <div class="card-title text-center"><b>Login | Sistem Poin Siswa</b></div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">

                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="{{ __('E-Mail Address') }}" required autofocus>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">

                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="custom-control-label" for="remember">
                                    <small>{{ __('Remember Me') }}</small>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
