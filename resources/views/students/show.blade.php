@extends('layouts.app_master')

@section('title', __('student.detail'))

@section('content-master')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('student.detail') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('student.name') }}</td><td>{{ $student->name }}</td></tr>
                        <tr><td>{{ __('student.description') }}</td><td>{{ $student->description }}</td></tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                @can('update', $student)
                    <a href="{{ route('students.edit', $student) }}" id="edit-student-{{ $student->id }}" class="btn btn-warning">{{ __('student.edit') }}</a>
                @endcan
                <a href="{{ route('students.index') }}" class="btn btn-link">{{ __('student.back_to_index') }}</a>
            </div>
        </div>
    </div>
</div>
@endsection
