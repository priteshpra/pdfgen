@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Add New CMS') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.cms.store') }}">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <label for="PageID" class="required col-md-4 col-form-label text-md-right">{{ __('Page') }}</label>

                    <div class="form-group">
                        <select id="PageID" type="text" class="form-control @error('PageID') is-invalid @enderror" name="PageID" required autocomplete="PageID" autofocus>
                            <option value="" selected hidden>Please Select</option>

                            @foreach ($page as $id => $page)
                            <option value="{{$page->PageID}}" {{ (old('PageID', '') == $id ) ? 'selected' : '' }}>{{$page->PageName}}</option>
                            @endforeach
                        </select>

                        @error('PageID')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="name" class="required col-md-4 col-form-label text-md-right">{{ __('Content') }}</label>

                    <div class="form-group">
                        <input id="Content" type="text" class="form-control @error('Content') is-invalid @enderror" name="Content" value="{{ old('Content') }}" required autocomplete="Content">

                        @error('Content')
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