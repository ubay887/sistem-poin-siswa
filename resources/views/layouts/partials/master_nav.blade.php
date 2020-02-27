<h4 class="page-title mb-4">{{ __('nav_menu.master_data') }}</h4>
<div class="list-group list-group-transparent mb-0">
    <a href="{{ route('class_names.index') }}" style="padding: 8px" class="list-group-item list-group-item-action d-flex align-items-center {{ in_array(Request::segment(2), ['class_names', null]) ? 'active' : '' }}">
        <span class="icon mr-2"><i class="fe fe-bookmark"></i></span>{{ __('class_name.class_name') }}
    </a>
</div>
