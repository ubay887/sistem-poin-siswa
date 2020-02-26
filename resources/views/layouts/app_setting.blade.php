@extends('layouts.app')

@section('title')
@yield('subtitle', __('app.setting'))
@endsection

@section('content')
<div class="row">
    <div class="col-md-2">
        @include('layouts.partials.setting_nav')
    </div>
    <div class="col-md-10">
        @yield('content-setting')
    </div>
</div>
@endsection
