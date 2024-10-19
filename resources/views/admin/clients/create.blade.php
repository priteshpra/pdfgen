@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Add New Client') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.client.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="role_id" class="required col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                        <select id="role_id" type="text" class="form-control @error('role_id') is-invalid @enderror" name="role_id" required autocomplete="role_id" autofocus>
                            <option value="" selected hidden>Please Select</option>

                            @foreach ($roles as $id => $role)
                            <option value="{{$id}}" {{ (old('role_id', '') == $id ) ? 'selected' : '' }}>{{$role}}</option>
                            @endforeach
                        </select>

                        @error('role_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <input id="user_type" type="hidden" class="form-control @error('user_type') is-invalid @enderror" name="user_type" value="3" required autocomplete="name">

                <div class="col-md-6">
                    <label for="firm_name" class="required col-md-4 col-form-label text-md-right">{{ __('Firm Name') }}</label>

                    <div class="controls">
                        <input id="firm_name" type="text" class="form-control @error('firm_name') is-invalid @enderror" name="firm_name" value="{{ old('firm_name') }}" required autocomplete="firm_name">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="name" class="required col-md-4 col-form-label text-md-right">{{ __('Client Name') }}</label>

                    <div class="controls">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="email" class="required col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="controls">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
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

                    <div class="controls">
                        <input id="mobile_no" type="text" class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{ old('mobile_no') }}" required autocomplete="mobile_no">

                        @error('mobile_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="email" class="required col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                    <div class="controls">
                        <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">

                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="CountryID" class="required col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                    <div class="controls">
                        <select id="CountryID" type="text" class="form-control @error('CountryID') is-invalid @enderror" name="CountryID" required autocomplete="CountryID" autofocus>
                            <option value="" selected hidden>Please Select</option>

                            @foreach ($country as $id => $role)
                            <option value="{{$role->CountryID}}" {{ (old('CountryID', '') == $id ) ? 'selected' : '' }}>{{$role->Country}}</option>
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
                    <label for="StateID" class="required col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                    <div class="controls">
                        <select id="StateID" type="text" class="form-control @error('StateID') is-invalid @enderror" name="StateID" required autocomplete="StateID" autofocus>
                            <option value="" selected hidden>Please Select</option>

                            @foreach ($state as $id => $role)
                            <option value="{{$role->StateID}}" {{ (old('StateID', '') == $id ) ? 'selected' : '' }}>{{$role->State}}</option>
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
                        <select id="CityID" type="text" class="form-control @error('CityID') is-invalid @enderror" name="CityID" required autocomplete="CityID" autofocus>
                            <option value="" selected hidden>Please Select</option>

                            @foreach ($city as $id => $role)
                            <option value="{{$role->CityID}}" {{ (old('CityID', '') == $id ) ? 'selected' : '' }}>{{$role->City}}</option>
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
                    <label for="pincode" class="required col-md-4 col-form-label text-md-right">{{ __('Pincode') }}</label>

                    <div class="controls">
                        <input id="pincode" type="text" class="form-control @error('pincode') is-invalid @enderror" name="pincode" value="{{ old('pincode') }}" required autocomplete="pincode">

                        @error('pincode')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">
                    <label for="aadhar" class="required col-md-4 col-form-label text-md-right">{{ __('Aadhar Number') }}</label>

                    <div class="controls">
                        <input id="aadhar" type="text" class="form-control @error('aadhar') is-invalid @enderror" name="aadhar" value="{{ old('aadhar') }}" required autocomplete="aadhar">

                        @error('aadhar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="gst" class="required col-md-4 col-form-label text-md-right">{{ __('GST Number') }}</label>

                    <div class="controls">
                        <input id="gst" type="text" class="form-control @error('gst') is-invalid @enderror" name="gst" value="{{ old('gst') }}" required autocomplete="gst">

                        @error('gst')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">
                    <label for="pan" class="required col-md-4 col-form-label text-md-right">{{ __('PAN Number') }}</label>

                    <div class="controls">
                        <input id="pan" type="text" class="form-control @error('pan') is-invalid @enderror" name="pan" value="{{ old('pan') }}" required autocomplete="pan">

                        @error('pan')
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
                            <input name="firm_type" type="radio" id="radio_1" value="Proprietary" required="" checked="" tabindex="14">
                            <label for="radio_1">Proprietary</label>
                            <div class="help-block"></div>
                        </fieldset>
                        <fieldset>
                            <input name="firm_type" type="radio" id="radio_2" value="Private Limited" tabindex="15">
                            <label for="radio_2">Private Limited</label>
                        </fieldset>
                        <fieldset>
                            <input name="firm_type" type="radio" id="radio_3" value="LLP" tabindex="16">
                            <label for="radio_3">LLP</label>
                        </fieldset>
                    </div>
                </div>
            </div>
            <div class="row">

                <div class="col-md-6">
                    <label for="password" class="required col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="controls">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="password-confirm" class="required col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="controls">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>
            </div>



            <!-- <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create') }}
                    </button>
                </div>
            </div> -->
            <div class="box-footer">
                <button type="submit" class="btn btn-primary" tabindex="5">
                    <i class="ti-save-alt"></i> SUBMIT
                </button>
                <button type="button" class="btn btn-warning me-1" tabindex="6">
                    <i class="ti-trash"></i> Cancel
                </button>
            </div>
        </form>
    </div>
</div>

@endsection