@extends('layouts.admin')

@section('content')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <a href="{{ route('admin.cas.index') }}">
                    <h3 class="page-title">{{ $user->name }} {{ $user->lname }} - Details</h3>
                </a>
            </div>
            {{-- <div class="pull-right">
                <button type="submit" onclick="location.href = 'addclientemployee.html';"
                    class="waves-effect waves-circle btn btn-circle btn-success btn-lg mb-5"><i class="fa fa-plus"
                        aria-hidden="true"></i></button>
            </div> --}}
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs customtab" role="tablist">

                            <li class="nav-item"> <a class="nav-link active" data-bs-toggle="tab" href="#home2"
                                    role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span
                                        class="hidden-xs-down">Profile</span></a> </li>

                            <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#profile2"
                                    role="tab"><span class="hidden-sm-up"><i class="ion-person"></i></span> <span
                                        class="hidden-xs-down">Change Password</span></a> </li>

                            <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#employee"
                                    role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span
                                        class="hidden-xs-down">Employees</span></a> </li>

                            <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#scanneddocuments"
                                    role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span
                                        class="hidden-xs-down">Scanned Documents</span></a> </li>

                            <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#otherdocuments"
                                    role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span
                                        class="hidden-xs-down">Other Documents</span></a> </li>

                            <li class="nav-item"> <a class="nav-link" data-bs-toggle="tab" href="#notifications"
                                    role="tab"><span class="hidden-sm-up"><i class="ion-home"></i></span> <span
                                        class="hidden-xs-down">Notifications</span></a> </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="home2" role="tabpanel">
                                <div class="col-lg-12 col-12">
                                    <div class="box">
                                        <form class="form">
                                            <div class="box-body">
                                                <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i>
                                                    Personal Info</h4>
                                                <hr class="my-15">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">First Name</label><br>
                                                            <label>{{ $user->name }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Last Name</label><br>
                                                            <label>{{ $user->lname }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">E-mail</label><br>
                                                            <label>{{ $user->Email }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Contact Number</label><br>
                                                            <label>{{ $user->mobile_no }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h4 class="box-title text-info mb-0 mt-20"><i class="ti-save me-15"></i>
                                                    Company Info</h4>
                                                <hr class="my-15">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Firm Name</label><br>
                                                            <label>{{ $user->firm_name }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Address</label><br>
                                                            <label>{{ $user->address }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">PAN Number</label><br>
                                                            <label>{{ $user->pan }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Aadhar Number</label><br>
                                                            @php
                                                            $formattedAadhar = substr($user->aadhar, 0, 4) . '-' .
                                                            substr($user->aadhar, 4, 4) . '-' . substr($user->aadhar, 8,
                                                            4);
                                                            @endphp
                                                            <label>{{ $formattedAadhar }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">GST Number</label><br>
                                                            <label>{{ $user->gst }} </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Firm Type</label><br>
                                                            <label>{{ $user->firm_type }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                        </form>
                                    </div>
                                    <!-- /.box -->
                                </div>
                            </div>
                            <div class="tab-pane" id="profile2" role="tabpanel">
                                <div class="col-lg-12 col-12">
                                    @if(Session::has('status-success'))
                                    <div class="alert alert-success">
                                        {{Session::get('status-success')}}
                                    </div>
                                    @endif

                                    @if(Session::has('status-info'))
                                    <div class="alert alert-info">
                                        {{Session::get('status-info')}}
                                    </div>
                                    @endif

                                    @if(Session::has('status-warning'))
                                    <div class="alert alert-warning">
                                        {{Session::get('status-warning')}}
                                    </div>
                                    @endif

                                    @if(Session::has('status-danger'))
                                    <div class="alert alert-danger">
                                        {{Session::get('status-danger')}}
                                    </div>
                                    @endif
                                    <div class="box">
                                        <form id="update-password-form" class="form"
                                            action="{{ route('admin.cas.update-password', $user->id) }}" method="POST">
                                            @csrf
                                            <div class="box-body">
                                                <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i>
                                                    Password</h4>
                                                <hr class="my-15">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Old Password</label>
                                                            <input type="password" name="old_password" id="old_password"
                                                                class="form-control" placeholder="Old Password"
                                                                maxlength="50" autofocus tabindex="1">
                                                            @error('old_password')
                                                            <span class="invalid-feedback" style="display: block"
                                                                role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">New Password</label>
                                                            <input type="password" name="new_password" id="new_password"
                                                                class="form-control" placeholder="New Password"
                                                                maxlength="50" tabindex="2">
                                                            @error('new_password')
                                                            <span class="invalid-feedback" style="display: block"
                                                                role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Confirm Password</label>
                                                            <input type="password" name="new_password_confirmation"
                                                                id="new_password_confirmation" class="form-control"
                                                                placeholder="Confirm Password" maxlength="50"
                                                                tabindex="3">
                                                            @error('new_password_confirmation')
                                                            <span class="invalid-feedback" style="display: block"
                                                                role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                            <div class="box-footer">
                                                <a href="#" id="submitLink" class="btn btn-primary"><i
                                                        class="ti-save-alt"></i> Save</a>
                                                <button type="button" class="btn btn-warning me-1" tabindex="5">
                                                    <i class="ti-trash"></i> Cancel
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- /.box -->
                                </div>
                            </div>
                            <div class="tab-pane" id="employee" role="tabpanel">
                                <div class="col-lg-12 col-12">
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="box">
                                                    <div class="box-body">
                                                        <div class="table-responsive">
                                                            <table id="example"
                                                                class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Employee Name</th>
                                                                        <th>Email</th>
                                                                        <th>MobileNo</th>
                                                                        <th>Address</th>
                                                                        <th>Registration Type</th>
                                                                        <th>Status</th>
                                                                        <th>Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if ($employee)
                                                                    @foreach ($employee as $employee)
                                                                    <tr>
                                                                        <td><a
                                                                                href="{{ route('admin.users.show', $employee['id']) }}"><strong>{{$employee['name']}}
                                                                                    {{$employee['lname']}}</strong></a>
                                                                        </td>
                                                                        <td>{{$employee['Email']}}</td>
                                                                        <td>{{$employee['mobile_no']}}</td>
                                                                        <td>{{$employee['address']}}</td>
                                                                        <td>{{$employee['registration_type']}}</td>
                                                                        <td>
                                                                            <div
                                                                                class="col-xl-2 col-6 text-center align-self-center mb-20">
                                                                                <button type="button"
                                                                                    class="btn btn-sm btn-toggle btn-success active"
                                                                                    data-bs-toggle="button"
                                                                                    aria-pressed="true"
                                                                                    autocomplete="off">
                                                                                    <div class="handle"></div>
                                                                                </button>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <a href="{{ route('admin.cas.edit', $employee['id']) }}"
                                                                                class=""><button type="button"
                                                                                    class="waves-effect waves-circle btn btn-circle btn-primary btn-xs mb-5"><i
                                                                                        class="fa fa-edit"
                                                                                        aria-hidden="true"></i></button></a>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                                <!-- /.box -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                            </div>
                            <div class="tab-pane" id="scanneddocuments" role="tabpanel">
                                <div class="col-lg-12 col-12">
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="box">
                                                    <div class="box-body">
                                                        <div class="table-responsive">
                                                            <table id="scandoctableexample"
                                                                class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Title</th>
                                                                        <th>Batch No.</th>
                                                                        <th>Upload Date</th>
                                                                        <th>Employee Name</th>
                                                                        <th>Page Count</th>
                                                                        <th>Remarks</th>
                                                                        <th>Status</th>
                                                                        <th>Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if ($scanDocuments)
                                                                    @foreach ($scanDocuments as $scanDocuments)

                                                                    <tr>
                                                                        <td>{{ $scanDocuments->Title }}</td>
                                                                        <td>{{ $scanDocuments->BatchNo }}</td>
                                                                        <td>{{ date('d/m/Y',
                                                                            strtotime($scanDocuments->created_at))
                                                                            }}</td>
                                                                        <td>{{
                                                                            $employeesNameData[$scanDocuments->UserID]
                                                                            }}</td>
                                                                        <td>{{ $scanDocuments->ImageCount }}</td>
                                                                        <td>{{ $scanDocuments->Remarks }}</td>
                                                                        <td>
                                                                            <div
                                                                                class="col-xl-2 col-6 text-center align-self-center mb-20">
                                                                                <button
                                                                                    id="toggleScanDocChang_{{$scanDocuments->ScanneddocumentID}}"
                                                                                    onclick="toggleScanDocStatus({{$scanDocuments->ScanneddocumentID}},{{ ($scanDocuments->Status == 1) ? '0' : '1' }})"
                                                                                    type="button"
                                                                                    class="btn btn-sm btn-toggle  {{($scanDocuments->Status == 1) ? 'btn-success active' : 'btn-error'}}"
                                                                                    data-bs-toggle="button"
                                                                                    aria-pressed="true"
                                                                                    autocomplete="off">
                                                                                    <div class="handle"></div>
                                                                                </button>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <button type="button"
                                                                                class="waves-effect waves-circle btn btn-circle btn-primary btn-xs mb-5"><i
                                                                                    class="fa fa-file-pdf-o"
                                                                                    aria-hidden="true"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                    @endif

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                                <!-- /.box -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                            </div>
                            <div class="tab-pane" id="otherdocuments" role="tabpanel">
                                <div class="col-lg-12 col-12">
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="box">
                                                    <div class="box-body">
                                                        <div class="table-responsive">
                                                            <table id="otherdoctableexample"
                                                                class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Title</th>
                                                                        <th>Upload Date</th>
                                                                        <th>Employee Name</th>
                                                                        <th>Remarks</th>
                                                                        <th>Status</th>
                                                                        <th>Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if ($otherDocuments)
                                                                    @foreach ($otherDocuments as $otherDocument)
                                                                    <tr>
                                                                        <td>{{ $otherDocument->Title }}</td>
                                                                        <td>{{ date('d/m/Y',
                                                                            strtotime($otherDocument->created_at))
                                                                            }}</td>
                                                                        <td>{{
                                                                            $employeesNameData[$otherDocument->UserID]
                                                                            }}</td>
                                                                        <td>{{ $otherDocument->Remarks }}</td>
                                                                        <td>
                                                                            <div
                                                                                class="col-xl-2 col-6 text-center align-self-center mb-20">
                                                                                <button
                                                                                    id="toggleOtherDocChang_{{$otherDocument->OtherdocumentsID}}"
                                                                                    onclick="toggleOtherDocStatus({{$otherDocument->OtherdocumentsID}},{{ ($otherDocument->Status == 1) ? '0' : '1' }})"
                                                                                    type="button"
                                                                                    class="btn btn-sm btn-toggle  {{($otherDocument->Status == 1) ? 'btn-success active' : 'btn-error'}}"
                                                                                    data-bs-toggle="button"
                                                                                    aria-pressed="true"
                                                                                    autocomplete="off">
                                                                                    <div class="handle"></div>
                                                                                </button>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <button type="button"
                                                                                class="waves-effect waves-circle btn btn-circle btn-primary btn-xs mb-5"><i
                                                                                    class="fa fa-file-pdf-o"
                                                                                    aria-hidden="true"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach

                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                                <!-- /.box -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                            </div>
                            <div class="tab-pane" id="notifications" role="tabpanel">
                                <div class="col-lg-12 col-12">
                                    <div class="box">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="box">
                                                    <div class="box-body">
                                                        <div id="alert-noti-container"></div>
                                                        <div class="table-responsive">
                                                            <table id="notificationtableexample"
                                                                class="table table-bordered table-hover display nowrap margin-top-10 w-p100">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Title</th>
                                                                        <th>Notifications Date</th>
                                                                        <th>Status</th>
                                                                        <th>Actions</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @if ($notificationList)
                                                                    @foreach ($notificationList as $notificationList)
                                                                    <tr>
                                                                        <td>{{ $notificationList->Description }}</td>
                                                                        <td>{{ date('d/m/Y',
                                                                            strtotime($notificationList->created_at))
                                                                            }}</td>
                                                                        <td>
                                                                            <div
                                                                                class="col-xl-2 col-6 text-center align-self-center mb-20">
                                                                                <button
                                                                                    id="toggleChang_{{$notificationList->NotificationID}}"
                                                                                    onclick="toggleStatus({{$notificationList->NotificationID}},{{ ($notificationList->IsRead == 1) ? '0' : '1' }})"
                                                                                    type="button"
                                                                                    class="btn btn-sm btn-toggle  {{($notificationList->IsRead == 0) ? 'btn-success active' : 'btn-error'}}"
                                                                                    data-bs-toggle="button"
                                                                                    aria-pressed="true"
                                                                                    autocomplete="off">
                                                                                    <div class="handle"></div>
                                                                                </button>
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <button type="button"
                                                                                class="waves-effect waves-circle btn btn-circle btn-primary btn-xs mb-5"><i
                                                                                    class="fa fa-file-pdf-o"
                                                                                    aria-hidden="true"></i></button>
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach

                                                                    @endif

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                                <!-- /.box -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<script>
    function toggleStatus(ID, status) {
        if (status == 0) {
            statuss = 0;
            console.log('off');
            $('#toggleChang_' + ID).addClass('btn-success');
            $('#toggleChang_' + ID).removeClass('btn-error');
        } else {
            statuss = 1;
            $('#toggleChang_' + ID).removeClass('btn-success');
            $('#toggleChang_' + ID).addClass('btn-error');
        }
        $("#toggleChang_" + ID).attr("onclick", "toggleStatus(" + ID + ", " + statuss + ")");

        $('#loader').show();
        $('#loader').css('opacity', 1);
        $.ajax({
            url: "{{ route('admin.notificationtoggle.status') }}", // URL to your route
            type: "POST",
            data: {
                id: ID, // Pass the user ID
                Status: status, // Pass the user ID
                _token: '{{ csrf_token() }}' // CSRF token for Laravel
            },
            success: function(response) {
                $('#loader').hide();
                $('#loader').css('opacity', 0);
                $('#alert-noti-container').html(`
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ${response.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                `);
            },
            error: function(xhr) {
                $('#loader').hide();
                $('#loader').css('opacity', 0);
                $('#alert-noti-container').html(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ${xhr.responseJSON.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                `);
            }
        });
    }

    function toggleOtherDocStatus(ID, status) {
        if (status == 0) {
            statuss = 0;
            console.log('off');
            $('#toggleOtherDocChang_' + ID).addClass('btn-success');
            $('#toggleOtherDocChang_' + ID).removeClass('btn-error');
        } else {
            statuss = 1;
            $('#toggleOtherDocChang_' + ID).removeClass('btn-success');
            $('#toggleOtherDocChang_' + ID).addClass('btn-error');
        }
        $("#toggleOtherDocChang_" + ID).attr("onclick", "toggleOtherDocStatus(" + ID + ", " + statuss + ")");

        $('#loader').show();
        $('#loader').css('opacity', 1);
        $.ajax({
            url: "{{ route('admin.otherdoctoggle.status') }}", // URL to your route
            type: "POST",
            data: {
                id: ID, // Pass the user ID
                Status: status, // Pass the user ID
                _token: '{{ csrf_token() }}' // CSRF token for Laravel
            },
            success: function(response) {
                $('#loader').hide();
                $('#loader').css('opacity', 0);
                $('#alert-other-container').html(`
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ${response.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                `);
            },
            error: function(xhr) {
                $('#loader').hide();
                $('#loader').css('opacity', 0);
                $('#alert-other-container').html(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ${xhr.responseJSON.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                `);
            }
        });
    }

    function toggleScanDocStatus(ID, status) {
        if (status == 0) {
            statuss = 0;
            console.log('off');
            $('#toggleScanDocChang_' + ID).addClass('btn-success');
            $('#toggleScanDocChang_' + ID).removeClass('btn-error');
        } else {
            statuss = 1;
            $('#toggleScanDocChang_' + ID).removeClass('btn-success');
            $('#toggleScanDocChang_' + ID).addClass('btn-error');
        }
        $("#toggleScanDocChang_" + ID).attr("onclick", "toggleScanDocStatus(" + ID + ", " + statuss + ")");

        $('#loader').show();
        $('#loader').css('opacity', 1);
        $.ajax({
            url: "{{ route('admin.scandoctoggle.status') }}", // URL to your route
            type: "POST",
            data: {
                id: ID, // Pass the user ID
                Status: status, // Pass the user ID
                _token: '{{ csrf_token() }}' // CSRF token for Laravel
            },
            success: function(response) {
                $('#loader').hide();
                $('#loader').css('opacity', 0);
                $('#alert-scan-container').html(`
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    ${response.message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                `);
            },
            error: function(xhr) {
                $('#loader').hide();
                $('#loader').css('opacity', 0);
                $('#alert-scan-container').html(`
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