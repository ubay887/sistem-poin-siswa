@if (Request::get('action') == 'create')
@can('create', new App\Entities\Classes\ClassName)
    <form method="POST" action="{{ route('class_names.store') }}" accept-charset="UTF-8">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="level_id" class="form-label">{{ __('class_name.level_id') }} <span class="form-required">*</span></label>
            <select name="level_id" id="level_id" class="form-control" required>
                <option value="">-- {{ __('class_name.list') }} --</option>
                @foreach (App\Entities\Classes\Level::$lists as $typeId => $typeName)
                    <option value="{{ $typeId }}">{{ __('class_name.'.$typeName) }}</option>
                @endforeach
            </select>
            {!! $errors->first('level_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="name" class="form-label">{{ __('class_name.name') }} <span class="form-required">*</span></label>
            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
            {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('class_name.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description') }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input type="submit" value="{{ __('class_name.create') }}" class="btn btn-success">
        <a href="{{ route('class_names.index') }}" class="btn btn-link">{{ __('app.cancel') }}</a>
    </form>
@endcan
@endif
@if (Request::get('action') == 'edit' && $editableClassName)
@can('update', $editableClassName)
    <form method="POST" action="{{ route('class_names.update', $editableClassName) }}" accept-charset="UTF-8">
        {{ csrf_field() }} {{ method_field('patch') }}
        <div class="form-group">
            <label for="level_id" class="form-label">{{ __('class_name.level_id') }} <span class="form-required">*</span></label>
            <select name="level_id" id="level_id" class="form-control" required>
                <option value="">-- {{ __('class_name.list') }} --</option>
                @foreach (App\Entities\Classes\Level::$lists as $typeId => $typeName)
                    <option value="{{ $typeId }}" {{ $typeId == $editableClassName->level_id ? 'selected' : '' }}>{{ __('class_name.'.$typeName) }}</option>
                @endforeach
            </select>
            {!! $errors->first('level_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="name" class="form-label">{{ __('class_name.name') }} <span class="form-required">*</span></label>
            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $editableClassName->name) }}" required>
            {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <div class="form-group">
            <label for="description" class="form-label">{{ __('class_name.description') }}</label>
            <textarea id="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" rows="4">{{ old('description', $editableClassName->description) }}</textarea>
            {!! $errors->first('description', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <input name="page" value="{{ request('page') }}" type="hidden">
        <input name="q" value="{{ request('q') }}" type="hidden">
        <input type="submit" value="{{ __('class_name.update') }}" class="btn btn-success">
        <a href="{{ route('class_names.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        @can('delete', $editableClassName)
            <a href="{{ route('class_names.index', ['action' => 'delete', 'id' => $editableClassName->id] + Request::only('page', 'q')) }}" id="del-class_name-{{ $editableClassName->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
        @endcan
    </form>
@endcan
@endif
@if (Request::get('action') == 'delete' && $editableClassName)
@can('delete', $editableClassName)
    <div class="card">
        <div class="card-header">{{ __('class_name.delete') }}</div>
        <div class="card-body">
            <label class="form-label text-primary">{{ __('class_name.level_id') }}</label>
            <p>{{ $editableClassName->level_id }}</p>
            <label class="form-label text-primary">{{ __('class_name.name') }}</label>
            <p>{{ $editableClassName->name }}</p>
            <label class="form-label text-primary">{{ __('class_name.description') }}</label>
            <p>{{ $editableClassName->description }}</p>
            {!! $errors->first('class_name_id', '<span class="invalid-feedback" role="alert">:message</span>') !!}
        </div>
        <hr style="margin:0">
        <div class="card-body text-danger">{{ __('class_name.delete_confirm') }}</div>
        <div class="card-footer">
            <form method="POST" action="{{ route('class_names.destroy', $editableClassName) }}" accept-charset="UTF-8" onsubmit="return confirm(&quot;{{ __('app.delete_confirm') }}&quot;)" class="del-form float-right" style="display: inline;">
                {{ csrf_field() }} {{ method_field('delete') }}
                <input name="class_name_id" type="hidden" value="{{ $editableClassName->id }}">
                <input name="page" value="{{ request('page') }}" type="hidden">
                <input name="q" value="{{ request('q') }}" type="hidden">
                <button type="submit" class="btn btn-danger">{{ __('app.delete_confirm_button') }}</button>
            </form>
            <a href="{{ route('class_names.index', Request::only('q', 'page')) }}" class="btn btn-link">{{ __('app.cancel') }}</a>
        </div>
    </div>
@endcan
@endif
