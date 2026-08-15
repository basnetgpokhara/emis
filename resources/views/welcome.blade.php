@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<style>
    .hero-section {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        animation: float 20s linear infinite;
    }

    @keyframes float {
        0% { transform: translateY(0); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0); }
    }

    .hero-content {
        text-align: center;
        color: white;
        position: relative;
        z-index: 1;
        padding: 2rem;
    }

    .hero-content .hero-icon {
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.15);
        border-radius: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        margin: 0 auto 2rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
    }

    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        letter-spacing: -1px;
    }

    .hero-content p {
        font-size: 1.2rem;
        opacity: 0.9;
        margin-bottom: 2rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .hero-content .btn-hero {
        padding: 0.75rem 2.5rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
        background: white;
        color: #667eea;
        border: none;
        transition: all 0.3s;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .hero-content .btn-hero:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(0,0,0,0.3);
    }

    .hero-content .btn-outline-hero {
        padding: 0.75rem 2.5rem;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
        background: transparent;
        color: white;
        border: 2px solid rgba(255,255,255,0.5);
        transition: all 0.3s;
    }

    .hero-content .btn-outline-hero:hover {
        background: rgba(255,255,255,0.1);
        border-color: white;
    }

    @media (max-width: 767.98px) {
        .hero-content h1 {
            font-size: 2rem;
        }
        .hero-content p {
            font-size: 1rem;
        }
    }
</style>

<div class="hero-section">
    <div class="hero-content">
        <div class="hero-icon">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <h1>Education Management<br>Information System</h1>
        <p>Streamline your school management with our comprehensive platform. Manage students, teachers, classes, attendance, exams, and more — all in one place.</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            @auth
                <a href="{{ route('dashboard') }}" class="btn-hero">
                    <i class="fas fa-th-large me-2"></i> Go to Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-hero">
                    <i class="fas fa-sign-in-alt me-2"></i> Sign In
                </a>
                <a href="{{ route('register') }}" class="btn-outline-hero">
                    <i class="fas fa-user-plus me-2"></i> Get Started
                </a>
            @endauth
        </div>
    </div>
</div>
@endsection