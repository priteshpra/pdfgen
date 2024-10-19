<section class="sidebar position-relative">
    <div class="multinav">
        <div class="multinav-scroll" style="height: 100%;">
            <!-- sidebar menu-->
            <ul class="sidebar-menu" data-widget="tree">
                @can('admin_panel_access')
                <li class="">
                    <a href="{{URL('admin')}}">
                        <i class="icon-Layout-4-blocks"><span class="path1"></span><span class="path2"></span></i>
                        <span>Dashboard</span>
                        <!-- <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span> -->
                    </a>
                </li>
                @endcan


                <!-- @canany(['country_access','state_access','city_access']) -->
                <li class="treeview @if(request()->is('admin/bussinesscategory') || request()->is('admin/bussinesscategory/*') || request()->is('admin/country') || request()->is('admin/country/*') || request()->is('admin/state') || request()->is('admin/state/*') || request()->is('admin/city') || request()->is('admin/city/*') || request()->is('admin/page') || request()->is('admin/page/*') || request()->is('admin/cms') || request()->is('admin/cms/*')) active menu-open @endif">
                    <a href="#">
                        <i class="icon-Write"><span class="path1"></span><span class="path2"></span></i>
                        <span>Masters</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        @can('bussiness_access')
                        <li class="@if(request()->is('admin/bussinesscategory') || request()->is('admin/bussinesscategory/*')) active @endif">
                            <a class="sidebar-link waves-effect waves-dark  " href="{{ route('admin.bussinesscategory.index') }}" aria-expanded="false">
                                <i class="icon-Commit" aria-hidden="true"></i>
                                <span class="hide-menu">Business Category</span>
                            </a>
                        </li>
                        @endcan

                        @can('country_access')
                        <li class="@if(request()->is('admin/country') || request()->is('admin/country/*')) active @endif">
                            <a class="sidebar-link waves-effect waves-dark  " href="{{ route('admin.country.index') }}" aria-expanded="false">
                                <i class="icon-Commit" aria-hidden="true"></i>
                                <span class="hide-menu">Country</span>
                            </a>
                        </li>
                        @endcan

                        @can('state_access')
                        <li class="@if(request()->is('admin/state') || request()->is('admin/state/*')) active @endif">
                            <a class="sidebar-link waves-effect waves-dark  " href="{{ route('admin.state.index') }}" aria-expanded="false">
                                <i class="icon-Commit" aria-hidden="true"></i>
                                <span class="hide-menu">State</span>
                            </a>
                        </li>
                        @endcan

                        @can('city_access')
                        <li class="@if(request()->is('admin/city') || request()->is('admin/city/*')) active @endif">
                            <a class="sidebar-link waves-effect waves-dark  " href="{{ route('admin.city.index') }}" aria-expanded="false">
                                <i class="icon-Commit" aria-hidden="true"></i>
                                <span class="hide-menu">City</span>
                            </a>
                        </li>
                        @endcan

                        @can('page_access')
                        <li class="@if(request()->is('admin/page') || request()->is('admin/page/*')) active @endif">
                            <a class="sidebar-link waves-effect waves-dark  " href="{{ route('admin.page.index') }}" aria-expanded="false">
                                <i class="icon-Commit" aria-hidden="true"></i>
                                <span class="hide-menu">Page</span>
                            </a>
                        </li>
                        @endcan

                        @can('cms_access')
                        <li class="@if(request()->is('admin/cms') || request()->is('admin/cms/*')) active @endif">
                            <a class="sidebar-link waves-effect waves-dark  " href="{{ route('admin.cms.index') }}" aria-expanded="false">
                                <i class="icon-Commit" aria-hidden="true"></i>
                                <span class="hide-menu">CMS</span>
                            </a>
                        </li>
                        @endcan
                    </ul>

                </li>
                <!-- @endcanany -->
                <!-- @canany(['users_access','roles_access','permissions_access']) -->
                <li class="treeview @if(request()->is('admin/users') || request()->is('admin/users/*') || request()->is('admin/client') || request()->is('admin/client/*') || request()->is('admin/cas') || request()->is('admin/cas/*')) active menu-open @endif">
                    <a href="#">
                        <i span class="icon-User"><span class="path1"></span><span class="path2"></span></i>
                        <span>Users</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>

                    <ul class="treeview-menu">
                        @can('users_access')
                        <li class="@if(request()->is('admin/users') || request()->is('admin/users/*')) active @endif">
                            <a class="sidebar-link waves-effect waves-dark  " href="{{ route('admin.users.index') }}" aria-expanded="false">
                                <i class="icon-Commit" aria-hidden="true"></i>
                                <span class="hide-menu">Employees</span>
                            </a>
                        </li>
                        @endcan

                        @can('client_access')
                        <li class="@if(request()->is('admin/client') || request()->is('admin/client/*')) active @endif">
                            <a class="sidebar-link waves-effect waves-dark  " href="{{ route('admin.client.index') }}" aria-expanded="false">
                                <i class="icon-Commit" aria-hidden="true"></i>
                                <span class="hide-menu">Client</span>
                            </a>
                        </li>
                        @endcan
                        @can('cas_access')
                        <li class=" @if(request()->is('admin/cas') || request()->is('admin/cas/*')) active @endif">
                            <a class="sidebar-link waves-effect waves-dark " href="{{ route('admin.cas.index') }}" aria-expanded="false">
                                <i class="icon-Commit" aria-hidden="true"></i>
                                <span class="hide-menu">CAs</span>
                            </a>
                        </li>
                        @endcan

                        @can('roles_access')
                        <!-- <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark  @if(request()->is('admin/roles') || request()->is('admin/roles/*')) active @endif" href="{{ route('admin.roles.index') }}" aria-expanded="false">
                                    <i class="icon-Commit" aria-hidden="false"></i>
                                    <span class="hide-menu">Roles</span>
                                </a>
                            </li> -->
                        @endcan

                        @can('permissions_access')
                        <!-- <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark  @if(request()->is('admin/permissions') || request()->is('admin/permissions/*')) active @endif" href="{{ route('admin.permissions.index') }}" aria-expanded="false">
                                    <i class="icon-Commit" aria-hidden="false"></i>
                                    <span class="hide-menu">Permissions</span>
                                </a>
                            </li> -->
                        @endcan
                    </ul>
                </li>
                <!-- @endcanany -->
                <li class="header">REPORTS </li>
                <li class="treeview">
                    <a href="#">
                        <i class="icon-File"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        <span>Reports</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-right pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li class="treeview">
                            <a href="#">
                                <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Client Wise Data
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="icon-Commit"><span class="path1"></span><span class="path2"></span></i>Monthly PDFs
                                <span class="pull-right-container">
                                    <i class="fa fa-angle-right pull-right"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="">
                    <a href="{{ URL('/admin/upload-images') }}">
                        <i span class="icon-Layout-grid"><span class="path1"></span><span class="path2"></span></i>
                        <span>PDF Generate</span>
                        <!-- <span class="pull-right-container">
                                <i class="fa fa-angle-right pull-right"></i>
                            </span> -->
                    </a>
                </li>
            </ul>

        </div>

    </div>

</section>
<div class="sidebar-footer">

    <a href="javascript:void(0)" class="link" data-bs-toggle="tooltip" title="Settings"><span class="icon-Settings-2"></span></a>

    <a href="mailbox.html" class="link" data-bs-toggle="tooltip" title="Email"><span class="icon-Mail"></span></a>

    <a href="javascript:void(0)" onclick="$('#logout-form').submit();" class="link" data-bs-toggle="tooltip" title="Logout"><span class="icon-Lock-overturning"><span class="path1"></span><span class="path2"></span></span></a>

</div>