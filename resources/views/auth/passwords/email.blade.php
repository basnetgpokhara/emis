@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <div class="logo">
                <i class="fas fa-key"></i>
            </div>
            <h4>Reset Password</h4>
            <p>Enter your email to receive reset link</p>
        </div>

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-bold text-muted small">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                </div>
                @error('email')
                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-paper-plane me-2"></i> Send Reset Link
                </button>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-decoration-none small fw-bold" style="color: var(--primary);">
                    <i class="fas fa-arrow-left me-1"></i> Back to Login
                </a>
            </div>
        </form>
    </div>
</div>
@endsection