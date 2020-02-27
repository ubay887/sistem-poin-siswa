@extends('layouts.app')

@section('title', __('user.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('user.detail') }}</div>
            <div class="card-body">
                <table class="table table-md">
                    <tbody>
                        <tr><td>{{ __('user.name') }}</td><td>{{ $user->name }}</td></tr>
                        <tr><td>{{ __('user.username') }}</td><td>{{ $user->username }}</td></tr>
                        <tr><td>{{ __('user.email') }}</td><td>{{ $user->email }}</td></tr>
                        <tr><td>{{ __('user.role_id') }}</td><td>{{ $user->role }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $user)
                    <a href="{{ route('users.edit', $user) }}" id="edit-user-{{ $user->id }}" class="btn btn-warning">{{ __('user.edit') }}</a>
                    @php
                        $confirm = $user->is_active == 1 ? __('user.suspend_confirm') : __('user.activate_confirm');
                        $buttonName = $user->is_active == 1 ? __('user.suspend') : __('user.activate');
                        $buttonClass = $user->is_active == 1 ? 'danger' : 'primary';
                    @endphp
                    <form method="POST" action="{{ route('users.activate', $user) }}" accept-charset="UTF-8" onsubmit="return confirm('{{ $confirm }}')" class="del-form" style="display: inline;">
                        {{ csrf_field() }} {{ method_field('patch') }}
                        <button type="submit" class="btn btn-{{ $buttonClass }}" id="status-user">{{ $buttonName }}</button>
                    </form>
                @endcan
                <a href="{{ route('users.index') }}" class="btn btn-link">{{ __('user.back_to_index') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
