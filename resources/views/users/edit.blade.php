@extends('layouts.app')

@section('title', __('user.edit'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if (request('action') == 'delete' && $user)
        @can('delete', $user)
            <div class="card">
                <div class="card-header">{{ __('user.delete') }}</div>
                <div class="card-body">
                    <label class="form-label text-primary">{{ __('user.name') }}</label>
                    <p>{{ $user->name }}</p>
                    <label class="form-label text-primary">{{ __('user.description') }}</label>
                    <p>{{ $user->description }}</p>
                    {!! $errors->first('user_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
                <hr style="margin:0">
                <div class="card-body text-danger">{{ __('user.delete_confirm') }}</div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('users.destroy', $user) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                        {{ csrf_field() }} {{ method_field('delete') }}
                        <input name="user_id" type="hidden" value="{{ $user->id }}">
                        <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
                    </form>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </div>
        @endcan
        @else
        <div class="card">
            <div class="card-header">{{ __('user.edit') }}</div>
            <form method="POST" action="{{ route('users.update', $user) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('user.name') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $user->name) }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('user.description') }}</label>
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $user->description) }}</textarea>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('user.update') }}" class="btn btn-success">
                    <a href="{{ route('users.show', $user) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    @can('delete', $user)
                        <a href="{{ route('users.edit', [$user, 'action' => 'delete']) }}" id="del-user-{{ $user->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
