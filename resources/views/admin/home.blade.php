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
                    <a href="{{ route('admin.client.index') }}">
                        <div class="d-flex align-items-center justify-content-between ">

                            <div>


                                <h3 class="text-dark mb-0 fw-500">{{ $clients }}</h3>


                                <p class="text-mute mb-0">Total Clients</p>

                            </div>

                            <div class="icon bg-primary-light h-60 w-60 rounded-circle">

                                <i class="text-primary mr-0 fs-20 fa fa-area-chart"></i>

                            </div>

                        </div>
                    </a>

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
                    <a href="{{ route('admin.cas.index') }}">
                        <div class="d-flex align-items-center justify-content-between">

                            <div>

                                <h3 class="text-dark mb-0 fw-500">{{ $cas }}</h3>

                                <p class="text-mute mb-0">Total CAs</p>

                            </div>

                            <div class="icon bg-info-light h-60 w-60 rounded-circle">

                                <i class="text-info mr-0 fs-20 fa fa-user"></i>

                            </div>

                        </div>
                    </a>

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
                    <a href="{{ route('admin.users.index') }}">
                        <div class="d-flex align-items-center justify-content-between">

                            <div>

                                <h3 class="text-dark mb-0 fw-500">{{ $employee }}</h3>

                                <p class="text-mute mb-0">Total Employee</p>

                            </div>

                            <div class="icon bg-warning-light h-60 w-60 rounded-circle">

                                <i class="text-warning mr-0 fs-20 fa fa-money"></i>

                            </div>

                        </div>
                    </a>

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
    <!-- Document List -->
    <div class="row">
        <div class="col-xxl-12 col-12">
            <div class="box">
                <div class="box-header d-flex justify-content-between align-items-center">
                    <h4 class="box-title">Documents List</h4>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                        <div class="table-responsive">
                            <table id="clientTables"
                                class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead class="bg-primary">
                                    <tr class="">
                                        <th>Company Name</th>
                                        <th>Uploaded By</th>
                                        <th>Uploaded Date</th>
                                        <th>Title</th>
                                        <th>Batch No</th>
                                        <th>Image Count</th>
                                        <th>Remarks</th>
                                        <th>File Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($documentLists as $user)
                                    <tr>
                                        <td>{{$user->FirmName}}</td>
                                        <td>{{$user->FirstName}}</td>
                                        <td>{{ date('d/m/Y',
                                            strtotime($user->created_at)) }}</a>
                                        </td>
                                        <td>{{$user->Title}}</td>
                                        <td>{{$user->BatchNo}}</td>
                                        <td>{{$user->ImageCount}}</td>
                                        <td>{{$user->Remarks}}</td>

                                        <td>
                                            @if ($user->DocumentURL !='')
                                            <a
                                                href="{{ route('download.file', ['user_id' => $user->UserID, 'filename' => $user->DocumentURL]) }}"><button
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
                                        <td colspan="100%" class="text-center text-muted py-3">No Data Found
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
    <!-- End Document List -->

    <!-- Other Document -->
    <div class="row">
        <div class="col-xxl-12 col-12">
            <div class="box">
                <div class="box-header d-flex justify-content-between align-items-center">
                    <h4 class="box-title">Other Documents List</h4>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                        <div class="table-responsive">
                            <table id="clientTables"
                                class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead class="bg-primary">
                                    <tr class="">
                                        <th>Company Name</th>
                                        <th>Uploaded By</th>
                                        <th>Uploaded Date</th>
                                        <th>Title</th>
                                        <th>Batch No</th>
                                        <th>Image Count</th>
                                        <th>Remarks</th>
                                        <th>File Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($otherDocumentLists as $user)
                                    <tr>
                                        <td>{{$user->FirmName}}</td>
                                        <td>{{$user->FirstName}}</td>
                                        <td>{{ date('d/m/Y',
                                            strtotime($user->created_at)) }}</a>
                                        </td>
                                        <td>{{$user->Title}}</td>
                                        <td>{{$user->BatchNo}}</td>
                                        <td>{{$user->ImageCount}}</td>
                                        <td>{{$user->Remarks}}</td>

                                        <td>
                                            @if ($user->DocumentURL !='')
                                            <a
                                                href="{{ route('download.file', ['user_id' => $user->UserID, 'filename' => $user->DocumentURL]) }}"><button
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
                                        <td colspan="100%" class="text-center text-muted py-3">No Data Found
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
    <!-- End Other Document -->

    <div class="row">
        <div class="col-xxl-12 col-12">
            <div class="box">
                <div class="box-header d-flex justify-content-between align-items-center">
                    <h4 class="box-title">Client List</h4>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12">
                        <div id="alert-container"></div>
                        <div class="table-responsive">
                            <table id="clientTables"
                                class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead class="bg-primary">
                                    <tr class="">
                                        <th>Client Name</th>
                                        <th>Firm Name</th>
                                        <th>Client Code</th>
                                        <th>Business Category</th>
                                        <th>Email</th>
                                        <th>MobileNo</th>
                                        <th>Address</th>
                                        <th>Aadhar Number</th>
                                        <th>GST Number</th>
                                        <th>PAN Number</th>
                                        <th>Firm Type</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($clientLists as $user)
                                    <tr>
                                        <td>{{$user->FirstName}} {{ $user->LastName}}</td>
                                        <td><a href="{{ route('admin.client.show',$user->id) }}">{{$user->FirmName}}</a>
                                        </td>
                                        <td>{{$user->ClientCode}}
                                        </td>
                                        <td>{{$user->CategoryName}}</td>
                                        <td>{{$user->Email}}</td>
                                        <td>{{$user->MobileNo}}</td>
                                        <td>{{$user->Address}}</td>
                                        <td>{{$user->AadharNumber}}</td>
                                        <td>{{$user->GSTNumber}}</td>
                                        <td>{{$user->PANNumber}}</td>
                                        <td>{{$user->FirmType}}</td>
                                        <td>
                                            <div class="col-xl-2 col-6 text-center align-self-center mb-20">
                                                <button id="toggleApproveChang_{{$user->id}}"
                                                    onclick="toggleApproveStatus({{$user->id}},{{ ($user->IsApproved == 0) ? '1' : '0' }})"
                                                    type="button"
                                                    class="btn btn-sm btn-toggle toggleApproveChang {{($user->IsApproved == 1) ? 'btn-success active' : 'btn-error'}}"
                                                    data-bs-toggle="button" aria-pressed="true" autocomplete="off">
                                                    <div class="handle"></div>
                                                </button>
                                            </div>
                                        </td>

                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="100%" class="text-center text-muted py-3">No Data Found
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
                        <div id="alert-containercas"></div>
                        <div class="table-responsive">
                            <table id="casTables"
                                class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                <thead class="bg-primary">
                                    <tr class="">
                                        <th>Client Name</th>
                                        <th>Firm Name</th>
                                        <th>Client Code</th>
                                        <th>Business Category</th>
                                        <th>Email</th>
                                        <th>MobileNo</th>
                                        <th>Address</th>
                                        <th>Aadhar Number</th>
                                        <th>GST Number</th>
                                        <th>PAN Number</th>
                                        <th>Firm Type</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($casList as $user)
                                    <tr>
                                        <td>{{$user->FirstName}} {{ $user->LastName}}</td>
                                        <td><a href="{{ route('admin.client.show',$user->id) }}">{{$user->FirmName}}</a>
                                        </td>
                                        <td>{{$user->ClientCode}}
                                        </td>
                                        <td>{{$user->CategoryName}}</td>
                                        <td>{{$user->Email}}</td>
                                        <td>{{$user->MobileNo}}</td>
                                        <td>{{$user->Address}}</td>
                                        <td>{{$user->AadharNumber}}</td>
                                        <td>{{$user->GSTNumber}}</td>
                                        <td>{{$user->PANNumber}}</td>
                                        <td>{{$user->FirmType}}</td>
                                        <td>
                                            <div class="col-xl-2 col-6 text-center align-self-center mb-20">
                                                <button id="toggleApproveChangcas_{{$user->id}}"
                                                    onclick="toggleApproveStatuscas({{$user->id}},{{ ($user->IsApproved == 0) ? '1' : '0' }})"
                                                    type="button"
                                                    class="btn btn-sm btn-toggle toggleApproveChang {{($user->IsApproved == 1) ? 'btn-success active' : 'btn-error'}}"
                                                    data-bs-toggle="button" aria-pressed="true" autocomplete="off">
                                                    <div class="handle"></div>
                                                </button>
                                            </div>
                                        </td>

                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="100%" class="text-center text-muted py-3">No Data Found
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
        <div class="col-xxl-5 col-12">
            <div class="box">
                <div class="box-header d-flex justify-content-between">
                    {{-- <h4 class="box-title">Active Users</h4> --}}
                </div>
                <div class="box-body">
                    <div class="row text-center">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                            <div style="width: 40%; margin: auto;">
                                <canvas id="deviceChart"></canvas>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-12 mt-0 mt-xs-10">
                            <div style="width: 60%; margin: auto;">
                                <form id="filterForm" class="d-flex align-items-center gap-2">
                                    <div class="form-group mb-0">
                                        <label for="start_date" class="form-label me-2">Start Date:</label>
                                        <input type="text" id="start_date" name="start_date"
                                            class="datepicker form-control">
                                    </div>
                                    <div class="form-group mb-0 ms-2">
                                        <label for="end_date" class="form-label me-2">End Date:</label>
                                        <input type="text" id="end_date" name="end_date"
                                            class="datepicker form-control">
                                    </div>
                                    {{-- <button type="submit" class="btn btn-primary ms-2"
                                        style="margin-top: 6%;">Filter</button> --}}
                                    <a href="javascript:void(0);" style="margin-top: 9%;"
                                        class="btn btn-primary ms-2 btn-sm" id="filterButton">Filter</a>
                                </form>
                                <br />
                                <canvas id="documentChart" style="margin-top: 20px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-5 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 mt-0 mt-xs-10">
                        <form id="filterLineForm" class="d-flex align-items-center gap-2">
                            <div class="form-group mb-0">
                                <label for="start_date" class="form-label me-2">Start Date:</label>
                                <input type="text" id="start_dates" name="start_dates" class="datepicker form-control">
                            </div>
                            <div class="form-group mb-0 ms-2">
                                <label for="end_date" class="form-label me-2">End Date:</label>
                                <input type="text" id="end_dates" name="end_dates" class="datepicker form-control">
                            </div>
                            <a href="javascript:void(0);" style="margin-top: 3%;" class="btn btn-primary ms-2 btn-sm"
                                id="applyFilter">Filter</a>
                        </form>
                        <br />
                        <canvas id="uploadChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the current date
        const today = new Date();

        // Format current date as YYYY-MM-DD
        const endDate = today.toISOString().split('T')[0];

        // Get the first day of the current month
        const firstDay = new Date(today.getFullYear(), today.getMonth(), 2)
        .toISOString()
        .split('T')[0];

        // Set default values for the input fields
        document.getElementById('start_date').value = firstDay;
        document.getElementById('end_date').value = endDate;

        // Initialize the date pickers
        const startDatePicker = flatpickr('#start_date', {
            dateFormat: 'Y-m-d',
            onChange: function(selectedDates, dateStr, instance) {
                const startDate = selectedDates[0]; // The selected start date
                const endDatePicker = flatpickr('#end_date'); // Get the end date picker instance

                // Set the minDate of the end date picker to the selected start date
                endDatePicker.set('minDate', startDate);
            }
        });

        // Initialize the end date picker
        const endDatePicker = flatpickr('#end_date', {
            dateFormat: 'Y-m-d',
            minDate: "today", // Initially disable all past dates
        });

        document.getElementById('start_dates').value = firstDay;
        document.getElementById('end_dates').value = endDate;

        // Initialize the date pickers
        const startDatePickers = flatpickr('#start_dates', {
        dateFormat: 'Y-m-d',
        onChange: function(selectedDates, dateStr, instance) {
                const startDates = selectedDates[0]; // The selected start date
                const endDatePickers = flatpickr('#end_date'); // Get the end date picker instance

                // Set the minDate of the end date picker to the selected start date
                endDatePickers.set('minDate', startDates);
            }
        });

        // Initialize the end date picker
        const endDatePickers = flatpickr('#end_dates', {
            dateFormat: 'Y-m-d',
            minDate: "today", // Initially disable all past dates
        });
    });

    // Initialize the chart
    const ctx3 = document.getElementById('documentChart').getContext('2d');
        let documentChart = new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: {!! json_encode($labels) !!}, // Initially empty
            datasets: [{
                label: 'Documents Uploaded',
                data: {!! json_encode($counts) !!}, // Counts
                backgroundColor: '#42A5F5',
                borderColor: '#1E88E5',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date',
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Number of Documents',
                    },
                    beginAtZero: true
                }
            }
        }
    });

    // Fetch chart data
    function fetchChartData(startDate, endDate) {
        $.ajax({
            url: 'admin/documents/chart-data',
            method: 'GET',
            data: {
                start_date: startDate,
                end_date: endDate
            },
            success: function(response) {
                documentChart.data.labels = response.labels;
                documentChart.data.datasets[0].data = response.counts;
                documentChart.update();
            }
        });
    }

    // Handle form submission
    $('#filterButton').on('click', function(e) {
        e.preventDefault(); // Prevent form submission
        const startDate = $('#start_date').val();
        const endDate = $('#end_date').val();
        fetchChartData(startDate, endDate);
    });

    // Load default data for the current month on page load
    $(document).ready(function() {
        const today = new Date().toISOString().split('T')[0];
        const firstDay = new Date(today.slice(0, 7) + '-01').toISOString().split('T')[0];
        fetchChartData(firstDay, today);
    });

    const ctx = document.getElementById('deviceChart').getContext('2d');
    const deviceChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Android', 'iOS'],
            datasets: [{
                label: 'User Devices',
                data: [{{ $androidCount }}, {{ $iosCount }}],
                backgroundColor: ['#4CAF50', '#2196F3'],
                hoverOffset: 4
            }]
        }
    });


</script>
<script>
    // Start line chart bar code
    $(document).ready(function() {
    // Function to fetch data and update the chart
    function fetchData(startDate, endDate) {
        $.ajax({
            url: 'admin/documents/line-chart-data',
            method: 'GET',
            data: { start_date: startDate, end_date: endDate },
            success: function(response) {
                updateChart(response);
            }
        });
    }

    // Initialize the chart
    let chartInstance = new Chart($('#uploadChart'), {
        type: 'line',
        data: {
            labels: [], // Dates
            datasets: [] // Upload counts per client
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Document Upload Count'
                    }
                }
            }
        }
    });

    // Update chart data
    function updateChart(data) {
        const labels = [];
        const datasets = [];
        const clients = [...new Set(data.map(item => item.FirmName))]; // Get unique clients

        clients.forEach(client => {
            const clientData = data.filter(item => item.FirmName === client);
            const clientUploads = clientData.map(item => item.upload_count);
            const dates = clientData.map(item => item.date);

            datasets.push({
                label: `Client ${client}`,
                data: clientUploads,
                fill: false,
                borderColor: '#'+(Math.random()*0xFFFFFF<<0).toString(16), // Random color
                tension: 0.1
            });

            if (labels.length === 0) {
                labels.push(...dates);
            }
        });

        chartInstance.data.labels = labels;
        chartInstance.data.datasets = datasets;
        chartInstance.update();
    }

    // Handle filter change (This Month, Last Month, Custom Range)
    $('#applyFilter').click(function(e) {
        e.preventDefault();
        const startDates = $('#start_dates').val();
        const endDates = $('#end_dates').val();
        // Format the dates in YYYY-MM-DD format for the backend
        fetchData(startDates, endDates);
    });

    // Initial data fetch for this month
    fetchData(new Date(new Date().getFullYear(), new Date().getMonth(), 1).toISOString().split('T')[0], new Date().toISOString().split('T')[0]);
});
</script>
<!-- /.content -->
<script type="text/javascript">
    function toggleApproveStatus(ID, status) {
        if (status == 1) {
            statuss = 0;
            console.log('off');

            $('#toggleApproveChang_' + ID).addClass('btn-success');
            $('#toggleApproveChang_' + ID).removeClass('btn-error');
        } else {
            statuss = 1;
            $('#toggleApproveChang_' + ID).removeClass('btn-success');
            $('#toggleApproveChang_' + ID).addClass('btn-error');

        }
        $("#toggleApproveChang_" + ID).attr("onclick", "toggleApproveStatus(" + ID + ", " + statuss + ")");

        $('#loader').show();
        $('#loader').css('opacity', 1);
        $.ajax({
            url: "{{ route('admin.clientapprovetoggle.status') }}", // URL to your route
            type: "POST",
            data: {
                id: ID, // Pass the user ID
                Status: status, // Pass the user ID
                _token: '{{ csrf_token() }}' // CSRF token for Laravel
            },
            success: function(response) {
                $('#loader').hide();
                $('#loader').css('opacity', 0);
                $("#alert-container").show();
                $('#alert-container').html(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${response.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    `);
            },
            error: function(xhr) {
                $('#loader').hide();
                $('#loader').css('opacity', 0);
                $('#alert-container').html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${xhr.responseJSON.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    `);
            }
        });
    }

    function toggleApproveStatuscas(ID, status) {
        if (status == 1) {
            statuss = 0;
            console.log('off');

            $('#toggleApproveChangcas_' + ID).addClass('btn-success');
            $('#toggleApproveChangcas_' + ID).removeClass('btn-error');
        } else {
            statuss = 1;
            $('#toggleApproveChangcas_' + ID).removeClass('btn-success');
            $('#toggleApproveChangcas_' + ID).addClass('btn-error');

        }
        $("#toggleApproveChangcas_" + ID).attr("onclick", "toggleApproveStatuscas(" + ID + ", " + statuss + ")");

        $('#loader').show();
        $('#loader').css('opacity', 1);
        $.ajax({
            url: "{{ route('admin.clientapprovetoggle.status') }}", // URL to your route
            type: "POST",
            data: {
                id: ID, // Pass the user ID
                Status: status, // Pass the user ID
                _token: '{{ csrf_token() }}' // CSRF token for Laravel
            },
            success: function(response) {
                $('#loader').hide();
                $('#loader').css('opacity', 0);
                $("#alert-containercas").show();
                $('#alert-containercas').html(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${response.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    `);
            },
            error: function(xhr) {
                $('#loader').hide();
                $('#loader').css('opacity', 0);
                $('#alert-containercas').html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        ${xhr.responseJSON.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    `);
            }
        });
    }
</script>
@endsection