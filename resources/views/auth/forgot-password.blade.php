@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('auth-content')
    <div class="p-10 card-body p-lg-10">
        <form class="form w-100" id="kt_sign_in_form" method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="text-center mb-11">
                <h4 class="mb-3 text-gray-900 fw-bolder">
                    Enter your email address and we will email you a password reset link.
                </h4>
            </div>

            <div class="mb-8 fv-row">
                <input type="text" placeholder="Email" name="email" autocomplete="off"
                    class="form-control bg-transparent @error('email') is-invalid @enderror" />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-10 d-flex justify-content-between">
                <button type="submit" class="btn btn-primary btn-sm">
                    <span class="indicator-label text-uppercase">
                        Email Password Reset Link</span>
                </button>
                <a href="{{ route('login') }}" class="btn btn-secondary btn-sm">
                    <span class="indicator-label text-uppercase"> Sign In Instead</span>
                </a>
            </div>
        </form>
    </div>
@endsection
