@extends('layouts.admin')

@section('content')

<!-- Main content -->

<section class="content">

    <div class="row">

        <div class="col-xl-3 col-lg-6 col-12">

            <div class="box overflow-hidden bg-primary ">

                <div class="box-body p-0">

                    <div class="px-30 pt-20">

                        <h4 class="text-white mb-0">34,042 </h4>

                        <p class="text-white-50">Sales this month</p>

                    </div>

                    <div id="statisticschart3"></div>

                </div>

            </div>

        </div>

        <div class="col-xl-6 col-lg-6 col-12">

            <div class="box">

                <div class="box-header">

                    <h4 class="box-title">Overview</h4>

                </div>

                <div class="box-body">

                    <div id="charts_widget_2_chart"></div>

                </div>

            </div>

        </div>

        <div class="col-xl-3 col-12">

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

        </div>



        <div class="col-lg-4 col-12">

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

        </div>



        <div class="col-lg-4 col-12">

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

        </div>



        <div class="col-lg-4 col-12">

            <div class="box">

                <div class="box-header">

                    <h4 class="box-title">History</h4>

                </div>

                <div class="box-body">

                    <div id="revenue_history"></div>

                </div>

            </div>

        </div>



        <div class="col-xl-3 col-md-6 col-12">

            <div class="box pull-up">

                <ul class="box-controls pull-right">

                    <li class="dropdown">

                        <a data-bs-toggle="dropdown" href="#" class="px-10 pt-5"><i class="ti-more-alt"></i></a>

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

                            <h3 class="text-dark mb-0 fw-500">5,215</h3>

                            <p class="text-mute mb-0">Total Sales</p>

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

                        <a data-bs-toggle="dropdown" href="#" class="px-10 pt-5"><i class="ti-more-alt"></i></a>

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

                            <h3 class="text-dark mb-0 fw-500">489</h3>

                            <p class="text-mute mb-0">Total Clients</p>

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

                        <a data-bs-toggle="dropdown" href="#" class="px-10 pt-5"><i class="ti-more-alt"></i></a>

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

                            <h3 class="text-dark mb-0 fw-500">$68,125</h3>

                            <p class="text-mute mb-0">Total Revenue</p>

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

                        <a data-bs-toggle="dropdown" href="#" class="px-10 pt-5"><i class="ti-more-alt"></i></a>

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

                            <h3 class="text-dark mb-0 fw-500">526</h3>

                            <p class="text-mute mb-0">Total Customers</p>

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

        <div class="col-xxl-7 col-12">

            <div class="box">

                <div class="box-header d-flex justify-content-between align-items-center">

                    <h4 class="box-title">Sales Dashboard</h4>

                    <!-- <h4 class="box-title fw-500">87</h4> -->

                    <ul class="m-0" style="list-style: none;">

                        <li class="dropdown">

                            <button class="btn btn-rounded btn-outline btn-primary dropdown-toggle btn-small px-10 py-0" data-bs-toggle="dropdown" href="#" aria-expanded="false">Show By Months</button>

                            <div class="dropdown-menu dropdown-menu-right" style="will-change: transform;">

                                <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>

                                <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>

                                <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>

                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>

                            </div>

                        </li>

                    </ul>

                </div>

                <div class="row">

                    <div class="col-xl-8 col-lg-8 col-md-12 col-12">

                        <div class="box-body ps-10 pb-0">

                            <!-- <div class="ps-20 d-flex align-items-center justify-content-between">

              <div>	

                  <h5 class="mb-0 text-fade">Ongoing <span class="text-primary">24 Projects</span></h5>

              </div>

              <div class="bg-primary-light px-3 py-2 text-primary text-center rounded">

                  <script> document.write(new Date().toLocaleDateString()); </script>

              </div>

          </div> -->

                            <div id="project-chart"></div>

                        </div>

                        <div class="box-footer no-border bg-transparent">

                            <div class="d-flex justify-content-center align-items-center">

                                <div class="rounded text-center pb-0 mb-0 w-p100 text-overflow"><span class="badge badge-xl me-10 badge-dot badge-primary"></span> Upcoming client</div>

                                <div class="rounded text-center pb-0 mb-0 w-p100 text-overflow"><span class="badge badge-xl me-10 badge-dot badge-danger"></span> Revenue</div>

                                <!-- <div class="b-1 rounded text-center pb-10 mb-10 w-p100 text-overflow"><span class="badge badge-xl badge-dot badge-light"></span> Complate</div> -->

                            </div>

                        </div>

                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-12 col-12 align-self-center">

                        <div class="text-center">

                            <input class="knob" data-width="200" data-height="200" data-linecap="round" data-fgColor="#FF6C6C" value="65" data-skin="tron" data-angleOffset="180" data-readOnly="true" data-thickness=".1" />

                            <h4 class="text-center mt-20 mb-10 mb-md-20 mb-xs-20 ">Based on overall sales</h4>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="col-xxl-5 col-12">

            <div class="box">

                <div class="box-header d-flex justify-content-between">

                    <h4 class="box-title">Utilization Rate</h4>

                    <!-- <h4 class="box-title fw-500">590</h4> -->

                </div>

                <div class="box-body">

                    <div class="row text-center">

                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">

                            <input class="knob" data-width="200" data-height="200" data-linecap="round" data-fgColor="#00baff" value="80" data-skin="tron" data-angleOffset="180" data-readOnly="true" data-thickness=".1" />

                            <div class="rounded text-center p-0 me-0 w-p100 mt-20 mt-xs-5"><span class="me-10 badge badge-xl badge-dot badge-info"></span> Billable</div>

                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 mt-0 mt-xs-10">

                            <input class="knob" data-width="200" data-height="200" data-linecap="round" data-fgColor="#04a08b" value="65" data-skin="tron" data-angleOffset="180" data-readOnly="true" data-thickness=".1" />

                            <div class="rounded text-center p-0 ms-0 w-p100 mt-20 mt-xs-5"><span class="me-10 badge badge-xl badge-dot badge-success"></span> Non-Billable</div>

                        </div>

                    </div>



                </div>

            </div>

        </div>



    </div>

</section>

<!-- /.content -->

@endsection