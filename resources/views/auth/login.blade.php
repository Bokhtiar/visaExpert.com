@extends('layouts.guest')

@section('title', 'Sign In')

@section('guest-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center mt-sm-5 mb-4 text-white-50">
                <div>
                    <h1 class="text-light">
                        {{ config('app.name') }}
                    </h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mt-4 shadow-lg">
                <div class="card-body p-4">
                    <div class="text-center mt-2">
                        <h5 class="text-primary">Welcome Back !</h5>
                        <p class="text-muted">Sign in to continue.</p>
                    </div>
                    <div class="p-2 mt-4">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" name="email"
                                       class="form-control @error('email') is-invalid @enderror" id="email"
                                       placeholder="Enter email">
                                @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="float-end">
                                    <a href="#" class="text-muted">Forgot password?</a>
                                </div>
                                <label class="form-label" for="password-input">Password</label>
                                <div class="position-relative auth-pass-inputgroup mb-3">
                                    <input type="password" name="password"
                                           class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                           placeholder="Enter password" id="password-input">
                                    <button
                                        class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon"
                                        type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i>
                                    </button>
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                <label class="form-check-label" name="remember" for="auth-remember-check">Remember
                                    me</label>
                            </div>
                            <div class="mt-4 text-center">
                                <button class="btn btn-clr-red rounded w-25" type="submit">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
