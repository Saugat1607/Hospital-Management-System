<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MediCare — Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --cream: #f7f3ee;
            --deep: #0d1b2a;
            --teal: #0a7e6e;
            --teal-light: #0fa88f;
            --teal-pale: #e6f7f5;
            --muted: #6b7280;
            --border: #e5ded5;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'DM Sans', sans-serif;
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: var(--cream);
        }

        /* ── LEFT PANEL ── */
        .left-panel {
            background: linear-gradient(145deg, var(--deep) 0%, #0d2d40 50%, #0a3d35 100%);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px;
            position: relative;
            overflow: hidden;
        }

        .left-panel::before {
            content: '';
            position: absolute;
            top: -100px; right: -100px;
            width: 400px; height: 400px;
            background: rgba(10,126,110,0.12);
            border-radius: 50%;
        }

        .left-panel::after {
            content: '';
            position: absolute;
            bottom: -80px; left: -60px;
            width: 300px; height: 300px;
            background: rgba(10,126,110,0.08);
            border-radius: 50%;
        }

        .panel-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            z-index: 1;
        }

        .logo-icon {
            width: 44px; height: 44px;
            background: var(--teal);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
        }

        .logo-text {
            font-family: 'Playfair Display', serif;
            color: #fff;
            font-size: 22px;
            font-weight: 700;
        }

        .panel-content {
            position: relative;
            z-index: 1;
        }

        .panel-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.8);
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 20px;
            margin-bottom: 20px;
        }

        .panel-title {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            font-weight: 700;
            color: #fff;
            line-height: 1.15;
            margin-bottom: 16px;
        }

        .panel-title span {
            color: var(--teal-light);
        }

        .panel-desc {
            color: rgba(255,255,255,0.55);
            font-size: 15px;
            line-height: 1.7;
            max-width: 340px;
        }

        .panel-features {
            display: flex;
            flex-direction: column;
            gap: 14px;
            margin-top: 40px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            color: rgba(255,255,255,0.7);
            font-size: 14px;
        }

        .feature-dot {
            width: 32px; height: 32px;
            background: rgba(10,126,110,0.25);
            border: 1px solid rgba(10,126,110,0.4);
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .panel-footer {
            color: rgba(255,255,255,0.3);
            font-size: 12px;
            position: relative;
            z-index: 1;
        }

        /* ── RIGHT PANEL ── */
        .right-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px;
            background: var(--cream);
        }

        .form-box {
            width: 100%;
            max-width: 400px;
        }

        .form-header {
            margin-bottom: 36px;
        }

        .form-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 30px;
            font-weight: 700;
            color: var(--deep);
            margin-bottom: 8px;
        }

        .form-header p {
            color: var(--muted);
            font-size: 14px;
        }

        /* ── ALERTS ── */
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ── FORM ELEMENTS ── */
        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            color: var(--deep);
            text-transform: uppercase;
            letter-spacing: 0.6px;
            margin-bottom: 8px;
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap input {
            width: 100%;
            padding: 12px 44px 12px 16px;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--deep);
            background: #fff;
            transition: all 0.2s;
            outline: none;
        }

        .input-wrap input:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(10,126,110,0.1);
        }

        .input-wrap .input-icon {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 15px;
            pointer-events: none;
        }

        /* ── SUBMIT ── */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: var(--teal);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            margin-top: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-login:hover {
            background: var(--teal-light);
            box-shadow: 0 6px 18px rgba(10,126,110,0.35);
            transform: translateY(-1px);
        }

        /* ── DIVIDER ── */
        .divider {
            display: flex;
            align-items: center;
            gap: 12px;
            margin: 24px 0;
            color: var(--muted);
            font-size: 12px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--border);
        }

        /* ── LINKS ── */
        .form-links {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin-top: 20px;
        }

        .form-links a {
            color: var(--teal);
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }

        .form-links a:hover { color: var(--teal-light); }

        .register-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            width: 100%;
            padding: 13px;
            border: 1.5px solid var(--border);
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            color: var(--deep) !important;
            text-decoration: none;
            transition: all 0.2s;
            background: #fff;
        }

        .register-link:hover {
            border-color: var(--teal);
            color: var(--teal) !important;
            box-shadow: 0 4px 12px rgba(10,126,110,0.1);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            body { grid-template-columns: 1fr; }
            .left-panel { display: none; }
            .right-panel { padding: 32px 24px; }
        }
    </style>
</head>
<body>

<!-- LEFT PANEL -->
<div class="left-panel">
    <div class="panel-logo">
        <div class="logo-icon">🏥</div>
        <span class="logo-text">MediCare</span>
    </div>

    <div class="panel-content">
        <div class="panel-tag">✦ Hospital Management System</div>
        <h1 class="panel-title">
            Your Health,<br>
            Our <span>Priority</span>
        </h1>
        <p class="panel-desc">
            Access your appointments, connect with specialist doctors, and manage your healthcare journey — all in one place.
        </p>

        <div class="panel-features">
            <div class="feature-item">
                <div class="feature-dot">🩺</div>
                Book appointments with specialist doctors
            </div>
            <div class="feature-item">
                <div class="feature-dot">📋</div>
                Track your appointment history
            </div>
            <div class="feature-item">
                <div class="feature-dot">🔒</div>
                Secure & private patient records
            </div>
            <div class="feature-item">
                <div class="feature-dot">⚡</div>
                Real-time slot availability
            </div>
        </div>
    </div>

    <div class="panel-footer">
        © {{ date('Y') }} MediCare Hospital System. All rights reserved.
    </div>
</div>

<!-- RIGHT PANEL -->
<div class="right-panel">
    <div class="form-box">

        <div class="form-header">
            <h2>Welcome back</h2>
            <p>Sign in to your account to continue</p>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                ⚠️ {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <div class="input-wrap">
                    <input type="email" name="email"
                           placeholder="you@example.com"
                           value="{{ old('email') }}"
                           required autofocus>
                    <span class="input-icon">✉️</span>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrap">
                    <input type="password" name="password"
                           placeholder="Enter your password"
                           required>
                    <span class="input-icon">🔒</span>
                </div>
            </div>

            <button type="submit" class="btn-login">
                Sign In →
            </button>
        </form>

        <div class="divider">or</div>

        <div class="form-links">
            <a href="{{ route('register') }}" class="register-link">
                👤 Create a Patient Account
            </a>
            <a href="{{ route('password.request') }}">Forgot your password?</a>
        </div>

    </div>
</div>

</body>
</html>