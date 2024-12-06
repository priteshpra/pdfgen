@extends('layouts.admin')

@section('content')
<div class="container-full">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <a href="{{ route('admin.users.index') }}">
                    <h3 class="page-title">{{ UCWORDS($user->name) }} {{ UCWORDS($user->lname) }} - Details</h3>
                </a>
            </div>
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
                                                            <label>{{ $user->email }}</label>
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
                                                    Other Info</h4>
                                                <hr class="my-15">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Address</label><br>
                                                            <label>{{ $user->address }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="form-label">Role Name</label><br>
                                                            <label>{{ $roles[$user->role_id] }} </label>
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
                                        <form class="form" action="{{ route('admin.cas.update-password', $user->id) }}"
                                            method="POST">
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

@endsection