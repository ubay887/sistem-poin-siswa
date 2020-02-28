@extends('layouts.app_master')

@section('title', __('student.list'))

@section('content-master')
<div class="mb-3">
    <div class="float-right">
        @can('create', new App\Entities\Students\Student)
            <a href="{{ route('students.create') }}" class="btn btn-success">{{ __('student.create') }}</a>
        @endcan
    </div>
    <h1 class="page-title">{{ __('student.list') }} <small>{{ __('app.total') }} : {{ $students->total() }} {{ __('student.student') }}</small></h1>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                    <div class="form-group">
                        <label for="q" class="form-label">{{ __('student.search') }}</label>
                        <input placeholder="{{ __('student.search_text') }}" name="q" type="text" id="q" class="form-control mx-sm-2" value="{{ request('q') }}">
                    </div>
                    <input type="submit" value="{{ __('student.search') }}" class="btn btn-secondary">
                    <a href="{{ route('students.index') }}" class="btn btn-link">{{ __('app.reset') }}</a>
                </form>
            </div>
            <table class="table table-sm table-responsive-sm table-hover">
                <thead>
                    <tr>
                        <th class="text-center">{{ __('app.table_no') }}</th>
                        <th>{{ __('student.nis') }}</th>
                        <th>{{ __('student.name') }}</th>
                        <th>{{ __('student.pob') }}</th>
                        <th>{{ __('student.dob') }}</th>
                        <th>{{ __('student.gender_id') }}</th>
                        <th>{{ __('student.religion_id') }}</th>
                        <th>{{ __('student.phone') }}</th>
                        <th>{{ __('student.email') }}</th>
                        <th class="text-center">{{ __('app.action') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $key => $student)
                    <tr>
                        <td class="text-center">{{ $students->firstItem() + $key }}</td>
                        <td>{{ $student->nis }}</td>
                        <td>{!! $student->name_link !!}</td>
                        <td>{{ $student->pob }}</td>
                        <td>{{ $student->dob }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>{{ $student->religion }}</td>
                        <td>{{ $student->phone }}</td>
                        <td>{{ $student->email }}</td>
                        <td class="text-center">
                            @can('view', $student)
                                <a href="{{ route('students.show', $student) }}" id="show-student-{{ $student->id }}">{{ __('app.show') }}</a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-body">{{ $students->appends(Request::except('page'))->render() }}</div>
        </div>
    </div>
</div>
@endsection
