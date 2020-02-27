@extends('layouts.app')

@section('title', __('password.change_password'))

@section('content')
    <div class="row">
<div class="col col-login mx-auto">
    <form action="{{ route('password.change') }}" method="post">
        <div class="card">
            <div class="card-header">{{ __('password.change_password') }}</div>
            @csrf
            @method('patch')
            <div class="card-body">
                <div class="form-group">
                    <label for="old_password" class="form-label">{{ __('password.old_password') }}</label>
                    <input id="old_password" type="password" class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" name="old_password" required autofocus>

                    @if ($errors->has('old_password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('old_password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">{{ __('password.new_password') }}</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                    @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">{{ __('password.password_confirmation') }}</label>
                    <input id="password_confirmation" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required>

                    @if ($errors->has('password_confirmation'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-info">{{ __('password.change_password') }}</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">{{ __('app.cancel') }}</a>
            </div>
        </div>
    </form>
</div>
@endsection
