@extends('layouts.app_master')

@section('title', __('student.create'))

@section('content-master')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('student.create') }}</div>
            <form method="POST" action="{{ route('students.store') }}" accept-charset="UTF-8">
                {{ csrf_field() }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="nis" class="form-label">{{ __('student.nis') }} <span class="form-required">*</span></label>
                        <input id="nis" type="text" class="form-control{{ $errors->has('nis') ? ' is-invalid' : '' }}" name="nis" value="{{ old('nis') }}" required>
                        {!! $errors->first('nis', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="nisn" class="form-label">{{ __('student.nisn') }} <span class="form-required">*</span></label>
                        <input id="nisn" type="text" class="form-control{{ $errors->has('nisn') ? ' is-invalid' : '' }}" name="nisn" value="{{ old('nisn') }}" required>
                        {!! $errors->first('nisn', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('student.name') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="pob" class="form-label">{{ __('student.pob') }} <span class="form-required">*</span></label>
                        <input id="pob" type="text" class="form-control{{ $errors->has('pob') ? ' is-invalid' : '' }}" name="pob" value="{{ old('pob') }}" required>
                        {!! $errors->first('pob', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="dob" class="form-label">{{ __('student.dob') }} <span class="form-required">*</span></label>
                        <input id="dob" type="text" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" value="{{ old('dob') }}" required>
                        {!! $errors->first('dob', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="gender_id" class="form-label">{{ __('student.gender_id') }} <span class="form-required">*</span></label>
                        <input id="gender_id" type="text" class="form-control{{ $errors->has('gender_id') ? ' is-invalid' : '' }}" name="gender_id" value="{{ old('gender_id') }}" required>
                        {!! $errors->first('gender_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="religion_id" class="form-label">{{ __('student.religion_id') }} <span class="form-required">*</span></label>
                        <input id="religion_id" type="text" class="form-control{{ $errors->has('religion_id') ? ' is-invalid' : '' }}" name="religion_id" value="{{ old('religion_id') }}" required>
                        {!! $errors->first('religion_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="phone" class="form-label">{{ __('student.phone') }} <span class="form-required">*</span></label>
                        <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>
                        {!! $errors->first('phone', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">{{ __('student.email') }} <span class="form-required">*</span></label>
                        <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                        {!! $errors->first('email', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-label">{{ __('student.address') }}</label>
                        <textarea id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" rows="4">{{ old('address') }}</textarea>
                        {!! $errors->first('address', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="class_id" class="form-label">{{ __('student.class_id') }} <span class="form-required">*</span></label>
                        <input id="class_id" type="text" class="form-control{{ $errors->has('class_id') ? ' is-invalid' : '' }}" name="class_id" value="{{ old('class_id') }}" required>
                        {!! $errors->first('class_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="father_name" class="form-label">{{ __('student.father_name') }} <span class="form-required">*</span></label>
                        <input id="father_name" type="text" class="form-control{{ $errors->has('father_name') ? ' is-invalid' : '' }}" name="father_name" value="{{ old('father_name') }}" required>
                        {!! $errors->first('father_name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="father_phone" class="form-label">{{ __('student.father_phone') }} <span class="form-required">*</span></label>
                        <input id="father_phone" type="text" class="form-control{{ $errors->has('father_phone') ? ' is-invalid' : '' }}" name="father_phone" value="{{ old('father_phone') }}" required>
                        {!! $errors->first('father_phone', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="mother_name" class="form-label">{{ __('student.mother_name') }} <span class="form-required">*</span></label>
                        <input id="mother_name" type="text" class="form-control{{ $errors->has('mother_name') ? ' is-invalid' : '' }}" name="mother_name" value="{{ old('mother_name') }}" required>
                        {!! $errors->first('mother_name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="mother_phone" class="form-label">{{ __('student.mother_phone') }} <span class="form-required">*</span></label>
                        <input id="mother_phone" type="text" class="form-control{{ $errors->has('mother_phone') ? ' is-invalid' : '' }}" name="mother_phone" value="{{ old('mother_phone') }}" required>
                        {!! $errors->first('mother_phone', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="wali_name" class="form-label">{{ __('student.wali_name') }} <span class="form-required">*</span></label>
                        <input id="wali_name" type="text" class="form-control{{ $errors->has('wali_name') ? ' is-invalid' : '' }}" name="wali_name" value="{{ old('wali_name') }}" required>
                        {!! $errors->first('wali_name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="wali_relation" class="form-label">{{ __('student.wali_relation') }} <span class="form-required">*</span></label>
                        <input id="wali_relation" type="text" class="form-control{{ $errors->has('wali_relation') ? ' is-invalid' : '' }}" name="wali_relation" value="{{ old('wali_relation') }}" required>
                        {!! $errors->first('wali_relation', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="wali_phone" class="form-label">{{ __('student.wali_phone') }} <span class="form-required">*</span></label>
                        <input id="wali_phone" type="text" class="form-control{{ $errors->has('wali_phone') ? ' is-invalid' : '' }}" name="wali_phone" value="{{ old('wali_phone') }}" required>
                        {!! $errors->first('wali_phone', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('student.create') }}" class="btn btn-success">
                    <a href="{{ route('students.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
