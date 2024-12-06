@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Edit Page') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.page.update', $user->PageID) }}">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label for="PageName" class="required col-md-4 col-form-label text-md-right">{{ __('PageName')
                    }}</label>

                <div class="col-md-6">
                    <input id="PageName" type="text" class="form-control @error('PageName') is-invalid @enderror"
                        name="PageName" value="{{ old('PageName', $user->PageName) }}" required autocomplete="PageName">

                    @error('PageName')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>



            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
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

@endsection