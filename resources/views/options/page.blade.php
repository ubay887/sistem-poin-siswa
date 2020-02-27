@extends('layouts.app_setting')

@section('title', __('option.create_option'))

@section('content-setting')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                {{ __('option.create_option') }}
            </div>
            <form method="POST" action="{{ route('options.save') }}" accept-charset="UTF-8">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="option_name" class="form-label">{{ __('option.name') }} <span class="form-required">*</span></label>
                        <input id="option_name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="option_name" value="{{ Option::get('option_name', '') }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="option_email" class="form-label">{{ __('option.email') }}</label>
                                <input id="option_email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="option_email" value="{{ Option::get('option_email', '') }}">
                                {!! $errors->first('email', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="option_web" class="form-label">{{ __('option.web') }}</label>
                                <input id="option_web" type="text" class="form-control{{ $errors->has('web') ? ' is-invalid' : '' }}" name="option_web" value="{{ Option::get('option_web', '') }}">
                                {!! $errors->first('web', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="option_address" class="form-label">{{ __('option.address') }} <span class="form-required">*</span></label>
                        <textarea id="option_address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="option_address" rows="3" required>{{ Option::get('option_address', '') }}</textarea>
                        {!! $errors->first('address', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="option_district" class="form-label">{{ __('option.district') }} <span class="form-required">*</span></label>
                                <input id="option_district" type="text" class="form-control{{ $errors->has('district') ? ' is-invalid' : '' }}" name="option_district" value="{{ Option::get('option_district', '') }}" required>
                                {!! $errors->first('district', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="option_province" class="form-label">{{ __('option.province') }} <span class="form-required">*</span></label>
                                <input id="option_province" type="text" class="form-control{{ $errors->has('province') ? ' is-invalid' : '' }}" name="option_province" value="{{ Option::get('option_province', '') }}" required>
                                {!! $errors->first('province', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="option_pos" class="form-label">{{ __('option.pos') }}</label>
                                <input id="option_pos" type="text" class="form-control{{ $errors->has('pos') ? ' is-invalid' : '' }}" name="option_pos" value="{{ Option::get('option_pos', '') }}">
                                {!! $errors->first('pos', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="option_phone" class="form-label">{{ __('option.phone') }}</label>
                                <input id="option_phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="option_phone" value="{{ Option::get('option_phone', '') }}">
                                {!! $errors->first('phone', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div style="text-align: right">
                        <input type="submit" value="{{ __('option.update') }}" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                {{ __('option.create_logo') }}
            </div>
            <form method="POST" action="{{ route('options.uploadlogo') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card-body" style="padding-top: 2px; padding-bottom: 0px;">
                    @if (Option::get('option_logo'))
                        <img src="{{ asset('images/'.Option::get('option_logo')) }}" alt="" style="padding: 20px" width="100%">
                    @else
                        <img src="{{ asset('images/sample_logo.png') }}" alt="" width="100%">
                    @endif
                    <div class="form-group">
                        <input id="search_logo" type="file" class="form-control{{ $errors->has('search_logo') ? ' is-invalid' : '' }}" name="search_logo" style="height: 43px" required>
                        {!! $errors->first('search_logo', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                </div>
                <br>
                <div class="card-footer">
                    <div style="text-align: right">
                        <input type="submit" value="{{ __('option.upload_logo') }}" class="btn btn-primary" id="upload_logo">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
