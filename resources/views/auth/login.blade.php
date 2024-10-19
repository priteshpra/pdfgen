@extends('layouts.app')

@section('content')
<div class="row align-items-center justify-content-md-center h-p100">



    <div class="col-12">

        <div class="row justify-content-center g-0">

            <div class="col-lg-5 col-md-5 col-12">

                <div class="bg-white rounded10 shadow-lg">

                    <div class="content-top-agile p-20 pb-0">

                        <h2 class="text-primary">Let's Get Started</h2>

                        <p class="mb-0">Sign in to continue ....</p>

                    </div>

                    <div class="p-40">

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group">

                                <div class="input-group mb-3">

                                    <span class="input-group-text bg-transparent"><img src="{{ asset('admin_assets/images_new/icons/user.gif') }}" alt="user" width="32" height="32"></span>

                                    <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                            </div>

                            <div class="form-group">

                                <div class="input-group mb-3">

                                    <span class="input-group-text  bg-transparent"><img src="{{ asset('admin_assets/images_new/icons/password.gif') }}" alt="password" width="32" height="32"></span>

                                    <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-6">

                                    <div class="checkbox">

                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label for="basic_checkbox_1">Remember Me</label>

                                    </div>

                                </div>

                                <!-- /.col -->

                                <div class="col-6">

                                    <div class="fog-pwd text-end">
                                        @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="hover-warning"><i class="ion ion-locked"></i> Forgot Password?</a><br>
                                        @endif
                                    </div>

                                </div>

                                <!-- /.col -->

                                <div class="col-12 text-center">

                                    <button type="submit" class="waves-effect waves-light btn btn-rounded btn-primary mb-5">SIGN IN</button>

                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection