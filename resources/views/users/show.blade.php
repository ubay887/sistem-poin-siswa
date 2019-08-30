@extends('layouts.app')

@section('title', __('user.detail'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('user.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('user.name') }}</td><td>{{ $user->name }}</td></tr>
                        <tr><td>{{ __('user.email') }}</td><td>{{ $user->email }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $user)
                    <a href="{{ route('users.edit', $user) }}" id="edit-user-{{ $user->id }}" class="btn btn-warning">{{ __('user.edit') }}</a>
                @endcan
                <a href="{{ route('users.index') }}" class="btn btn-link">{{ __('user.back_to_index') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
