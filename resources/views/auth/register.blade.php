<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>MediCare — Register</title>
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

        .panel-content { position: relative; z-index: 1; }

        .panel-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            color: rgba(255,255,255,0.8);
            font-size: 11px; font-weight: 500;
            letter-spacing: 1.5px; text-transform: uppercase;
            padding: 5px 14px; border-radius: 20px;
            margin-bottom: 20px;
        }

        .panel-title {
            font-family: 'Playfair Display', serif;
            font-size: 40px; font-weight: 700;
            color: #fff; line-height: 1.15;
            margin-bottom: 16px;
        }

        .panel-title span { color: var(--teal-light); }

        .panel-desc {
            color: rgba(255,255,255,0.55);
            font-size: 15px; line-height: 1.7;
            max-width: 340px;
        }

        .steps {
            display: flex; flex-direction: column;
            gap: 16px; margin-top: 40px;
        }

        .step-item {
            display: flex; align-items: center; gap: 14px;
        }

        .step-num {
            width: 32px; height: 32px;
            background: rgba(10,126,110,0.25);
            border: 1px solid rgba(10,126,110,0.5);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 700;
            color: var(--teal-light); flex-shrink: 0;
        }

        .step-text { color: rgba(255,255,255,0.65); font-size: 14px; }

        .panel-footer {
            color: rgba(255,255,255,0.3);
            font-size: 12px; position: relative; z-index: 1;
        }

        /* ── RIGHT PANEL ── */
        .right-panel {
            display: flex; align-items: center;
            justify-content: center;
            padding: 48px; background: var(--cream);
            overflow-y: auto;
        }

        .form-box { width: 100%; max-width: 400px; }

        .form-header { margin-bottom: 28px; }

        .form-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 28px; font-weight: 700;
            color: var(--deep); margin-bottom: 6px;
        }

        .form-header p { color: var(--muted); font-size: 14px; }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
            padding: 12px 16px; border-radius: 10px;
            font-size: 13px; margin-bottom: 20px;
        }

        .alert-error ul { padding-left: 16px; }
        .alert-error ul li { margin-bottom: 4px; }

        .form-group { margin-bottom: 16px; }

        .form-label {
            display: block; font-size: 12px; font-weight: 600;
            color: var(--deep); text-transform: uppercase;
            letter-spacing: 0.6px; margin-bottom: 7px;
        }

        .input-wrap { position: relative; }

        .input-wrap input {
            width: 100%; padding: 12px 44px 12px 16px;
            border: 1.5px solid var(--border); border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; color: var(--deep);
            background: #fff; transition: all 0.2s; outline: none;
        }

        .input-wrap input:focus {
            border-color: var(--teal);
            box-shadow: 0 0 0 3px rgba(10,126,110,0.1);
        }

        .input-wrap .icon {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%);
            font-size: 15px; pointer-events: none;
        }

        .patient-badge {
            display: flex; align-items: center; gap: 10px;
            background: var(--teal-pale);
            border: 1.5px solid rgba(10,126,110,0.2);
            border-radius: 12px; padding: 12px 16px;
            margin-bottom: 20px; margin-top: 4px;
        }

        .badge-icon {
            width: 36px; height: 36px; background: var(--teal);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 16px; flex-shrink: 0;
        }

        .badge-text { font-size: 13px; color: var(--deep); }
        .badge-text strong { color: var(--teal); font-weight: 700; }
        .badge-text small { display: block; color: var(--muted); font-size: 11px; margin-top: 2px; }

        .btn-register {
            width: 100%; padding: 14px;
            background: var(--teal); color: #fff;
            border: none; border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 15px; font-weight: 700;
            cursor: pointer; transition: all 0.2s;
            display: flex; align-items: center;
            justify-content: center; gap: 8px;
        }

        .btn-register:hover {
            background: var(--teal-light);
            box-shadow: 0 6px 18px rgba(10,126,110,0.35);
            transform: translateY(-1px);
        }

        .divider {
            display: flex; align-items: center;
            gap: 12px; margin: 20px 0;
            color: var(--muted); font-size: 12px;
        }

        .divider::before, .divider::after {
            content: ''; flex: 1;
            height: 1px; background: var(--border);
        }

        .login-link {
            display: flex; align-items: center;
            justify-content: center; gap: 6px;
            width: 100%; padding: 13px;
            border: 1.5px solid var(--border); border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 500;
            color: var(--deep); text-decoration: none;
            background: #fff; transition: all 0.2s;
        }

        .login-link:hover {
            border-color: var(--teal); color: var(--teal);
            box-shadow: 0 4px 12px rgba(10,126,110,0.1);
        }

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
        <div class="panel-tag">✦ Patient Registration</div>
        <h1 class="panel-title">
            Join <span>MediCare</span><br>Today
        </h1>
        <p class="panel-desc">
            Create your free patient account and get instant access to our network of specialist doctors.
        </p>

        <div class="steps">
            <div class="step-item">
                <div class="step-num">1</div>
                <span class="step-text">Create your account with email & password</span>
            </div>
            <div class="step-item">
                <div class="step-num">2</div>
                <span class="step-text">Browse doctors by specialization</span>
            </div>
            <div class="step-item">
                <div class="step-num">3</div>
                <span class="step-text">Book your appointment in seconds</span>
            </div>
            <div class="step-item">
                <div class="step-num">4</div>
                <span class="step-text">Track & manage all your appointments</span>
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
            <h2>Create Account</h2>
            <p>Fill in your details to get started</p>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                ⚠️
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">Full Name</label>
                <div class="input-wrap">
                    <input type="text" name="name" placeholder="John Smith"
                           value="{{ old('name') }}" required autofocus>
                    <span class="icon">👤</span>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Email Address</label>
                <div class="input-wrap">
                    <input type="email" name="email" placeholder="you@example.com"
                           value="{{ old('email') }}" required>
                    <span class="icon">✉️</span>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-wrap">
                    <input type="password" name="password"
                           placeholder="Min. 8 characters" required>
                    <span class="icon">🔒</span>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <div class="input-wrap">
                    <input type="password" name="password_confirmation"
                           placeholder="Repeat your password" required>
                    <span class="icon">🔒</span>
                </div>
            </div>

            <div class="patient-badge">
                <div class="badge-icon">🧑‍⚕️</div>
                <div class="badge-text">
                    Registering as <strong>Patient</strong>
                    <small>Doctors & admins are managed internally</small>
                </div>
            </div>

            <button type="submit" class="btn-register">
                Create My Account →
            </button>
        </form>

        <div class="divider">already have an account?</div>

        <a href="{{ route('login') }}" class="login-link">
            🔑 Sign In Instead
        </a>

    </div>
</div>

</body>
</html>