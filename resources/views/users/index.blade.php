@extends('layouts.app')

@section('title', __('user.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\User)
            <a href="{{ route('users.create') }}" class="btn btn-success">{{ __('user.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('user.list') }} <small>{{ __('app.total') }} : {{ $users->total() }} {{ __('user.user') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('user.search') }}</label>
                        <input placeholder="{{ __('user.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('user.search') }}" class="btn btn-secondary">
                    <a href="{{ route('users.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('user.name') }}</th>
                        <th>{{ __('user.description') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                    <tr>
                        <td class="text-center">{{ $users->firstItem() + $key }}</td>
                        <td>{!! $user->name_link !!}</td>
                        <td>{{ $user->description }}</td>
                        <td class="text-center">
                            @can('view', $user)
                                <a href="{{ route('users.show', $user) }}" id="show-user-{{ $user->id }}">{{ __('app.show') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $users->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
@endsection
