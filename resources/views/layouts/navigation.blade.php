<ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('home') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-speedometer') }}"></use>
            </svg>
            {{ __('Dashboard') }}
        </a>
    </li>

    @can('manage users')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('users.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-user') }}"></use>
            </svg>
            {{ __('Users') }}
        </a>
    </li>
    @endcan


    <li class="nav-item">
        <a class="nav-link" href="{{ route('clients.index') }}">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-people') }}"></use>
            </svg>
            {{ __('Clients') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-paperclip') }}"></use>
            </svg>
            {{ __('Projects') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="">
            <svg class="nav-icon">
                <use xlink:href="{{ asset('icons/coreui.svg#cil-list-high-priority') }}"></use>
            </svg>
            {{ __('Tasks') }}
        </a>
    </li>

</ul>
