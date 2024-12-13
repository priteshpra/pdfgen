@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Edit Country') }}</div>

    <div class="card-body">
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
        <form id="submit-form" method="POST" action="{{ route('admin.country.update', $user->CountryID) }}">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="name" class="required col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="Country" type="text" class="form-control @error('Country') is-invalid @enderror"
                        name="Country" value="{{ old('Country', $user->Country) }}" required autocomplete="name">

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>



            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button id="submitButton" type="submit" class="btn btn-primary">
                        {{ __('Update') }}
                    </button>
                    <button type="button" class="btn btn-warning me-1" tabindex="6">
                        <i class="ti-trash"></i> Cancel
                    </button>
                </div>
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