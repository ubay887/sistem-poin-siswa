<div class="col-lg order-lg-first">
    <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}"><i class="fe fe-home"></i> {{ __('nav_menu.dashboard') }}</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('schools.page') }}" class="nav-link {{ Request::routeIs('schools.page') ? 'active' : '' }}"><i class="fe fe-edit"></i> {{ __('school.school') }}</a>
        </li>
    </ul>
</div>
