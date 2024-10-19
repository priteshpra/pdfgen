@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('Edit Employee') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <label for="role_id" class="required col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>

                    <div class="form-group">
                        <select id="role_id" type="text" class="form-control @error('role_id') is-invalid @enderror" name="role_id" required autocomplete="role_id" autofocus>
                            <option value="" selected hidden>Please Select</option>

                            @foreach ($roles as $id => $role)
                            <option value="{{$id}}" {{ (old('role_id',$user->role->id ?? "") == $id ) ? 'selected' : '' }}>{{$role}}</option>
                            @endforeach
                        </select>

                        @error('role_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="name" class="required col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="form-group">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name">

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
                    <label for="name" class="required col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                    <div class="form-group">
                        <input id="lname" type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{ old('lname', $user->lname) }}" required autocomplete="name">

                        @error('lname')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="email" class="required col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

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

                    <div class="form-group">
                        <input id="mobile_no" type="mobile_no" class="form-control @error('mobile_no') is-invalid @enderror" name="mobile_no" value="{{ old('mobile_no', $user->mobile_no) }}" required autocomplete="mobile_no">

                        @error('mobile_no')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="email" class="required col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                    <div class="form-group">
                        <input id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address', $user->address) }}" required autocomplete="address">

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
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                        @error('password')
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
                <button type="submit" class="btn btn-primary" tabindex="5">
                    <i class="ti-save-alt"></i> UPDATE
                </button>
                <button type="button" class="btn btn-warning me-1" tabindex="6">
                    <i class="ti-trash"></i> Cancel
                </button>
            </div>
        </form>
    </div>
</div>

@endsection