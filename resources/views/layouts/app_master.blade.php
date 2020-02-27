@extends('layouts.app')

@section('title')
@yield('subtitle', __('app.master'))
@endsection

@section('content')
<div class="row">
    <div class="col-md-2">
        @include('layouts.partials.master_nav')
    </div>
    <div class="col-md-10">
        @yield('content-master')
    </div>
</div>
@endsection
