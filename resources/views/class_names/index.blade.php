@extends('layouts.app')

@section('title', __('class_name.list'))

@section('content')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Entities\Classes\ClassName)
            <a href="{{ route('class_names.index', ['action' => 'create']) }}" class="btn btn-success">{{ __('class_name.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('class_name.list') }} <small>{{ __('app.total') }} : {{ $classNames->total() }} {{ __('class_name.class_name') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('class_name.search') }}</label>
                        <input placeholder="{{ __('class_name.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('class_name.search') }}" class="btn btn-secondary">
                    <a href="{{ route('class_names.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('class_name.name') }}</th>
                        <th>{{ __('class_name.description') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classNames as $key => $className)
                    <tr>
                        <td class="text-center">{{ $classNames->firstItem() + $key }}</td>
                        <td>{{ $className->name }}</td>
                        <td>{{ $className->description }}</td>
                        <td class="text-center">
                            @can('update', $className)
                                <a href="{{ route('class_names.index', ['action' => 'edit', 'id' => $className->id] + Request::only('page', 'q')) }}" id="edit-class_name-{{ $className->id }}">{{ __('app.edit') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $classNames->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
    <div class="col-md-4">
        @if(Request::has('action'))
        @include('class_names.forms')
        @endif
    </div>
</div>
@endsection
