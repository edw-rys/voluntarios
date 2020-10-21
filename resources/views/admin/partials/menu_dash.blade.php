<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" style="height: 100vh" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $route_name == 'admin.dashboard' ? 'active' :'' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p class="f-s-9em">
                    {{ trans('global.menu.dashboard') }}
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.voluntarios.create') }}" class="nav-link {{ $route_name == 'admin.ingreso' ? 'active' :'' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p class="f-s-9em">
                    {{ trans('global.menu.ingreso') }}
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.voluntarios.index') }}" class="nav-link {{ $route_name == 'admin.voluntarios.index' ? 'active' :'' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p class="f-s-9em">
                    {{ trans('global.menu.voluntariado') }}
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.evaluaciones.index') }}" class="nav-link {{ $route_name == 'admin.evaluaciones.index' ? 'active' :'' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p class="f-s-9em">
                    {{ trans('global.menu.evaluaciones') }}
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.certificados.index') }}" class="nav-link {{ $route_name == 'admin.certificados.index' ? 'active' :'' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p class="f-s-9em">
                    {{ trans('global.menu.certificates') }}
                </p>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a href="{{ route('admin.evaluaciones_depa') }}" class="nav-link {{ $route_name == 'admin.evaluaciones_depa' ? 'active' :'' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p class="f-s-9em">
                    {{ trans('global.menu.evaluaciones_depa') }}
                </p>
            </a>
        </li> --}}
        <li class="nav-header border-t-menu">
            <button class="btn btn-warning" onclick="logout()">
                <i class="fas fa-sign-out-alt"></i>
                <span class="font-0-92">
                    {{ trans('global.menu.logout') }}
                </span>
            </button>
        </li>

    </ul>
</nav>

<script>
    function logout() {
        $("#logoutform").trigger("submit");
    }
</script>
<!-- /.sidebar-menu -->
