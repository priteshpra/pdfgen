        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap"><i class="mdi mdi-dots-horizontal"></i> <span class="hide-menu">Dashboard</span></li>

                        @can('admin_panel_access')
                        <!-- dashboard-->
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark  @if(request()->is('admin')) is_active @endif" href="{{ route('admin.home') }}" aria-expanded="false">
                                <i class="mr-3 fas fa-tachometer-alt fa-fw" aria-hidden="true"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        @endcan


                        @canany(['users_access','roles_access','permissions_access'])
                        <li class="sidebar-item">

                            <a class="sidebar-link has-arrow waves-effect waves-dark selected" href="javascript:void(0)" aria-expanded="false">

                                <i class="mr-3 mdi mdi-account" aria-hidden="true"></i>
                                <span class="hide-menu">Users Management</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level
                                @if(request()->is('admin/users') || request()->is('admin/users/*')) in @endif
                                @if(request()->is('admin/roles') || request()->is('admin/roles/*')) in @endif
                                @if(request()->is('admin/permissions') || request()->is('admin/permissions/*')) in @endif
                            ">
                                @can('users_access')
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark  @if(request()->is('admin/users') || request()->is('admin/users/*')) is_active @endif" href="{{ route('admin.users.index') }}" aria-expanded="false">
                                        <i class="mr-3 mdi mdi-account-multiple" aria-hidden="true"></i>
                                        <span class="hide-menu">Users</span>
                                    </a>
                                </li>
                                @endcan

                                @can('roles_access')
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark  @if(request()->is('admin/roles') || request()->is('admin/roles/*')) is_active @endif" href="{{ route('admin.roles.index') }}" aria-expanded="false">
                                        <i class="mr-3 mdi mdi-star" aria-hidden="false"></i>
                                        <span class="hide-menu">Roles</span>
                                    </a>
                                </li>
                                @endcan

                                @can('permissions_access')
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark  @if(request()->is('admin/permissions') || request()->is('admin/permissions/*')) is_active @endif" href="{{ route('admin.permissions.index') }}" aria-expanded="false">
                                        <i class="mr-3 mdi mdi-key" aria-hidden="false"></i>
                                        <span class="hide-menu">Permissions</span>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany

                        @canany(['country_access','state_access','city_access'])
                        <li class="sidebar-item">

                            <a class="sidebar-link has-arrow waves-effect waves-dark selected" href="javascript:void(0)" aria-expanded="false">

                                <i class="mr-3 mdi mdi-account" aria-hidden="true"></i>
                                <span class="hide-menu">Master Management</span>
                            </a>
                            <ul aria-expanded="false" class="collapse first-level
                                @if(request()->is('admin/country') || request()->is('admin/country/*')) in @endif
                                @if(request()->is('admin/state') || request()->is('admin/state/*')) in @endif
                                @if(request()->is('admin/city') || request()->is('admin/city/*')) in @endif
                            ">
                                @can('country_access')
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark  @if(request()->is('admin/country') || request()->is('admin/country/*')) is_active @endif" href="{{ route('admin.country.index') }}" aria-expanded="false">
                                        <i class="mr-3 mdi mdi-account-multiple" aria-hidden="true"></i>
                                        <span class="hide-menu">Country</span>
                                    </a>
                                </li>
                                @endcan

                                @can('state_access')
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark  @if(request()->is('admin/state') || request()->is('admin/state/*')) is_active @endif" href="{{ route('admin.state.index') }}" aria-expanded="false">
                                        <i class="mr-3 mdi mdi-account-multiple" aria-hidden="true"></i>
                                        <span class="hide-menu">State</span>
                                    </a>
                                </li>
                                @endcan

                                @can('city_access')
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark  @if(request()->is('admin/city') || request()->is('admin/city/*')) is_active @endif" href="{{ route('admin.city.index') }}" aria-expanded="false">
                                        <i class="mr-3 mdi mdi-account-multiple" aria-hidden="true"></i>
                                        <span class="hide-menu">City</span>
                                    </a>
                                </li>
                                @endcan

                                @can('page_access')
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark  @if(request()->is('admin/page') || request()->is('admin/page/*')) is_active @endif" href="{{ route('admin.page.index') }}" aria-expanded="false">
                                        <i class="mr-3 mdi mdi-account-multiple" aria-hidden="true"></i>
                                        <span class="hide-menu">Page</span>
                                    </a>
                                </li>
                                @endcan

                                @can('cms_access')
                                <li class="sidebar-item">
                                    <a class="sidebar-link waves-effect waves-dark  @if(request()->is('admin/cms') || request()->is('admin/cms/*')) is_active @endif" href="{{ route('admin.cms.index') }}" aria-expanded="false">
                                        <i class="mr-3 mdi mdi-account-multiple" aria-hidden="true"></i>
                                        <span class="hide-menu">CMS</span>
                                    </a>
                                </li>
                                @endcan
                            </ul>
                        </li>
                        @endcanany


                        {{-- <li class="sidebar-item selected"> <a class="sidebar-link has-arrow waves-effect waves-dark active" href="javascript:void(0)" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home feather-icon"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg><span class="hide-menu">Dashboard <span class="badge badge-pill badge-success">5</span></span></a>
                            <ul aria-expanded="false" class="collapse first-level in">
                                <li class="sidebar-item"><a href="index.html" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Modern Dashboard  </span></a></li>
                                <li class="sidebar-item active"><a href="index2.html" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Awesome Dashboard </span></a></li>
                                <li class="sidebar-item"><a href="index3.html" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Classy Dashboard </span></a></li>
                                <li class="sidebar-item"><a href="index4.html" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Analytical Dashboard </span></a></li>
                                <li class="sidebar-item"><a href="index5.html" class="sidebar-link"><i class="mdi mdi-adjust"></i><span class="hide-menu"> Minimal Dashboard </span></a></li>
                            </ul>
                        </li> --}}

                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->