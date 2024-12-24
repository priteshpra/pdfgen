@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Add New CAs') }}</div>

    <div class="card-body">
        {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif --}}
    <form id="submit-form" method="POST" action="{{ route('admin.cas.store') }}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label for="FirmName" class="required col-md-4 col-form-label text-md-right">{{ __('Firm Name')
                        }}</label>

                <div class="form-group">
                    <input id="FirmName" type="text" class="form-control @error('FirmName') is-invalid @enderror"
                        name="FirmName" maxlength="50" value="{{ old('FirmName') }}" required
                        autocomplete="FirmName">

                    @error('FirmName')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <input id="UserType" type="hidden" class="form-control @error('UserType') is-invalid @enderror"
                name="UserType" value="4" required autocomplete="name">
            <div class="col-md-6">
                <label for="FirstName" class="required col-md-4 col-form-label text-md-right">{{ __('First Name')
                        }}</label>

                <div class="controls">
                    <input id="FirstName" maxlength="50" type="text"
                        class="form-control @error('FirstName') is-invalid @enderror" name="FirstName"
                        value="{{ old('FirstName') }}" required autocomplete="FirstName">

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

                <div class="controls">
                    <input id="LastName" maxlength="50" type="text"
                        class="form-control @error('LastName') is-invalid @enderror" name="LastName"
                        value="{{ old('LastName') }}" required autocomplete="LastName">

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

                <div class="controls">
                    <input id="Email" maxlength="250" type="email"
                        class="form-control @error('Email') is-invalid @enderror" name="Email"
                        value="{{ old('Email') }}" required autocomplete="Email">

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

                <div class="controls">
                    <input id="MobileNo" maxlength="15" type="text"
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

                <div class="controls">
                    <input id="Address" type="text" class="form-control @error('Address') is-invalid @enderror"
                        name="Address" maxlength="100" value="{{ old('Address') }}" required autocomplete="Address">

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
                <label for="CountryID" class="required col-md-4 col-form-label text-md-right">{{ __('Country')
                        }}</label>

                <div class="controls">
                    <select id="CountryID" type="text" class="form-control @error('CountryID') is-invalid @enderror"
                        name="CountryID" required autocomplete="CountryID" autofocus>
                        <option value="" selected hidden>Please Select</option>

                        @foreach ($country as $id => $role)
                        <option value="{{$role->CountryID}}" {{ (old('CountryID', '' )==$id ) ? 'selected' : '' }}>
                            {{$role->Country}}
                        </option>
                        @endforeach
                    </select>

                    @error('CountryID')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <label for="StateID" class="required col-md-4 col-form-label text-md-right">{{ __('State')
                        }}</label>

                <div class="controls">
                    <select id="StateID" type="text" class="form-control @error('StateID') is-invalid @enderror"
                        name="StateID" required autocomplete="StateID" autofocus>
                        <option value="" selected hidden>Please Select</option>

                        @foreach ($state as $id => $role)
                        <option value="{{$role->StateID}}" {{ (old('StateID', '' )==$id ) ? 'selected' : '' }}>
                            {{$role->State}}
                        </option>
                        @endforeach
                    </select>

                    @error('StateID')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="CityID" class="required col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                <div class="controls">
                    <select id="CityID" type="text" class="form-control @error('CityID') is-invalid @enderror"
                        name="CityID" required autocomplete="CityID" autofocus>
                        <option value="" selected hidden>Please Select</option>

                        @foreach ($city as $id => $role)
                        <option value="{{$role->CityID}}" {{ (old('CityID', '' )==$id ) ? 'selected' : '' }}>
                            {{$role->City}}
                        </option>
                        @endforeach
                    </select>

                    @error('CityID')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <label for="PinCode" class="required col-md-4 col-form-label text-md-right">{{ __('Pincode')
                        }}</label>

                <div class="controls">
                    <input id="PinCode" maxlength="6" type="text"
                        class="form-control @error('PinCode') is-invalid @enderror" name="PinCode"
                        value="{{ old('PinCode') }}" required autocomplete="PinCode">

                    @error('PinCode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6">
                <label for="AadharNumber" class="required col-md-4 col-form-label text-md-right">{{ __('Aadhar
                        Number')
                        }}</label>

                <div class="controls">
                    <input id="AadharNumber" maxlength="16" type="text"
                        class="form-control @error('AadharNumber') is-invalid @enderror" name="AadharNumber"
                        value="{{ old('AadharNumber') }}" required autocomplete="AadharNumber">

                    @error('AadharNumber')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <label for="GSTNumber" class="required col-md-4 col-form-label text-md-right">{{ __('GST Number')
                        }}</label>

                <div class="controls">
                    <input id="GSTNumber" maxlength="16" type="text"
                        class="form-control @error('GSTNumber') is-invalid @enderror" name="GSTNumber"
                        value="{{ old('GSTNumber') }}" required autocomplete="GSTNumber">

                    @error('GSTNumber')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6">
                <label for="PANNumber" class="required col-md-4 col-form-label text-md-right">{{ __('PAN Number')
                        }}</label>

                <div class="controls">
                    <input id="PANNumber" maxlength="10" type="text"
                        class="form-control @error('PANNumber') is-invalid @enderror" name="PANNumber"
                        value="{{ old('PANNumber') }}" required autocomplete="PANNumber">

                    @error('PANNumber')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <h5>Firm Type <span class="text-danger">*</span></h5>
                    <fieldset class="controls">
                        <input name="FirmType" type="radio" id="radio_1" value="Proprietary" required="" checked=""
                            tabindex="14">
                        <label for="radio_1">Proprietary</label>
                        <div class="help-block"></div>
                    </fieldset>
                    <fieldset>
                        <input name="FirmType" type="radio" id="radio_2" value="Private Limited" tabindex="15">
                        <label for="radio_2">Private Limited</label>
                    </fieldset>
                    <fieldset>
                        <input name="FirmType" type="radio" id="radio_3" value="LLP" tabindex="16">
                        <label for="radio_3">LLP</label>
                    </fieldset>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-md-6">
                <label for="password" class="required col-md-4 col-form-label text-md-right">{{ __('Password')
                        }}</label>

                <div class="controls">
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

                <div class="controls">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                        required autocomplete="new-password">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="role_id" class="required col-md-4 col-form-label text-md-right">{{ __('Role')
                            }}</label>

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
                <label for="ClientCode" class="required col-md-4 col-form-label text-md-right">{{ __('Client Code')
                        }}</label>

                <div class="controls">
                    <input id="ClientCode" maxlength="4" type="text"
                        class="form-control @error('ClientCode') is-invalid @enderror" name="ClientCode"
                        value="{{ old('ClientCode') }}" required autocomplete="ClientCode">

                    @error('ClientCode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="BusinnessCatID" class="required col-md-4 col-form-label text-md-right">{{ __('Business Category')
                            }}</label>

                    <select id="BusinnessCatID" type="text" class="form-control @error('BusinnessCatID') is-invalid @enderror"
                        name="BusinnessCatID" required autocomplete="BusinnessCatID" autofocus>
                        <option value="" selected hidden>Please Select</option>

                        @foreach ($bussiness as $id => $bussiness)
                        <option value="{{$bussiness->BusinessCategoryID}}" {{ (old('BusinnessCatID', '' )==$bussiness->BusinessCategoryID ) ? 'selected' : '' }}>{{$bussiness->CategoryName}}
                        </option>
                        @endforeach
                    </select>

                    @error('BusinnessCatID')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
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