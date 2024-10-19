@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Add New Country') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.country.store') }}">
            @csrf
            <div class="form-group row">
                <label for="Country" class="required col-md-4 col-form-label text-md-right">{{ __('Country') }}</label>

                <div class="col-md-6">
                    <input id="Country" type="text" class="form-control @error('Country') is-invalid @enderror" name="Country" value="{{ old('Country') }}" required autocomplete="Country">

                    @error('Country')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Create') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection