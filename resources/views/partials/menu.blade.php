<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs("admin.home") ? "active" : "" }}" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/audit-logs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/permissions*") ? "active" : "" }} {{ request()->is("admin/roles*") ? "active" : "" }} {{ request()->is("admin/users*") ? "active" : "" }} {{ request()->is("admin/audit-logs*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('audit_log_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.audit-logs.index") }}" class="nav-link {{ request()->is("admin/audit-logs") || request()->is("admin/audit-logs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.auditLog.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('master_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/kendaraans*") ? "menu-open" : "" }} {{ request()->is("admin/drivers*") ? "menu-open" : "" }} {{ request()->is("admin/satpams*") ? "menu-open" : "" }} {{ request()->is("admin/sub-units*") ? "menu-open" : "" }} {{ request()->is("admin/units*") ? "menu-open" : "" }} {{ request()->is("admin/lantais*") ? "menu-open" : "" }} {{ request()->is("admin/ruangs*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/kendaraans*") ? "active" : "" }} {{ request()->is("admin/drivers*") ? "active" : "" }} {{ request()->is("admin/satpams*") ? "active" : "" }} {{ request()->is("admin/sub-units*") ? "active" : "" }} {{ request()->is("admin/units*") ? "active" : "" }} {{ request()->is("admin/lantais*") ? "active" : "" }} {{ request()->is("admin/ruangs*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.master.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('kendaraan_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.kendaraans.index") }}" class="nav-link {{ request()->is("admin/kendaraans") || request()->is("admin/kendaraans/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-shuttle-van">

                                        </i>
                                        <p>
                                            {{ trans('cruds.kendaraan.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('driver_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.drivers.index") }}" class="nav-link {{ request()->is("admin/drivers") || request()->is("admin/drivers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fab fa-accessible-icon">

                                        </i>
                                        <p>
                                            {{ trans('cruds.driver.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('satpam_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.satpams.index") }}" class="nav-link {{ request()->is("admin/satpams") || request()->is("admin/satpams/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-people-carry">

                                        </i>
                                        <p>
                                            {{ trans('cruds.satpam.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('sub_unit_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.sub-units.index") }}" class="nav-link {{ request()->is("admin/sub-units") || request()->is("admin/sub-units/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.subUnit.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('unit_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.units.index") }}" class="nav-link {{ request()->is("admin/units") || request()->is("admin/units/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-users">

                                        </i>
                                        <p>
                                            {{ trans('cruds.unit.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('lantai_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.lantais.index") }}" class="nav-link {{ request()->is("admin/lantais") || request()->is("admin/lantais/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-building">

                                        </i>
                                        <p>
                                            {{ trans('cruds.lantai.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('ruang_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.ruangs.index") }}" class="nav-link {{ request()->is("admin/ruangs") || request()->is("admin/ruangs/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-hospital">

                                        </i>
                                        <p>
                                            {{ trans('cruds.ruang.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('pinjam_kendaraan_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.pinjam-kendaraans.index") }}" class="nav-link {{ request()->is("admin/pinjam-kendaraans") || request()->is("admin/pinjam-kendaraans/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-truck-moving">

                            </i>
                            <p>
                                {{ trans('cruds.pinjamKendaraan.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('pinjam_ruang_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.pinjam-ruangs.index") }}" class="nav-link {{ request()->is("admin/pinjam-ruangs") || request()->is("admin/pinjam-ruangs/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-chess-rook">

                            </i>
                            <p>
                                {{ trans('cruds.pinjamRuang.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('log_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/log-pinjam-kendaraans*") ? "menu-open" : "" }} {{ request()->is("admin/log-pinjam-ruangans*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle {{ request()->is("admin/log-pinjam-kendaraans*") ? "active" : "" }} {{ request()->is("admin/log-pinjam-ruangans*") ? "active" : "" }}" href="#">
                            <i class="fa-fw nav-icon fas fa-history">

                            </i>
                            <p>
                                {{ trans('cruds.log.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('log_pinjam_kendaraan_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.log-pinjam-kendaraans.index") }}" class="nav-link {{ request()->is("admin/log-pinjam-kendaraans") || request()->is("admin/log-pinjam-kendaraans/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.logPinjamKendaraan.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('log_pinjam_ruangan_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.log-pinjam-ruangans.index") }}" class="nav-link {{ request()->is("admin/log-pinjam-ruangans") || request()->is("admin/log-pinjam-ruangans/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-cogs">

                                        </i>
                                        <p>
                                            {{ trans('cruds.logPinjamRuangan.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('user_alert_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.user-alerts.index") }}" class="nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-bell">

                            </i>
                            <p>
                                {{ trans('cruds.userAlert.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route("admin.systemCalendar") }}" class="nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "active" : "" }}">
                        <i class="fas fa-fw fa-calendar nav-icon">

                        </i>
                        <p>
                            {{ trans('global.systemCalendar') }}
                        </p>
                    </a>
                </li>
                @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                    @can('profile_password_edit')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                <i class="fa-fw fas fa-key nav-icon">
                                </i>
                                <p>
                                    {{ trans('global.change_password') }}
                                </p>
                            </a>
                        </li>
                    @endcan
                @endif
                <li class="nav-item">
                    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                        <p>
                            <i class="fas fa-fw fa-sign-out-alt nav-icon">

                            </i>
                            <p>{{ trans('global.logout') }}</p>
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>