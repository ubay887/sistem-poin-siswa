@extends('layouts.app')

@section('title', __('user.create'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('user.create') }}</div>
            <form method="POST" action="{{ route('users.store') }}" accept-charset="UTF-8">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('user.name') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="username" class="control-label">{{ __('user.username') }} <span class="form-required">*</span></label>
                        <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required>
                        {!! $errors->first('username', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="email" class="control-label">{{ __('user.email') }} <span class="form-required">*</span></label>
                        <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                        {!! $errors->first('email', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="role_id" class="form-label">{{ __('user.role_id') }} <span class="form-required">*</span></label>
                        <div class="form-group">
                            @foreach (App\Role::$lists as $roleId => $roleType)
                                <input type="radio" value="{{ $roleId }}" {{ 1 === $roleId ? 'checked' : '' }} id="role_id" name="role_id" >
                                <label for="role_id">{{ __('user.'.$roleType) }}</label>&nbsp;&nbsp;&nbsp;
                            @endforeach
                        </div>
                        {!! $errors->first('jenis_kelamin', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">{{ __('user.password') }} <span class="form-required">*</span></label>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" value="{{ old  ('password') }}" required>
                        {!! $errors->first('password', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('user.create') }}" class="btn btn-success">
                    <a href="{{ route('users.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
