@extends('layouts.app')

@section('title', __('school.create_school'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                {{ __('school.create_school') }}
            </div>

            <form method="POST" action="{{ route('schools.save') }}" accept-charset="UTF-8">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="school_name" class="form-label">{{ __('school.name') }} <span class="form-required">*</span></label>
                        <input id="school_name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="school_name" value="" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="school_address" class="form-label">{{ __('school.address') }} <span class="form-required">*</span></label>
                        <textarea id="school_address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="school_address" rows="3" required></textarea>
                        {!! $errors->first('address', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="school_district" class="form-label">{{ __('school.district') }} <span class="form-required">*</span></label>
                                <input id="school_district" type="text" class="form-control{{ $errors->has('district') ? ' is-invalid' : '' }}" name="school_district" value="" required>
                                {!! $errors->first('district', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="school_province" class="form-label">{{ __('school.province') }} <span class="form-required">*</span></label>
                                <input id="school_province" type="text" class="form-control{{ $errors->has('province') ? ' is-invalid' : '' }}" name="school_province" value="" required>
                                {!! $errors->first('province', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="school_pos" class="form-label">{{ __('school.pos') }}</label>
                                <input id="school_pos" type="text" class="form-control{{ $errors->has('pos') ? ' is-invalid' : '' }}" name="school_pos" value="">
                                {!! $errors->first('pos', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="school_phone" class="form-label">{{ __('school.phone') }}</label>
                                <input id="school_phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="school_phone" value="">
                                {!! $errors->first('phone', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="school_email" class="form-label">{{ __('school.email') }}</label>
                                <input id="school_email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="school_email" value="">
                                {!! $errors->first('email', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="school_web" class="form-label">{{ __('school.web') }}</label>
                                <input id="school_web" type="text" class="form-control{{ $errors->has('web') ? ' is-invalid' : '' }}" name="school_web" value="">
                                {!! $errors->first('web', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                <input type="submit" value="{{ __('school.update') }}" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
@endsection
