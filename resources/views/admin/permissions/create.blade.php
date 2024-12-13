@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Add New Permission') }}</div>

    <div class="card-body">
        <form id="submit-form" method="POST" action="{{ route('admin.permissions.store') }}">
            @csrf
            <div class="form-group row">
                <label for="name" class="required col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ old('name') }}" required autocomplete="name">

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
                        {{ __('Create') }}
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