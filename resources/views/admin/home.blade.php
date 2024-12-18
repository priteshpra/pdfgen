@extends('layouts.admin')

@section('content')

<!-- Main content -->

<section class="content">

    <div class="row">

        {{-- <div class="col-xl-3 col-lg-6 col-12">

            <div class="box overflow-hidden bg-primary ">

                <div class="box-body p-0">

                    <div class="px-30 pt-20">

                        <h4 class="text-white mb-0">34,042 </h4>

                        <p class="text-white-50">Sales this month</p>

                    </div>

                    <div id="statisticschart3"></div>

                </div>

            </div>

        </div> --}}

        {{-- <div class="col-xl-6 col-lg-6 col-12">

            <div class="box">

                <div class="box-header">

                    <h4 class="box-title">Overview</h4>

                </div>

                <div class="box-body">

                    <div id="charts_widget_2_chart"></div>

                </div>

            </div>

        </div> --}}

        {{-- <div class="col-xl-3 col-12">

            <div class="box">

                <div class="box-header">

                    <h4 class="box-title">Top Agent's</h4>

                </div>

                <div class="box-body">

                    <div class="d-flex align-items-center justify-content-between pb-0 pe-20">

                        <h5 class="my-0 text-light"><i class="fa fa-user me-50 w-20"></i>Name</h5>

                        <p class="mb-0 text-light">Sale</p>

                    </div>

                    <div class="pat-div">

                        <div class="d-flex align-items-center justify-content-between my-15 pe-20">

                            <h5 class="my-0"><i class="me-50 w-20 fa fa-user"></i>Mansur</h5>

                            <p class="mb-0">74</p>

                        </div>

                        <div class="d-flex align-items-center justify-content-between my-15 pe-20">

                            <h5 class="my-0"><i class="me-50 w-20 fa fa-user"></i>Octavia</h5>

                            <p class="mb-0">32</p>

                        </div>

                        <div class="d-flex align-items-center justify-content-between my-15 pe-20">

                            <h5 class="my-0"><i class="me-50 w-20 fa fa-user"></i>Elvina</h5>

                            <p class="mb-0">15</p>

                        </div>

                        <div class="d-flex align-items-center justify-content-between my-15 pe-20">

                            <h5 class="my-0"><i class="me-50 w-20 fa fa-user"></i>Marni</h5>

                            <p class="mb-0">35</p>

                        </div>

                        <div class="d-flex align-items-center justify-content-between my-15 pe-20">

                            <h5 class="my-0"><i class="me-50 w-20 fa fa-user"></i>Lrvina</h5>

                            <p class="mb-0">158</p>

                        </div>

                        <div class="d-flex align-items-center justify-content-between my-15 pe-20">

                            <h5 class="my-0"><i class="me-50 w-20 fa fa-user"></i>Jonathan</h5>

                            <p class="mb-0">85</p>

                        </div>

                        <div class="d-flex align-items-center justify-content-between my-15 pe-20">

                            <h5 class="my-0"><i class="me-50 w-20 fa fa-user"></i>Marwar</h5>

                            <p class="mb-0">45</p>

                        </div>

                    </div>

                </div>

            </div>

        </div> --}}



        {{-- <div class="col-lg-4 col-12">

            <div class="box pull-up">

                <ul class="box-controls pull-right">

                    <li class="dropdown">

                        <a data-bs-toggle="dropdown" href="#" class="p-10"><i class="ti-more-alt"></i></a>

                        <div class="dropdown-menu dropdown-menu-right">

                            <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>

                            <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>

                            <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>

                        </div>

                    </li>

                </ul>

                <div class="box-body pb-30 pt-0 ">

                    <div class="d-flex justify-content-between align-items-center ">

                        <div><i class="fa fa-money text-success fs-50"></i></div>

                        <div>

                            <h2 class="fw-500 mb-0">$6,458.00</h2>

                            <p class=" mb-0"><small>Total Income</small></p>

                        </div>

                    </div>

                </div>

            </div>

            <div class="box pull-up">

                <ul class="box-controls pull-right">

                    <li class="dropdown">

                        <a data-bs-toggle="dropdown" href="#" class="p-10"><i class="ti-more-alt"></i></a>

                        <div class="dropdown-menu dropdown-menu-right">

                            <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>

                            <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>

                            <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>

                        </div>

                    </li>

                </ul>

                <div class="box-body pb-30 pt-0">

                    <div class="d-flex justify-content-between align-items-center">

                        <div><i class="fa fa-money text-primary fs-50"></i></div>

                        <div>

                            <h2 class="fw-500 mb-0">$4,329.00</h2>

                            <p class=" mb-0"><small>Spending Income</small></p>

                        </div>

                    </div>

                </div>

            </div>

        </div> --}}



        {{-- <div class="col-lg-4 col-12">

            <div class="box overflow-hidden">

                <div class="box-header">

                    <h4 class="box-title">Total Revenue</h4>

                </div>

                <div class="box-body p-0">

                    <div class="px-30 py-20">

                        <h4 class="mb-0">$346,042k </h4>

                        <p class="mb-0"><small>Got From 1456 customers</small></p>

                    </div>

                    <div id="spark3"></div>

                </div>

            </div>

        </div> --}}



        {{-- <div class="col-lg-4 col-12">

            <div class="box">

                <div class="box-header">

                    <h4 class="box-title">History</h4>

                </div>

                <div class="box-body">

                    <div id="revenue_history"></div>

                </div>

            </div>

        </div> --}}



        <div class="col-xl-3 col-md-6 col-12">

            <div class="box pull-up">

                <ul class="box-controls pull-right">

                    <li class="dropdown">

                        <a data-bs-toggle="dropdown" href="#" class="px-10 pt-5"></a>

                        <div class="dropdown-menu dropdown-menu-end">

                            <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>

                            <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>

                            <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>

                        </div>

                    </li>

                </ul>

                <div class="box-body pt-0 ">

                    <div class="d-flex align-items-center justify-content-between ">

                        <div>

                            <a href="{{ route('admin.client.index') }}">
                                <h3 class="text-dark mb-0 fw-500">{{ $clients }}</h3>
                            </a>

                            <p class="text-mute mb-0">Total Clients</p>

                        </div>

                        <div class="icon bg-primary-light h-60 w-60 rounded-circle">

                            <i class="text-primary mr-0 fs-20 fa fa-area-chart"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6 col-12">

            <div class="box pull-up">

                <ul class="box-controls pull-right">

                    <li class="dropdown">

                        <a data-bs-toggle="dropdown" href="#" class="px-10 pt-5"></a>

                        <div class="dropdown-menu dropdown-menu-end">

                            <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>

                            <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>

                            <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>

                        </div>

                    </li>

                </ul>

                <div class="box-body pt-0">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>
                            <a href="{{ route('admin.cas.index') }}">
                                <h3 class="text-dark mb-0 fw-500">{{ $cas }}</h3>
                            </a>
                            <p class="text-mute mb-0">Total CAs</p>

                        </div>

                        <div class="icon bg-info-light h-60 w-60 rounded-circle">

                            <i class="text-info mr-0 fs-20 fa fa-user"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6 col-12">

            <div class="box pull-up">

                <ul class="box-controls pull-right">

                    <li class="dropdown">

                        <a data-bs-toggle="dropdown" href="#" class="px-10 pt-5"></a>

                        {{-- <div class="dropdown-menu dropdown-menu-end">

                            <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>

                            <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>

                            <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>

                        </div> --}}

                    </li>

                </ul>

                <div class="box-body pt-0">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>
                            <a href="{{ route('admin.users.index') }}">
                                <h3 class="text-dark mb-0 fw-500">{{ $employee }}</h3>
                            </a>
                            <p class="text-mute mb-0">Total Employee</p>

                        </div>

                        <div class="icon bg-warning-light h-60 w-60 rounded-circle">

                            <i class="text-warning mr-0 fs-20 fa fa-money"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-md-6 col-12">

            <div class="box pull-up">

                <ul class="box-controls pull-right">

                    <li class="dropdown">

                        <a data-bs-toggle="dropdown" href="#" class="px-10 pt-5"></a>

                        {{-- <div class="dropdown-menu dropdown-menu-end">

                            <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>

                            <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>

                            <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>

                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>

                        </div> --}}

                    </li>

                </ul>

                <div class="box-body pt-0">

                    <div class="d-flex align-items-center justify-content-between">

                        <div>

                            <h3 class="text-dark mb-0 fw-500">{{ $documents }}</h3>

                            <p class="text-mute mb-0">Total Document created</p>

                        </div>

                        <div class="icon bg-danger-light h-60 w-60 rounded-circle">

                            <i class="text-danger mr-0 fs-20 fa fa-user"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="row">
        <div class="col-xxl-12 col-12">
            <div class="box">
                <div class="box-header d-flex justify-content-between align-items-center">
                    <h4 class="box-title">Client List</h4>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                        <div class="table-responsive">
                            <table id="clientTables"
                                class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead class="bg-primary">
                                    <tr class="">
                                        <th>Name</th>
                                        <th>MobileNo</th>
                                        <th>Company Name</th>
                                        <th>User Type</th>
                                        <th>Email</th>
                                        <th>date</th>
                                        <th>Image Count</th>
                                        <th>File Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($clientLists as $user)
                                    <tr>
                                        <td>{{$user->FirstName}} {{ $user->LastName}}</td>
                                        <td>{{$user->MobileNo}}</td>
                                        <td><a href="{{ route('admin.client.show',$user->id) }}">{{$user->FirmName}}</a>
                                        </td>
                                        <td>{{$user->UserType}}</td>
                                        <td>{{$user->Email}}</td>
                                        <td>{{$user->created_at}}</td>
                                        <td>{{$user->ImageCount}}</td>

                                        <td>
                                            @if ($user->DocumentURL !='')
                                            <a
                                                href="{{ route('download.file', ['user_id' => $user->id, 'filename' => $user->DocumentURL]) }}"><button
                                                    type="button"
                                                    class="waves-effect waves-circle btn btn-circle btn-primary btn-xs mb-5"><i
                                                        class="fa fa-file-pdf-o" aria-hidden="true"></i></button></a>
                                            @else
                                            -
                                            @endif
                                        </td>

                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="100%" class="text-center text-muted py-3">No Users Found
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="row">
        <div class="col-xxl-12 col-12">
            <div class="box">
                <div class="box-header d-flex justify-content-between align-items-center">
                    <h4 class="box-title">CAs List</h4>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                        <div class="table-responsive">
                            <table id="casTables"
                                class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead class="bg-primary">
                                    <tr class="">
                                        <th>Name</th>
                                        <th>MobileNo</th>
                                        <th>Company Name</th>
                                        <th>User Type</th>
                                        <th>Email</th>
                                        <th>date</th>
                                        <th>Image Count</th>
                                        <th>File Download</th>
                                    </tr>
                                </thead>
                                @forelse ($casList as $user)
                                <tr>
                                    <td>{{$user->FirstName}} {{ $user->LastName}}</td>
                                    <td>{{$user->MobileNo}}</td>
                                    <td><a href="{{ route('admin.cas.show',$user->id) }}">{{$user->FirmName}}</a>
                                    </td>
                                    <td>{{$user->UserType}}</td>
                                    <td>{{$user->Email}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td>{{$user->ImageCount}}</td>
                                    <td>
                                        @if ($user->DocumentURL !='')
                                        <a
                                            href="{{route('download.file', ['user_id' => $user->id, 'filename' => $user->DocumentURL])}}"><button
                                                type="button"
                                                class="waves-effect waves-circle btn btn-circle btn-primary btn-xs mb-5"><i
                                                    class="fa fa-file-pdf-o" aria-hidden="true"></i></button></a>
                                        @else
                                        -
                                        @endif
                                    </td>


                                </tr>
                                @empty
                                <tr>
                                    <td colspan="100%" class="text-center text-muted py-3">No Users Found</td>
                                </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>

<!-- /.content -->

@endsection