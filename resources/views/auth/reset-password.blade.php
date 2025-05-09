@extends('layouts.auth')

@section('title', 'Reset Password')

@section('auth-content')
    <div class="p-10 card-body p-lg-20">
        <form class="form w-100" method="POST" action="{{ route('password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="mb-10 text-center">
                <h1 class="mb-3 text-dark fw-bolder">Setup New Password</h1>
                <div class="text-gray-500 fw-semibold fs-6">Have you already reset the password ?
                    <a href="{{ route('login') }}" class="link-primary fw-bold">Sign in</a>
                </div>
            </div>
            <div class="mb-8 fv-row" data-kt-password-meter="true">
                <div class="mb-1">
                    <div class="mb-8 position-relative">
                        <input class="bg-transparent is-valid form-control" type="email" placeholder="Email"
                            name="email" value="{{ old('email', $request->email) }}" autocomplete="off" readonly />
                    </div>
                </div>
                <div class="mb-8 fv-row" data-kt-password-meter="true">
                    <div class="mb-1">
                        <div class="mb-3 position-relative">
                            <input class="bg-transparent form-control" type="password" placeholder="Password"
                                name="password" autocomplete="off" />
                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                data-kt-password-meter-control="visibility">
                                <i class="bi bi-eye-slash fs-2"></i>
                                <i class="bi bi-eye fs-2 d-none"></i>
                            </span>
                        </div>
                        <div class="mb-3 d-flex align-items-center" data-kt-password-meter-control="highlight">
                            <div class="rounded flex-grow-1 bg-secondary bg-active-success h-5px me-2"></div>
                            <div class="rounded flex-grow-1 bg-secondary bg-active-success h-5px me-2"></div>
                            <div class="rounded flex-grow-1 bg-secondary bg-active-success h-5px me-2"></div>
                            <div class="rounded flex-grow-1 bg-secondary bg-active-success h-5px"></div>
                        </div>
                        @error('password')
                            <span
                                class="fv-plugins-message-container fw-bolder invalid-feedback"><strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
                </div>
                <div class="mb-8 fv-row">
                    <input type="password" placeholder="Repeat Password" name="password_confirmation" autocomplete="off"
                        class="bg-transparent form-control" />
                    @error('password_confirmation')
                        <span
                            class="fv-plugins-message-container fw-bolder invalid-feedback"><strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-10 d-grid">
                    <button type="submit" class="btn btn-primary btn-sm">
                        <span class="indicator-label text-uppercase">Reset Password</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
