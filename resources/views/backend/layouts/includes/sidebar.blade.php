<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                {{-- Dashboard --}}
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="{{ Route::is('dashboard') ? 'active' : '' }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                {{-- Administration --}}
                @canany(['list-role', 'list-user'])
                    @php
                        $adminOpen = Route::is('roles.*') || Route::is('users.*') || Route::is('permissions.*') || Route::is('role.permissions');
                    @endphp
                    <li class="{{ $adminOpen ? 'mm-active' : '' }}">
                        <a href="javascript: void(0);" class="has-arrow {{ $adminOpen ? 'active' : '' }}"
                            aria-expanded="{{ $adminOpen ? 'true' : 'false' }}">
                            <i data-feather="settings"></i>
                            <span>Administration</span>
                        </a>
                        <ul class="sub-menu {{ $adminOpen ? 'show mm-show' : '' }}">
                            @can('list-role')
                                <li><a href="{{ route('permissions.index') }}" class="{{ Route::is('permissions.*') ? 'active' : '' }}">Permissions</a></li>
                                <li><a href="{{ route('roles.index') }}" class="{{ Route::is('roles.*') || Route::is('role.permissions') ? 'active' : '' }}">Roles</a></li>
                            @endcan
                            @can('list-user')
                                <li><a href="{{ route('users.index') }}" class="{{ Route::is('users.*') ? 'active' : '' }}">Users</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcanany

                {{-- Settings --}}
                @can('update-setting')
                    <li>
                        <a href="{{ route('settings.index') }}"
                            class="{{ Route::is('settings.*') ? 'active' : '' }}">
                            <i data-feather="tool"></i>
                            <span>Settings</span>
                        </a>
                    </li>
                @endcan

            </ul>
        </div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->