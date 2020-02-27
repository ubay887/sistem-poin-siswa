@extends('layouts.app')

@section('title', __('user.profile'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">@yield('title')</div>
            <table class="table table-md card-table">
                <tbody>
                    <tr><td>{{ __('user.name') }}</td><td>{{ $user->name }}</td></tr>
                    <tr><td>{{ __('user.username') }}</td><td>{{ $user->username }}</td></tr>
                    <tr><td>{{ __('user.email') }}</td><td>{{ $user->email }}</td></tr>
                    <tr><td>{{ __('user.role_id') }}</td><td>{{ $user->role }}</td></tr>
                </tbody>
            </table>
            <div class="card-footer">
                <a href="{{ route('profile.edit') }}" class="btn btn-success" id="edit-user-{{ $user->id }}">{{ __('user.profile_edit') }}</a>
                <a href="{{ route('dashboard') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
