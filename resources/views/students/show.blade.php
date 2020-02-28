@extends('layouts.app_master')

@section('title', __('student.detail'))

@section('content-master')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('student.detail_student') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('student.name') }}</td><td>{{ $student->name }}</td></tr>
                        <tr><td>{{ __('student.nis') }}</td><td>{{ $student->nis }}</td></tr>
                        <tr><td>{{ __('student.nisn') }}</td><td>{{ $student->nisn }}</td></tr>
                        <tr><td>{{ __('student.pob') }}</td><td>{{ $student->pob }}</td></tr>
                        <tr><td>{{ __('student.dob') }}</td><td>{{ $student->dob }}</td></tr>
                        <tr><td>{{ __('student.gender_id') }}</td><td>{{ $student->gender }}</td></tr>
                        <tr><td>{{ __('student.religion_id') }}</td><td>{{ $student->religion }}</td></tr>
                        <tr><td>{{ __('student.phone') }}</td><td>{{ $student->phone }}</td></tr>
                        <tr><td>{{ __('student.email') }}</td><td>{{ $student->email }}</td></tr>
                        <tr><td>{{ __('student.address') }}</td><td>{{ $student->address }}</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">{{ __('student.detail_parent') }}</div>
            <div class="card-body">
                <table class="table table-sm">
                    <tbody>
                        <tr><td>{{ __('student.father_name') }}</td><td>{{ $student->father_name }}</td></tr>
                        <tr><td>{{ __('student.father_phone') }}</td><td>{{ $student->father_phone }}</td></tr>
                        <tr><td>{{ __('student.mother_name') }}</td><td>{{ $student->mother_name }}</td></tr>
                        <tr><td>{{ __('student.mother_phone') }}</td><td>{{ $student->mother_phone }}</td></tr>
                        <tr><td>{{ __('student.wali_name') }}</td><td>{{ $student->wali_name }}</td></tr>
                        <tr><td>{{ __('student.wali_relation') }}</td><td>{{ $student->wali_relation }}</td></tr>
                        <tr><td>{{ __('student.wali_phone') }}</td><td>{{ $student->wali_phone }}</td></tr>
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
