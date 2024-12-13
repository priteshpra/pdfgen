@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Add New Company') }}</div>

    <div class="card-body">
        <form id="update-password-form" method="POST" action="{{ route('admin.company.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <input id="CompanyID" type="hidden" class="form-control" name="CompanyID" value="{{ $clientId }}"
                        autocomplete="aadhar">
                    <input id="lastSegment" type="hidden" class="form-control" name="lastSegment"
                        value="{{ $lastSegment }}" autocomplete="aadhar">
                    <label for="name" class="required col-md-4 col-form-label text-md-right">{{ __('Firm Name')
                        }}</label>

                    <div class="form-group">
                        <input id="FirmName" type="text" class="form-control @error('FirmName') is-invalid @enderror"
                            name="FirmName" value="{{ old('FirmName', isset($user->FirmName) ? $user->FirmName: '') }}"
                            required autocomplete="FirmName">

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

                    <div class="form-group">
                        <input id="FirstName" type="text" class="form-control @error('FirstName') is-invalid @enderror"
                            name="FirstName"
                            value="{{ old('FirstName', isset($user->FirstName) ? $user->FirstName : '') }}" required
                            autocomplete="FirstName">

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
                    <label for="name" class="required col-md-4 col-form-label text-md-right">{{ __('Last Name')
                        }}</label>

                    <div class="form-group">
                        <input id="LastName" type="text" class="form-control @error('LastName') is-invalid @enderror"
                            name="LastName" value="{{ old('LastName', isset($user->LastName) ? $user->LastName : '') }}"
                            required autocomplete="LastName">

                        @error('LastName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="EmailID" class="required col-md-4 col-form-label text-md-right">{{ __('E-Mail Address')
                        }}</label>

                    <div class="form-group">
                        <input id="EmailID" type="EmailID" class="form-control @error('EmailID') is-invalid @enderror"
                            name="EmailID" value="{{ old('EmailID', isset($user->EmailID) ? $user->EmailID : '') }}"
                            required autocomplete="EmailID">

                        @error('EmailID')
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
                        <input id="MobileNo" type="text" class="form-control @error('MobileNo') is-invalid @enderror"
                            name="MobileNo" value="{{ old('MobileNo', isset($user->MobileNo) ? $user->MobileNo : '') }}"
                            required autocomplete="MobileNo">

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
                        <input id="Address" type="text" class="form-control @error('Address') is-invalid @enderror"
                            name="Address" value="{{ old('Address', isset($user->Address) ? $user->Address : '') }}"
                            required autocomplete="Address">

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

                    <div class="form-group">
                        <select id="CountryID" type="text" class="form-control @error('CountryID') is-invalid @enderror"
                            name="CountryID" required autocomplete="CountryID" autofocus>
                            <option value="" selected hidden>Please Select</option>

                            @foreach ($country as $id => $role)
                            <option value="{{$role->CountryID}}" {{ (old('CountryID',isset($role->CountryID) ?
                                $role->CountryID :
                                "") ==
                                isset($user->CountryID )) ? 'selected' : '' }}>{{$role->Country}}</option>
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

                    <div class="form-group">
                        <select id="StateID" type="text" class="form-control @error('StateID') is-invalid @enderror"
                            name="StateID" required autocomplete="StateID" autofocus>
                            <option value="" selected hidden>Please Select</option>

                            @foreach ($state as $id => $role)
                            <option value="{{$role->StateID}}" {{ (old('StateID',isset($role->StateID) ? $role->StateID
                                : "") ==
                                isset($user->StateID)
                                ) ? 'selected' : '' }}>{{$role->State}}</option>
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

                    <div class="form-group">
                        <select id="CityID" type="text" class="form-control @error('CityID') is-invalid @enderror"
                            name="CityID" required autocomplete="CityID" autofocus>
                            <option value="" selected hidden>Please Select</option>

                            @foreach ($city as $id => $role)
                            <option value="{{$role->CityID}}" {{ (old('CityID',isset($role->CityID) ? $role->CityID: "")
                                ==
                                isset($user->CityID) ) ?
                                'selected' : '' }}>{{$role->City}}</option>
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
                    <label for="PinCode" class="required col-md-4 col-form-label text-md-right">{{ __('PinCode')
                        }}</label>

                    <div class="form-group">
                        <input id="PinCode" type="text" class="form-control @error('PinCode') is-invalid @enderror"
                            name="PinCode" value="{{ old('PinCode', isset($user->PinCode) ? $user->PinCode : '') }}"
                            required autocomplete="PinCode">

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
                    <label for="AadharNumber" class="required col-md-4 col-form-label text-md-right">{{ __('AadharNumber
                        Number')
                        }}</label>

                    <div class="form-group">
                        <input id="AadharNumber" type="text"
                            class="form-control @error('AadharNumber') is-invalid @enderror" name="AadharNumber"
                            value="{{ old('AadharNumber', isset($user->AadharNumber) ? $user->AadharNumber : '') }}"
                            required autocomplete="AadharNumber">

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

                    <div class="form-group">
                        <input id="GSTNumber" type="text" class="form-control @error('GSTNumber') is-invalid @enderror"
                            name="GSTNumber"
                            value="{{ old('GSTNumber', isset($user->GSTNumber) ? $user->GSTNumber : '') }}" required
                            autocomplete="GSTNumber">

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
                    <label for="PANNumber" class="required col-md-4 col-form-label text-md-right">{{ __('PANNumber
                        Number')
                        }}</label>

                    <div class="form-group">
                        <input id="PANNumber" type="text" class="form-control @error('PANNumber') is-invalid @enderror"
                            name="PANNumber"
                            value="{{ old('PANNumber', isset($user->PANNumber) ? $user->PANNumber : '') }}" required
                            autocomplete="PANNumber">

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
                            <input name="FirmType" type="radio" id="radio_1" value="Proprietary" {{
                                (old('FirmType',isset($user->FirmType)
                            ?? "") == 'Proprietary' ) ? 'checked=""' : '' }}
                            tabindex="14">
                            <label for="radio_1">Proprietary</label>
                            <div class="help-block"></div>
                        </fieldset>
                        <fieldset>
                            <input name="FirmType" type="radio" id="radio_2" {{ (old('FirmType',isset($user->FirmType)
                            ??
                            "") == 'Private Limited' ) ? 'checked=""' : '' }} value="Private Limited" tabindex="15">
                            <label for="radio_2">Private Limited</label>
                        </fieldset>
                        <fieldset>
                            <input name="FirmType" type="radio" id="radio_3" value="LLP" {{
                                (old('FirmType',isset($user->FirmType)
                            ?? "") ==
                            'LLP' ) ? 'checked=""' : '' }}
                            tabindex="16">
                            <label for="radio_3">LLP</label>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="row">


                <div class="col-md-6">
                    <label for="RoleID" class="required col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                    <div class="form-group">
                        <select id="RoleID" type="text" class="form-control @error('RoleID') is-invalid @enderror"
                            name="RoleID" required autocomplete="RoleID" autofocus>
                            <option value="" selected hidden>Please Select</option>

                            @foreach ($roles as $id => $role)
                            <option value="{{$id}}" {{ (old('RoleID',isset($user->RoleID) ? $user->RoleID: "") == $id )
                                ? 'selected'
                                : ''
                                }}>{{$role}}</option>
                            @endforeach
                        </select>

                        @error('RoleID')
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
        $('#update-password-form').submit(); // Triggers the form submission
    });
</script>
@endsection