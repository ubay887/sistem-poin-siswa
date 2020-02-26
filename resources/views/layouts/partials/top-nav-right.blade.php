
<div class="dropdown">
    <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
        <span class="avatar avatar-placeholder"><img src="{{ asset('images/user.jpg') }}" class="header-brand-img" alt="User Logo"></span>
        <span class="ml-2 d-none d-lg-block">
            <span class="text-default">{{ auth()->user()->name }}</span>
            <small class="text-muted d-block mt-1">{{ auth()->user()->role }}</small>
        </span>
    </a>
    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
        <a class="dropdown-item" href="#">
            <i class="dropdown-icon fe fe-user"></i> {{ __('nav_menu.user_profile') }}
        </a>
        <a class="dropdown-item" href="#">
            <i class="dropdown-icon fe fe-lock"></i> {{ __('nav_menu.change_password') }}
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('users.index') }}">
            <i class="dropdown-icon fe fe-users"></i> {{ __('nav_menu.user_list') }}
        </a>
        <a class="dropdown-item" href="#">
            <i class="dropdown-icon fe fe-grid"></i> {{ __('nav_menu.master_data') }}
        </a>
        <a class="dropdown-item" href="#">
            <i class="dropdown-icon fe fe-settings"></i> {{ __('nav_menu.system_settings') }}
        </a>
        <a class="dropdown-item" href="#">
            <i class="dropdown-icon fe fe-database"></i> {{ __('nav_menu.backup_database') }}
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="dropdown-icon fe fe-log-out"></i> {{ __('nav_menu.logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </div>
</div>
