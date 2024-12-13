@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Edit State') }}</div>

    <div class="card-body">
        <form method="POST" id="submit-form" action="{{ route('admin.state.update', $user->StateID) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
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
                </div>

                <div class="col-md-6">
                    <label for="State" class="required col-md-4 col-form-label text-md-right">{{ __('State') }}</label>

                    <div class="form-group">
                        <input id="State" type="text" class="form-control @error('State') is-invalid @enderror"
                            name="State" value="{{ old('State', $user->State) }}" required autocomplete="name">

                        @error('State')
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
                <button type="submit" id="submitButton" class="btn btn-primary" tabindex="5">
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