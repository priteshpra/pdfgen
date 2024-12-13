@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Edit City') }}</div>

    <div class="card-body">
        <form id="submit-form" method="POST" action="{{ route('admin.city.update', $user->CityID) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label for="name" class="required col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="form-group">
                        <input id="City" type="text" class="form-control @error('City') is-invalid @enderror"
                            name="City" value="{{ old('City', $user->City) }}" required autocomplete="City">

                        @error('City')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                {{-- <div class="col-md-6">
                    <label for="CountryID" class="required col-md-4 col-form-label text-md-right">{{ __('Country')
                        }}</label>

                    <div class="form-group">
                        <select id="CountryID" type="text" class="form-control @error('CountryID') is-invalid @enderror"
                            name="CountryID" required autocomplete="CountryID" autofocus>
                            <option value="" selected hidden>Please Select</option>

                            @foreach ($country as $id => $role)
                            <option value="{{$role->CountryID}}" {{ ($role->CountryID == $user->CountryID ) ? 'selected'
                                : '' }}>{{$role->Country}}</option>
                            @endforeach
                        </select>

                        @error('CountryID')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div> --}}
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="CountryID" class="required col-md-4 col-form-label text-md-right">{{ __('State')
                        }}</label>

                    <div class="form-group">
                        <select id="StateID" type="text" class="form-control @error('StateID') is-invalid @enderror"
                            name="StateID" required autocomplete="StateID" autofocus>
                            <option value="" selected hidden>Please Select</option>

                            @foreach ($state as $id => $role)
                            <option value="{{$role->StateID}}" {{ ($role->StateID == $user->StateID ) ? 'selected' : ''
                                }}>{{$role->State}}</option>
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
            <!-- <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update') }}
                    </button>
                </div>
            </div> -->
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