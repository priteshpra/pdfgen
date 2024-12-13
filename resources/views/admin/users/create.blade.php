@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Add New Employee') }}</div>

    <div class="card-body">
        <form id="submit-form" method="POST" action="{{ route('admin.users.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="role_id" class="required col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                    <div class="form-group">
                        <select id="role_id" type="text" class="form-control @error('role_id') is-invalid @enderror"
                            name="role_id" required autocomplete="role_id" autofocus>
                            <option value="" selected hidden>Please Select</option>

                            @foreach ($roles as $id => $role)
                            <option value="{{$id}}" {{ (old('role_id', '' )==$id ) ? 'selected' : '' }}>{{$role}}
                            </option>
                            @endforeach
                        </select>

                        @error('role_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="FirstName" class="required col-md-4 col-form-label text-md-right">{{ __('First Name')
                        }}</label>

                    <div class="form-group">
                        <input id="FirstName" type="text" class="form-control @error('FirstName') is-invalid @enderror"
                            name="FirstName" value="{{ old('FirstName') }}" required autocomplete="FirstName">

                        @error('FirstName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <label for="LastName" class="required col-md-4 col-form-label text-md-right">{{ __('Last Name')
                        }}</label>

                    <div class="form-group">
                        <input id="LastName" type="text" class="form-control @error('LastName') is-invalid @enderror"
                            name="LastName" value="{{ old('LastName') }}" required autocomplete="LastName">

                        @error('LastName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="Email" class="required col-md-4 col-form-label text-md-right">{{ __('E-Mail Address')
                        }}</label>

                    <div class="form-group">
                        <input id="Email" type="email" class="form-control @error('Email') is-invalid @enderror"
                            name="Email" value="{{ old('Email') }}" required autocomplete="Email">

                        @error('Email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">
                    <label for="MobileNo" class="required col-md-4 col-form-label text-md-right">{{ __('Mobile')
                        }}</label>

                    <div class="form-group">
                        <input id="MobileNo" type="MobileNo"
                            class="form-control @error('MobileNo') is-invalid @enderror" name="MobileNo"
                            value="{{ old('MobileNo') }}" required autocomplete="MobileNo">

                        @error('MobileNo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="Address" class="required col-md-4 col-form-label text-md-right">{{ __('Address')
                        }}</label>

                    <div class="form-group">
                        <input id="Address" type="Address" class="form-control @error('Address') is-invalid @enderror"
                            name="Address" value="{{ old('Address') }}" required autocomplete="Address">

                        @error('Address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">
                    <label for="password" class="required col-md-4 col-form-label text-md-right">{{ __('Password')
                        }}</label>

                    <div class="form-group">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="password-confirm" class="required col-md-4 col-form-label text-md-right">{{ __('Confirm
                        Password') }}</label>

                    <div class="form-group">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password">
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" id="submitButton" class="btn btn-primary" tabindex="5">
                    <i class="ti-save-alt"></i> SUBMIT
                </button>
                <button type="button" class="btn btn-warning me-1" tabindex="6">
                    <i class="ti-trash"></i> Cancel
                </button>
            </div>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $('#submitButton').on('click', function() {
        // You can add validation or other logic here before submitting
        $('#submit-form').submit(); // Triggers the form submission
    });
</script>
@endsection