@extends('layouts.guest')

@section('title', __('Login'))

@section('content')
<div class="container">
    <div class="row">
        <div class="col col-login mx-auto">
            <div class="text-center mb-2">
                @if (Option::get('option_logo'))
                    <img src="{{ asset('images/'.Option::get('option_logo')) }}" alt="Logo" width="170px">
                @else
                    <img src="{{ asset('images/sample_logo.png') }}" alt="Logo" width="170px">
                @endif
            </div>
            <div class="card">
                <div class="card-body p-6">
                    <div class="card-title text-center"><b>Login | Sistem Poin Siswa</b></div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="Username" required autofocus>
                            @if ($errors->has('username'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('username') }}</strong>
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
                        <hr style="margin: 20px 0px">
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
