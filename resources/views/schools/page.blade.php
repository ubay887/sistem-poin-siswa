@extends('layouts.app')

@section('title', __('school.create_school'))

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                {{ __('school.create_school') }}
                @if ($school)
                <div class="card-options">
                    <form method="POST" action="{{ route('schools.destroy', $school) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                        {{ csrf_field() }} {{ method_field('delete') }}
                        <input name="school_id" type="hidden" value="{{ $school->id }}">
                        <button type="submit" class="btn btn-danger btn-sm">{{ __('app.delete') }}</button>
                    </form>
                </div>
                @endif
            </div>
                @if ($school)
                    <form method="POST" action="{{ route('schools.update', $school) }}" accept-charset="UTF-8">
                    {{ csrf_field() }} {{ method_field('patch') }}
                @else
                    <form method="POST" action="{{ route('schools.store') }}" accept-charset="UTF-8">
                    {{ csrf_field() }}
                @endif
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('school.name') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $school ? $school->name : '') }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-label">{{ __('school.address') }} <span class="form-required">*</span></label>
                        <textarea id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" rows="3">{{ old('address', $school ? $school->address : '') }}</textarea>
                        {!! $errors->first('address', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="district" class="form-label">{{ __('school.district') }} <span class="form-required">*</span></label>
                                <input id="district" type="text" class="form-control{{ $errors->has('district') ? ' is-invalid' : '' }}" name="district" value="{{ old('district', $school ? $school->district : '') }}" required>
                                {!! $errors->first('district', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="province" class="form-label">{{ __('school.province') }} <span class="form-required">*</span></label>
                                <input id="province" type="text" class="form-control{{ $errors->has('province') ? ' is-invalid' : '' }}" name="province" value="{{ old('province', $school ? $school->province : '') }}" required>
                                {!! $errors->first('province', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pos" class="form-label">{{ __('school.pos') }}</label>
                                <input id="pos" type="text" class="form-control{{ $errors->has('pos') ? ' is-invalid' : '' }}" name="pos" value="{{ old('pos', $school ? $school->pos : '') }}">
                                {!! $errors->first('pos', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone" class="form-label">{{ __('school.phone') }}</label>
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone', $school ? $school->phone : '') }}">
                                {!! $errors->first('phone', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email" class="form-label">{{ __('school.email') }}</label>
                                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', $school ? $school->email : '') }}">
                                {!! $errors->first('email', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="web" class="form-label">{{ __('school.web') }}</label>
                                <input id="web" type="text" class="form-control{{ $errors->has('web') ? ' is-invalid' : '' }}" name="web" value="{{ old('web', $school ? $school->web : '') }}">
                                {!! $errors->first('web', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('school.description') }}</label>
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="3">{{ old('description', $school ? $school->description : '') }}</textarea>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                </div>
                <div class="card-footer">
                    @if ($school)
                        <input type="submit" value="{{ __('school.update') }}" class="btn btn-primary">
                    @else
                        <input type="submit" value="{{ __('school.create') }}" class="btn btn-success">
                    @endif
                    <a href="{{ route('home') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
    @if ($school)
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{ __('school.create_logo') }}
                    @if ($school->logo != null)
                    <div class="card-options">
                        <form method="POST" action="{{ route('schools.destroylogo', $school) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                            {{ csrf_field() }} {{ method_field('delete') }}
                            <input name="school_id" type="hidden" value="{{ $school->id }}">
                            <input type="submit" value="{{ __('app.delete') }}" class="btn btn-danger btn-sm" id="delete_logo">
                        </form>
                    </div>
                    @endif
                </div>
                <form method="POST" action="{{ route('schools.uploadlogo', $school) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="card-body" style="padding-top: 2px; padding-bottom: 0px;">
                        @if ($school->logo == null)
                            <img src="{{ asset('images/sample_logo.png') }}" alt="" width="100%">
                        @else
                            <img src="{{ asset('/storage/images/'.$school->logo) }}" alt="" width="100%">
                        @endif
                        <div class="form-group">
                            <input id="search_logo" type="file" class="form-control{{ $errors->has('search_logo') ? ' is-invalid' : '' }}" name="search_logo" style="height: 42px" required>
                            {!! $errors->first('search_logo', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                        </div>
                    </div>
                    <br>
                    <div class="card-footer">
                        <input type="submit" value="{{ __('school.upload_logo') }}" class="btn btn-primary" id="upload_logo">
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
@endsection
