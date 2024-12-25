@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <h3 class="page-title">Profile</h3>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-12">
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
                <form novalidate id="update-password-form" method="POST"
                    action="{{ route('admin.profile.update', $id) }}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Basic Info</h4>
                        <hr class="my-15">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Email <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input maxlength="250" type="email" readonly value="{{ $user->Email }}"
                                            name="Email" id="Email" class="form-control" required
                                            data-validation-required-message="This field is required"
                                            placeholder="Email" maxlength="50" autofocus tabindex="1">
                                        @error('Email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>First Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input maxlength="50" type="text" value="{{ $user->FirstName }}"
                                            name="FirstName" id="FirstName" class="form-control" required
                                            data-validation-required-message="This field is required"
                                            placeholder="First Name" maxlength="10" tabindex="2">
                                        @error('FirstName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Last Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input maxlength="50" type="text" value="{{ $user->LastName }}" name="LastName"
                                            id="LastName" class="form-control" required
                                            data-validation-required-message="This field is required"
                                            placeholder="Last Name" maxlength="10" tabindex="2">
                                        @error('LastName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Phone <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input maxlength="15" type="text" value="{{ $user->MobileNo }}" name="mobile_no"
                                            id="mobile_no" class="form-control" required
                                            data-validation-required-message="This field is required"
                                            placeholder="Mobile Number" maxlength="50" tabindex="3">
                                        @error('mobile_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" id="submitButton" class="btn btn-primary" tabindex="19">
                            <i class="ti-save-alt"></i> UPDATE
                        </button>
                        <button type="button" class="btn btn-warning me-1" tabindex="20">
                            <i class="ti-trash"></i> Cancel
                        </button>

                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $('#submitButton').on('click', function() {
        // You can add validation or other logic here before submitting
        $('#update-password-form').submit(); // Triggers the form submission
    });
</script>
@endsection