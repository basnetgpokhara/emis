@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <div class="logo">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <h4>Welcome Back!</h4>
            <p>Sign in to your EMIS account</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-bold text-muted small">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter your email">
                </div>
                @error('email')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-bold text-muted small">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Enter your password">
                </div>
                @error('password')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="mb-3 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label small" for="remember">
                        Remember Me
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a class="text-decoration-none small fw-bold" href="{{ route('password.request') }}" style="color: var(--primary);">
                        Forgot Password?
                    </a>
                @endif
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-sign-in-alt me-2"></i> Sign In
                </button>
            </div>

            @if (Route::has('register'))
                <div class="text-center mt-4">
                    <span class="text-muted small">Don't have an account?</span>
                    <a href="{{ route('register') }}" class="text-decoration-none small fw-bold ms-1" style="color: var(--primary);">
                        Create Account
                    </a>
                </div>
            @endif
        </form>

        <div class="mt-4 pt-3 border-top text-center">
            <p class="small text-muted mb-0">
                <strong>Demo Credentials:</strong><br>
                Admin: admin@emis.local / password
            </p>
        </div>
    </div>
</div>
@endsection