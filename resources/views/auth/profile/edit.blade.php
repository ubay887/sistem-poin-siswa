@extends('layouts.app')

@section('title', __('user.profile_edit'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">@yield('title')</div>
            <form method="POST" action="{{ route('profile.update') }}" accept-charset="UTF-8">
                <div class="card-body">
                    @csrf @method('patch')
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('user.name') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $user->name) }}" readonly required>
                        {!! $errors->first('name', '<span class="invalid-feedback small">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="username" class="form-label">{{ __('user.username') }} <span class="form-required">*</span></label>
                        <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username', $user->username) }}" required>
                        {!! $errors->first('username', '<span class="invalid-feedback small">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">{{ __('user.email') }}</label>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', $user->email) }}">
                        {!! $errors->first('email', '<span class="invalid-feedback small">:message</span>') !!}
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('user.profile_update') }}" class="btn btn-success">
                    <a href="{{ route('profile.show') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
