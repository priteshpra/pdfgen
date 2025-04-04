@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Add New Bussiness Category') }}</div>

    <div class="card-body">
        <form id="submit-form" method="POST" action="{{ route('admin.bussinesscategory.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="Country" class="required col-md-4 col-form-label text-md-right">{{ __('Bussiness
                        Category') }}</label>

                    <div class="form-group">
                        <input id="CategoryName" maxlength="50" type="text"
                            class="form-control @error('CategoryName') is-invalid @enderror" name="CategoryName"
                            value="{{ old('CategoryName') }}" required autocomplete="CategoryName">

                        @error('CategoryName')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="Country" class="required col-md-4 col-form-label text-md-right">{{ __('Meta Title')
                        }}</label>

                    <div class="form-group">
                        <input id="MetaTitle" maxlength="50" type="text"
                            class="form-control @error('MetaTitle') is-invalid @enderror" name="MetaTitle"
                            value="{{ old('MetaTitle') }}" required autocomplete="MetaTitle">

                        @error('MetaTitle')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="Country" class="required col-md-4 col-form-label text-md-right">{{ __('Meta Keywords')
                        }}</label>

                    <div class="form-group">
                        <input id="MetaKeywords" maxlength="50" type="text"
                            class="form-control @error('MetaKeywords') is-invalid @enderror" name="MetaKeywords"
                            value="{{ old('MetaKeywords') }}" required autocomplete="MetaKeywords">

                        @error('MetaKeywords')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="Country" class="required col-md-4 col-form-label text-md-right">{{ __('Meta
                        Description') }}</label>

                    <div class="form-group">
                        <input id="MetaDescription" maxlength="250" type="text"
                            class="form-control @error('MetaDescription') is-invalid @enderror" name="MetaDescription"
                            value="{{ old('MetaDescription') }}" required autocomplete="MetaDescription">

                        @error('MetaDescription')
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
                        {{ __('Create') }}
                    </button>
                </div>
            </div> -->
            <div class="box-footer">
                <button id="submitButton" type="submit" class="btn btn-primary" tabindex="5">
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