<h4 class="page-title mb-4">{{ __('nav_menu.settings') }}</h4>
<div class="list-group list-group-transparent mb-0">
    <a href="{{ route('options.page') }}" style="padding: 8px" class="list-group-item list-group-item-action d-flex align-items-center {{ in_array(Request::segment(2), ['options', null]) ? 'active' : '' }}">
        <span class="icon mr-2"><i class="fe fe-bookmark"></i></span>{{ __('site_option.option') }}
    </a>
</div>
