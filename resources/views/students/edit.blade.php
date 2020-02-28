@extends('layouts.app_master')

@section('title', __('student.edit'))

@section('content-master')
@if (request('action') == 'delete' && $student)
    @can('delete', $student)
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('student.delete') }}</div>
                <div class="card-body">
                    <label class="form-label text-primary">{{ __('student.nis') }}</label>
                    <p>{{ $student->nis }}</p>
                    <label class="form-label text-primary">{{ __('student.name') }}</label>
                    <p>{{ $student->name }}</p>
                    <label class="form-label text-primary">{{ __('student.pob').' / '.__('student.dob')}}</label>
                    <p>{{ $student->pob.' / '.$student->dob }}</p>
                    <label class="form-label text-primary">{{ __('student.gender_id') }}</label>
                    <p>{{ $student->gender }}</p>
                    {!! $errors->first('student_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                </div>
                <hr style="margin:0">
                <div class="card-body text-danger">{{ __('student.delete_confirm') }}</div>
                <div class="card-footer">
                    <form method="POST" action="{{ route('students.destroy', $student) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                        {{ csrf_field() }} {{ method_field('delete') }}
                        <input name="student_id" type="hidden" value="{{ $student->id }}">
                        <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
                    </form>
                    <a href="{{ route('students.edit', $student) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                </div>
            </div>
        </div>
    </div>
    @endcan
@else
    <form method="POST" action="{{ route('students.update', $student) }}" accept-charset="UTF-8">
    {{ csrf_field() }} {{ method_field('patch') }}
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('student.edit_student') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nis" class="form-label">{{ __('student.nis') }} <span class="form-required">*</span></label>
                                <input id="nis" type="text" class="form-control{{ $errors->has('nis') ? ' is-invalid' : '' }}" name="nis" value="{{ old('nis', $student->nis) }}" required>
                                {!! $errors->first('nis', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nisn" class="form-label">{{ __('student.nisn') }}</label>
                                <input id="nisn" type="text" class="form-control{{ $errors->has('nisn') ? ' is-invalid' : '' }}" name="nisn" value="{{ old('nisn', $student->nisn) }}">
                                {!! $errors->first('nisn', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('student.name') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $student->name) }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="pob" class="form-label">{{ __('student.pob') }}</label>
                                <input id="pob" type="text" class="form-control{{ $errors->has('pob') ? ' is-invalid' : '' }}" name="pob" value="{{ old('pob', $student->pob) }}">
                                {!! $errors->first('pob', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                            <div class="form-group">
                                <label for="dob" class="form-label">{{ __('student.dob') }}</label>
                                <input id="dob" type="text" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" value="{{ old('dob', $student->dob) }}">
                                {!! $errors->first('dob', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                            <div class="form-group">
                                <label for="class_id" class="form-label">{{ __('student.class_id') }} <span class="form-required">*</span></label>
                                <select name="class_id" id="class_id" class="form-control" required>
                                    <option value="">-- {{ __('class_name.list') }} --</option>
                                    @foreach ($classes as $key => $class)
                                        <option value="{{ $class->id }}" {{ $student->class_id == $class->id ? 'selected' : '' }}>{{ $class->level.' '.$class->name }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('class_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                            <div class="form-group">
                                <label for="phone" class="form-label">{{ __('student.phone') }}</label>
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone', $student->phone) }}">
                                {!! $errors->first('phone', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                            <div class="form-group">
                                <label for="email" class="form-label">{{ __('student.email') }}</label>
                                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', $student->email) }}">
                                {!! $errors->first('email', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="gender_id" class="form-label">{{ __('app.gender_id') }}  <span class="form-required">*</span></label>
                                <div class="form-group">
                                @foreach (App\Entities\References\Gender::$lists as $genderId => $genderType)
                                    <input type="radio" value="{{ $genderId }}" {{ $student->gender_id == $genderId ? 'checked' : '' }} id="gender_{{ $genderId }}" name="gender_id" >
                                    <label for="gender_{{ $genderId }}">{{ __('app.'.$genderType) }}</label><br>
                                @endforeach
                                </div>
                                {!! $errors->first('gender_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                            <div class="form-group">
                                <label for="religion_id" class="form-label">{{ __('app.religion_id') }}  <span class="form-required">*</span></label>
                                <div class="form-group">
                                @foreach (App\Entities\References\Religion::$lists as $religionId => $religionType)
                                    <input type="radio" value="{{ $religionId }}" {{ $student->religion_id == $religionId ? 'checked' : '' }} id="religion_{{ $religionId }}" name="religion_id" >
                                    <label for="religion_{{ $religionId }}">{{ __('app.'.$religionType) }}</label><br>
                                @endforeach
                                </div>
                                {!! $errors->first('religion_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="form-label">{{ __('student.address') }}</label>
                        <textarea id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" rows="3">{{ old('address', $student->address) }}</textarea>
                        {!! $errors->first('address', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('student.edit_parent') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="father_name" class="form-label">{{ __('student.father_name') }}</label>
                                <input id="father_name" type="text" class="form-control{{ $errors->has('father_name') ? ' is-invalid' : '' }}" name="father_name" value="{{ old('father_name', $student->father_name) }}">
                                {!! $errors->first('father_name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="father_phone" class="form-label">{{ __('student.father_phone') }}</label>
                                <input id="father_phone" type="text" class="form-control{{ $errors->has('father_phone') ? ' is-invalid' : '' }}" name="father_phone" value="{{ old('father_phone', $student->father_phone) }}">
                                {!! $errors->first('father_phone', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="mother_name" class="form-label">{{ __('student.mother_name') }}</label>
                                <input id="mother_name" type="text" class="form-control{{ $errors->has('mother_name') ? ' is-invalid' : '' }}" name="mother_name" value="{{ old('mother_name', $student->mother_name) }}">
                                {!! $errors->first('mother_name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="mother_phone" class="form-label">{{ __('student.mother_phone') }}</label>
                                <input id="mother_phone" type="text" class="form-control{{ $errors->has('mother_phone') ? ' is-invalid' : '' }}" name="mother_phone" value="{{ old('mother_phone', $student->mother_phone) }}">
                                {!! $errors->first('mother_phone', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="wali_name" class="form-label">{{ __('student.wali_name') }}</label>
                                <input id="wali_name" type="text" class="form-control{{ $errors->has('wali_name') ? ' is-invalid' : '' }}" name="wali_name" value="{{ old('wali_name', $student->wali_name) }}">
                                {!! $errors->first('wali_name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="wali_phone" class="form-label">{{ __('student.wali_phone') }}</label>
                                <input id="wali_phone" type="text" class="form-control{{ $errors->has('wali_phone') ? ' is-invalid' : '' }}" name="wali_phone" value="{{ old('wali_phone', $student->wali_phone) }}">
                                {!! $errors->first('wali_phone', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="wali_relation" class="form-label">{{ __('student.wali_relation') }}</label>
                                <input id="wali_relation" type="text" class="form-control{{ $errors->has('wali_relation') ? ' is-invalid' : '' }}" name="wali_relation" value="{{ old('wali_relation', $student->wali_relation) }}">
                                {!! $errors->first('wali_relation', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('student.update') }}" class="btn btn-success">
                    <a href="{{ route('students.show', $student) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    @can('delete', $student)
                        <a href="{{ route('students.edit', [$student, 'action' => 'delete']) }}" id="del-student-{{ $student->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    </form>
@endif
@endsection
