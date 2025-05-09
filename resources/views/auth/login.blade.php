@extends('layouts.auth')

@section('title', 'Login')

@section('auth-content')
    <div class="p-10 card-body p-lg-10">
        <form class="form w-100" id="kt_sign_in_form" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="text-center mb-11 me-8">
                <img alt="Logo" src="{{ asset('assets/media/logos/favicon-white.png') }}" width="65" />
            </div>

            <div class="my-8 separator separator-content">
                <span class="text-gray-500 w-400px fw-semibold fs-7">
                    Enter Details to Log In!
                </span>
            </div>

            <div class="mb-5 fv-row">
                <input type="text" placeholder="Username" name="username" autocomplete="off"
                    class="form-control form-control-sm bg-transparent @error('username') is-invalid @enderror" />
                @error('username')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 fv-row">
                <input type="password" placeholder="Password" name="password" id="password" autocomplete="off"
                    class="form-control form-control-sm bg-transparent  @error('password') is-invalid @enderror" />
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="flex-wrap gap-3 mb-5 d-flex flex-stack fs-base fw-semibold">
                <div></div>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="link-primary">
                        Forgot Password ?
                    </a>
                @endif
            </div>

            <div class="mb-10 d-grid">
                <button type="submit" class="btn btn-primary btn-sm">
                    <span class="indicator-label text-uppercase">
                        Sign In
                    </span>
                </button>
            </div>
        </form>
    </div>
@endsection
