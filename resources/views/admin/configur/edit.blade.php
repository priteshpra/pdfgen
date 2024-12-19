@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="me-auto">
            <a href="{{ route('admin.configuration.edit',1) }}">
                <h3 class="page-title">CONFIGURATION</h3>
            </a>
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
                    action="{{ route('admin.configuration.update', $id) }}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <h4 class="box-title text-info mb-0"><i class="ti-user me-15"></i> Basic Setting Info</h4>
                        <hr class="my-15">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Support Email <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input maxlength="250" type="email" value="{{ $conf->SupportEmail }}"
                                            name="SupportEmail" id="SupportEmail" class="form-control" required
                                            data-validation-required-message="This field is required"
                                            placeholder="Support Email" maxlength="50" autofocus tabindex="1">
                                        @error('SupportEmail')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>SMTP Port <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" value="{{ $conf->SMTPPORT }}" name="SMTPPORT" id="SMTPPORT"
                                            class="form-control" required
                                            data-validation-required-message="This field is required"
                                            placeholder="SMTP Port" maxlength="10" tabindex="2">
                                        @error('SMTPPORT')
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
                                    <h5>SMTP Password <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="password" value="{{ $conf->SMTPPASS }}" name="SMTPPASS"
                                            id="SMTPPASS" class="form-control" required
                                            data-validation-required-message="This field is required"
                                            placeholder="Password" maxlength="50" tabindex="3">
                                        @error('SMTPPASS')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Android App Version <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" id="AndroidAppVersion" value="{{ $conf->AndroidAppVersion }}"
                                            name="AndroidAppVersion" class="form-control" required
                                            data-validation-required-message="This field is required"
                                            placeholder="Android App Version" maxlength="3" tabindex="4">
                                        @error('AndroidAppVersion')
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
                                    <h5>iOS App Version <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" value="{{ $conf->IosAppVersion }}" name="IosAppVersion"
                                            class="form-control" required
                                            data-validation-required-message="This field is required"
                                            placeholder="iOS App Version" maxlength="3" tabindex="5">
                                        @error('IosAppVersion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>iOS App Url <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" value="{{ $conf->AndroidAppUrl }}" name="AndroidAppUrl"
                                            class="form-control" required
                                            data-validation-required-message="This field is required"
                                            placeholder="iOS App Version" maxlength="3" tabindex="5">
                                        @error('AndroidAppUrl')
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
                                    <h5>iOS App Url <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" value="{{ $conf->IOSAppUrl }}" name="IOSAppUrl"
                                            class="form-control" required
                                            data-validation-required-message="This field is required"
                                            placeholder="iOS App Version" maxlength="3" tabindex="5">
                                        @error('IOSAppUrl')
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
                            <i class="ti-save-alt"></i> SUBMIT
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