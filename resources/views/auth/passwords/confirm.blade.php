@extends('layouts.app')

@section('title', 'Confirm Password')

@section('content')
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-header">
            <div class="logo">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h4>Confirm Password</h4>
            <p>Please confirm your password before continuing</p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="mb-3">
                <label for="password" class="form-label fw-bold text-muted small">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                </div>
                @error('password')
                    <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-check me-2"></i> Confirm Password
                </button>
            </div>

            @if (Route::has('password.request'))
                <div class="text-center mt-4">
                    <a href="{{ route('password.request') }}" class="text-decoration-none small fw-bold" style="color: var(--primary);">
                        Forgot Your Password?
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection