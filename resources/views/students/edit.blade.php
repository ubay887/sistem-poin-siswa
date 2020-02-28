@extends('layouts.app_master')

@section('title', __('student.edit'))

@section('content-master')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if (request('action') == 'delete' && $student)
        @can('delete', $student)
            <div class="card">
                <div class="card-header">{{ __('student.delete') }}</div>
                <div class="card-body">
                    <label class="form-label text-primary">{{ __('student.name') }}</label>
                    <p>{{ $student->name }}</p>
                    <label class="form-label text-primary">{{ __('student.description') }}</label>
                    <p>{{ $student->description }}</p>
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
        @endcan
        @else
        <div class="card">
            <div class="card-header">{{ __('student.edit') }}</div>
            <form method="POST" action="{{ route('students.update', $student) }}" accept-charset="UTF-8">
                {{ csrf_field() }} {{ method_field('patch') }}
                <div class="card-body">
                    <div class="form-group">
                        <label for="name" class="form-label">{{ __('student.name') }} <span class="form-required">*</span></label>
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $student->name) }}" required>
                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <label for="description" class="form-label">{{ __('student.description') }}</label>
                        <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $student->description) }}</textarea>
                        {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                    </div>
                </div>
                <div class="card-footer">
                    <input type="submit" value="{{ __('student.update') }}" class="btn btn-success">
                    <a href="{{ route('students.show', $student) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
                    @can('delete', $student)
                        <a href="{{ route('students.edit', [$student, 'action' => 'delete']) }}" id="del-student-{{ $student->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                    @endcan
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@endsection
