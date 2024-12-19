@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Add New Document') }}</div>

    <div class="card-body">
        <form method="POST" id="update-password-form" action="{{ route('admin.otherdocument.store') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input id="lastSegment" type="hidden" class="form-control @error('lastSegment') is-invalid @enderror"
                    name="lastSegment" value="{{ $lastSegment }}" required autocomplete="name">
                <input id="UserID" type="hidden" class="form-control @error('UserID') is-invalid @enderror"
                    name="UserID" value="{{ $userId }}" required autocomplete="name">
                <input id="BatchNo" type="hidden" class="form-control @error('BatchNo') is-invalid @enderror"
                    name="BatchNo" value="{{ $BatchNo }}" required autocomplete="name">
                <input id="CompanyID" type="hidden" class="form-control @error('CompanyID') is-invalid @enderror"
                    name="CompanyID" value="{{ $CompanyID }}" required autocomplete="name">
                <div class="col-md-6">
                    <label for="name" class="required col-md-4 col-form-label text-md-right">{{ __('Title')
                        }}</label>

                    <div class="controls">
                        <input id="Title" maxlength="50" type="text"
                            class="form-control @error('Title') is-invalid @enderror" name="Title"
                            value="{{ old('Title') }}" required autocomplete="Title">

                        @error('Title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="name" class="required col-md-4 col-form-label text-md-right">{{ __('Remarks')
                        }}</label>

                    <div class="controls">
                        <input id="Remarks" maxlength="250" type="text"
                            class="form-control @error('Remarks') is-invalid @enderror" name="Remarks"
                            value="{{ old('Remarks') }}" required autocomplete="name">

                        @error('Remarks')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="name" class="required col-md-4 col-form-label text-md-right">{{ __('Document')
                        }}</label>

                    <div class="controls">
                        <input id="images" type="file" multiple
                            class="form-control @error('images') is-invalid @enderror" name="images[]"
                            value="{{ old('images') }}" required autocomplete="name">

                        @error('images')
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