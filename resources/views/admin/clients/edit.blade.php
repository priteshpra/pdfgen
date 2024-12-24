@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Edit Client') }}</div>

    <div class="card-body">
        <form id="submit-form" method="POST" action="{{ route('admin.client.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label for="name" class="required col-md-4 col-form-label text-md-right">{{ __('Firm Name')
                        }}</label>

                    <div class="form-group">
                        <input id="FirmName" maxlength="50" type="text"
                            class="form-control @error('FirmName') is-invalid @enderror" name="FirmName"
                            value="{{ old('FirmName', $user->FirmName) }}" required autocomplete="FirmName">

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
                    <label for="FirstName" class="required col-md-4 col-form-label text-md-right">{{ __('Name')
                        }}</label>

                    <div class="form-group">
                        <input id="FirstName" maxlength="50" type="text"
                            class="form-control @error('FirstName') is-invalid @enderror" name="FirstName"
                            value="{{ old('FirstName', $user->FirstName) }}" required autocomplete="FirstName">

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
                        <input id="LastName" maxlength="50" type="text"
                            class="form-control @error('LastName') is-invalid @enderror" name="LastName"
                            value="{{ old('LastName', $user->LastName) }}" required autocomplete="LastName">

                        @error('LastName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="email" class="required col-md-4 col-form-label text-md-right">{{ __('E-Mail Address')
                        }}</label>

                    <div class="form-group">
                        <input id="Email" maxlength="250" type="email"
                            class="form-control @error('Email') is-invalid @enderror" name="Email"
                            value="{{ old('Email', $user->Email) }}" required autocomplete="Email">

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
                    <label for="email" class="required col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>

                    <div class="form-group">
                        <input id="MobileNo" maxlength="15" type="text"
                            class="form-control @error('MobileNo') is-invalid @enderror" name="MobileNo"
                            value="{{ old('MobileNo', $user->MobileNo) }}" required autocomplete="MobileNo">

                        @error('MobileNo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="email" class="required col-md-4 col-form-label text-md-right">{{ __('Address')
                        }}</label>

                    <div class="form-group">
                        <input id="Address" maxlength="100" type="text"
                            class="form-control @error('Address') is-invalid @enderror" name="Address"
                            value="{{ old('Address', $user->Address) }}" required autocomplete="Address">

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
                            <option value="{{$role->CountryID}}" {{ (old('CountryID',$role->CountryID ?? "") ==
                                $user->CountryID ) ? 'selected' : '' }}>{{$role->Country}}</option>
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
                            <option value="{{$role->StateID}}" {{ (old('StateID',$role->StateID ?? "") == $user->StateID
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
                            <option value="{{$role->CityID}}" {{ (old('CityID',$role->CityID ?? "") == $user->CityID ) ?
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
                    <label for="PinCode" class="required col-md-4 col-form-label text-md-right">{{ __('Pincode')
                        }}</label>

                    <div class="form-group">
                        <input id="PinCode" maxlength="6" type="text"
                            class="form-control @error('PinCode') is-invalid @enderror" name="PinCode"
                            value="{{ old('PinCode', $user->PinCode) }}" required autocomplete="PinCode">

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

                    <div class="form-group">
                        <input id="AadharNumber" maxlength="16" type="text"
                            class="form-control @error('AadharNumber') is-invalid @enderror" name="AadharNumber"
                            value="{{ old('AadharNumber', $user->AadharNumber) }}" required autocomplete="AadharNumber">

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
                        <input id="GSTNumber" maxlength="16" type="text"
                            class="form-control @error('GSTNumber') is-invalid @enderror" name="GSTNumber"
                            value="{{ old('GSTNumber', $user->GSTNumber) }}" required autocomplete="GSTNumber">

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

                    <div class="form-group">
                        <input id="PANNumber" maxlength="10" type="text"
                            class="form-control @error('PANNumber') is-invalid @enderror" name="PANNumber"
                            value="{{ old('PANNumber', $user->PANNumber) }}" required autocomplete="pan">

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
                                (old('FirmType',$user->FirmType
                            ?? "") == 'Proprietary' ) ? 'checked=""' : '' }}
                                tabindex="14">
                            <label for="radio_1">Proprietary</label>
                            <div class="help-block"></div>
                        </fieldset>
                        <fieldset>
                            <input name="FirmType" type="radio" id="radio_2" {{ (old('FirmType',$user->FirmType ??
                            "") == 'Private Limited' ) ? 'checked=""' : '' }} value="Private Limited" tabindex="15">
                            <label for="radio_2">Private Limited</label>
                        </fieldset>
                        <fieldset>
                            <input name="FirmType" type="radio" id="radio_3" value="LLP" {{
                                (old('FirmType',$user->FirmType ?? "") ==
                            'LLP' ) ? 'checked=""' : '' }}
                                tabindex="16">
                            <label for="radio_3">LLP</label>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="role_id" class="required col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                    <div class="form-group">
                        <select id="role_id" type="text" class="form-control @error('role_id') is-invalid @enderror"
                            name="role_id" required autocomplete="role_id" autofocus>
                            <option value="" selected hidden>Please Select</option>

                            @foreach ($roles as $id => $role)
                            <option value="{{$id}}" {{ (old('role_id',$user->role->id ?? "") == $id ) ? 'selected' : ''
                                }}>{{$role}}</option>
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
                        <input id="ClientCode" maxlength="4" type="text" readonly
                            class="form-control @error('ClientCode') is-invalid @enderror" name="ClientCode"
                            value="{{ $user->ClientCode }}" required autocomplete="ClientCode">

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
                            <option value="{{$bussiness->BusinessCategoryID}}" {{ (old('BusinnessCatID',$user->BusinnessCatID ?? "") == $bussiness->BusinessCategoryID ) ? 'selected' : ''
                            }}>{{$bussiness->CategoryName}}
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
                <button id="submitButton" type="submit" class="btn btn-primary" tabindex="5">
                    <i class="ti-save-alt"></i> UPDATE
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