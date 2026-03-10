<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MediCare — Hospital Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

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
            background: var(--deep);
            color: #fff;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* ── BACKGROUND ── */
        .bg-wrap {
            position: fixed; inset: 0; z-index: 0;
            background: linear-gradient(145deg, #0d1b2a 0%, #0d2d40 50%, #0a3d35 100%);
        }
        .bg-circle-1 {
            position: absolute; top: -150px; right: -150px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(10,126,110,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }
        .bg-circle-2 {
            position: absolute; bottom: -100px; left: -100px;
            width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(10,126,110,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }
        .bg-circle-3 {
            position: absolute; top: 40%; left: 40%;
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(10,126,110,0.06) 0%, transparent 70%);
            border-radius: 50%;
        }

        /* ── NAV ── */
        .nav {
            position: relative; z-index: 10;
            display: flex; align-items: center; justify-content: space-between;
            padding: 24px 60px;
        }
        .nav-logo { display: flex; align-items: center; gap: 12px; }
        .nav-logo-icon {
            width: 42px; height: 42px; background: var(--teal);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
        }
        .nav-logo-text {
            font-family: 'Playfair Display', serif;
            font-size: 22px; font-weight: 700; color: #fff;
        }
        .nav-links { display: flex; align-items: center; gap: 12px; }
        .btn-ghost {
            padding: 10px 24px; border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.85); font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 500;
            text-decoration: none; transition: all 0.2s;
        }
        .btn-ghost:hover { background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.4); }
        .btn-primary {
            padding: 10px 24px; border-radius: 10px;
            background: var(--teal); color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px; font-weight: 600;
            text-decoration: none; transition: all 0.2s;
            border: 1px solid transparent;
        }
        .btn-primary:hover { background: var(--teal-light); box-shadow: 0 4px 16px rgba(10,126,110,0.4); }

        /* ── HERO ── */
        .hero {
            position: relative; z-index: 10;
            max-width: 900px; margin: 0 auto;
            padding: 80px 60px 60px;
            text-align: center;
        }
        .hero-tag {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(10,126,110,0.15);
            border: 1px solid rgba(10,126,110,0.3);
            color: var(--teal-light);
            font-size: 12px; font-weight: 600;
            letter-spacing: 1.5px; text-transform: uppercase;
            padding: 6px 16px; border-radius: 20px;
            margin-bottom: 28px;
            animation: fadeDown 0.6s ease both;
        }
        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: 62px; font-weight: 800;
            line-height: 1.1; margin-bottom: 24px;
            animation: fadeDown 0.6s ease 0.1s both;
        }
        .hero-title span { color: var(--teal-light); }
        .hero-desc {
            color: rgba(255,255,255,0.55);
            font-size: 18px; line-height: 1.7;
            max-width: 580px; margin: 0 auto 40px;
            animation: fadeDown 0.6s ease 0.2s both;
        }
        .hero-btns {
            display: flex; align-items: center; justify-content: center;
            gap: 14px; margin-bottom: 64px;
            animation: fadeDown 0.6s ease 0.3s both;
        }
        .btn-hero-primary {
            padding: 15px 36px; border-radius: 12px;
            background: var(--teal); color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 16px; font-weight: 700;
            text-decoration: none; transition: all 0.2s;
            display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-hero-primary:hover {
            background: var(--teal-light);
            box-shadow: 0 8px 24px rgba(10,126,110,0.4);
            transform: translateY(-2px);
        }
        .btn-hero-ghost {
            padding: 15px 36px; border-radius: 12px;
            border: 1.5px solid rgba(255,255,255,0.2);
            color: rgba(255,255,255,0.85);
            font-family: 'DM Sans', sans-serif;
            font-size: 16px; font-weight: 600;
            text-decoration: none; transition: all 0.2s;
        }
        .btn-hero-ghost:hover {
            background: rgba(255,255,255,0.06);
            border-color: rgba(255,255,255,0.4);
            transform: translateY(-2px);
        }

        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-16px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ── STATS BAR ── */
        .stats-bar {
            position: relative; z-index: 10;
            max-width: 800px; margin: 0 auto;
            display: flex; justify-content: center; gap: 0;
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 20px; overflow: hidden;
            animation: fadeDown 0.6s ease 0.4s both;
        }
        .stat-item {
            flex: 1; padding: 28px 20px; text-align: center;
            border-right: 1px solid rgba(255,255,255,0.06);
        }
        .stat-item:last-child { border-right: none; }
        .stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 36px; font-weight: 700; color: #fff;
            margin-bottom: 6px;
        }
        .stat-num span { color: var(--teal-light); }
        .stat-lbl { font-size: 13px; color: rgba(255,255,255,0.45); font-weight: 500; }

        /* ── FEATURES ── */
        .features {
            position: relative; z-index: 10;
            max-width: 1100px; margin: 80px auto 0;
            padding: 0 60px 80px;
        }
        .features-title {
            text-align: center;
            font-family: 'Playfair Display', serif;
            font-size: 32px; font-weight: 700;
            margin-bottom: 48px; color: #fff;
        }
        .features-title span { color: var(--teal-light); }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .feature-card {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 20px; padding: 28px 24px;
            transition: all 0.3s;
        }
        .feature-card:hover {
            background: rgba(10,126,110,0.1);
            border-color: rgba(10,126,110,0.3);
            transform: translateY(-4px);
        }
        .feature-icon {
            width: 48px; height: 48px; border-radius: 14px;
            background: rgba(10,126,110,0.2);
            border: 1px solid rgba(10,126,110,0.3);
            display: flex; align-items: center; justify-content: center;
            font-size: 22px; margin-bottom: 18px;
        }
        .feature-title {
            font-family: 'Playfair Display', serif;
            font-size: 17px; font-weight: 700;
            color: #fff; margin-bottom: 10px;
        }
        .feature-desc { color: rgba(255,255,255,0.45); font-size: 14px; line-height: 1.6; }

        /* ── ROLES ── */
        .roles {
            position: relative; z-index: 10;
            max-width: 1100px; margin: 0 auto;
            padding: 0 60px 80px;
        }
        .roles-title {
            text-align: center;
            font-family: 'Playfair Display', serif;
            font-size: 32px; font-weight: 700;
            margin-bottom: 48px;
        }
        .roles-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .role-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 20px; padding: 32px 24px;
            text-align: center; transition: all 0.3s;
        }
        .role-card:hover {
            background: rgba(10,126,110,0.08);
            border-color: rgba(10,126,110,0.25);
            transform: translateY(-4px);
        }
        .role-emoji { font-size: 40px; margin-bottom: 16px; display: block; }
        .role-title { font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700; margin-bottom: 10px; }
        .role-desc { color: rgba(255,255,255,0.45); font-size: 14px; line-height: 1.6; }

        /* ── CTA ── */
        .cta {
            position: relative; z-index: 10;
            max-width: 700px; margin: 0 auto;
            padding: 0 60px 80px;
            text-align: center;
        }
        .cta-box {
            background: linear-gradient(135deg, rgba(10,126,110,0.2), rgba(10,126,110,0.05));
            border: 1px solid rgba(10,126,110,0.3);
            border-radius: 24px; padding: 48px 40px;
        }
        .cta h2 { font-family: 'Playfair Display', serif; font-size: 32px; font-weight: 700; margin-bottom: 14px; }
        .cta p { color: rgba(255,255,255,0.55); font-size: 16px; margin-bottom: 32px; line-height: 1.6; }

        /* ── FOOTER ── */
        .footer {
            position: relative; z-index: 10;
            border-top: 1px solid rgba(255,255,255,0.06);
            padding: 28px 60px;
            display: flex; align-items: center; justify-content: space-between;
        }
        .footer-logo { display: flex; align-items: center; gap: 10px; }
        .footer-logo-icon { width: 30px; height: 30px; background: var(--teal); border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 14px; }
        .footer-logo-text { font-family: 'Playfair Display', serif; font-size: 16px; color: rgba(255,255,255,0.7); }
        .footer-copy { color: rgba(255,255,255,0.3); font-size: 13px; }

        @media (max-width: 768px) {
            .nav { padding: 20px 24px; }
            .hero { padding: 60px 24px 40px; }
            .hero-title { font-size: 38px; }
            .hero-desc { font-size: 15px; }
            .hero-btns { flex-direction: column; }
            .stats-bar { flex-direction: column; margin: 0 24px; }
            .stat-item { border-right: none; border-bottom: 1px solid rgba(255,255,255,0.06); }
            .features, .roles, .cta { padding: 0 24px 60px; }
            .features-grid, .roles-grid { grid-template-columns: 1fr; }
            .footer { flex-direction: column; gap: 12px; padding: 24px; text-align: center; }
        }
    </style>
</head>
<body>

<!-- Background -->
<div class="bg-wrap">
    <div class="bg-circle-1"></div>
    <div class="bg-circle-2"></div>
    <div class="bg-circle-3"></div>
</div>

<!-- NAV -->
<nav class="nav">
    <div class="nav-logo">
        <div class="nav-logo-icon">🏥</div>
        <span class="nav-logo-text">MediCare</span>
    </div>
    <div class="nav-links">
        <a href="{{ route('login') }}" class="btn-ghost">Sign In</a>
        <a href="{{ route('register') }}" class="btn-primary">Get Started</a>
    </div>
</nav>

<!-- HERO -->
<div class="hero">
    <div class="hero-tag">✦ Hospital Management System</div>
    <h1 class="hero-title">
        Modern Healthcare,<br>
        <span>Simplified</span>
    </h1>
    <p class="hero-desc">
        A complete hospital management platform connecting patients, doctors, and administrators — all in one place.
    </p>
    <div class="hero-btns">
        <a href="{{ route('register') }}" class="btn-hero-primary">
            Get Started Free →
        </a>
        <a href="{{ route('login') }}" class="btn-hero-ghost">
            Sign In
        </a>
    </div>
</div>

<!-- STATS BAR -->
<div class="stats-bar" style="margin: 0 auto; padding: 0 60px; max-width: 900px;">
    <div class="stat-item">
        <div class="stat-num">10<span>+</span></div>
        <div class="stat-lbl">Specialist Doctors</div>
    </div>
    <div class="stat-item">
        <div class="stat-num">5<span>+</span></div>
        <div class="stat-lbl">Specializations</div>
    </div>
    <div class="stat-item">
        <div class="stat-num">24<span>/7</span></div>
        <div class="stat-lbl">Booking Available</div>
    </div>
    <div class="stat-item">
        <div class="stat-num">100<span>%</span></div>
        <div class="stat-lbl">Secure & Private</div>
    </div>
</div>

<!-- FEATURES -->
<div class="features">
    <h2 class="features-title">Everything You <span>Need</span></h2>
    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">📅</div>
            <div class="feature-title">Easy Appointment Booking</div>
            <div class="feature-desc">Browse available time slots and book appointments with your preferred specialist in seconds.</div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🩺</div>
            <div class="feature-title">Specialist Doctors</div>
            <div class="feature-desc">Access a network of qualified doctors across Cardiology, Neurology, Orthopedics, Pediatrics and more.</div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">📋</div>
            <div class="feature-title">Appointment Tracking</div>
            <div class="feature-desc">Track all your appointments in real time with live status updates — pending, completed or cancelled.</div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">⚡</div>
            <div class="feature-title">Real-time Availability</div>
            <div class="feature-desc">See live slot availability and avoid double bookings with our smart scheduling system.</div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🔒</div>
            <div class="feature-title">Secure & Private</div>
            <div class="feature-desc">Your health data is encrypted and protected. Role-based access ensures only the right people see your records.</div>
        </div>
        <div class="feature-card">
            <div class="feature-icon">⚙️</div>
            <div class="feature-title">Admin Control Panel</div>
            <div class="feature-desc">Full admin dashboard to manage doctors, patients, and appointments with detailed statistics.</div>
        </div>
    </div>
</div>

<!-- ROLES -->
<div class="roles">
    <h2 class="roles-title">Built for Everyone</h2>
    <div class="roles-grid">
        <div class="role-card">
            <span class="role-emoji">🧑‍⚕️</span>
            <div class="role-title">Patients</div>
            <div class="role-desc">Register, browse specialist doctors, book appointments and track your health history — all from one dashboard.</div>
        </div>
        <div class="role-card">
            <span class="role-emoji">👨‍⚕️</span>
            <div class="role-title">Doctors</div>
            <div class="role-desc">View your appointments, manage patient consultations and mark appointments as completed from your personal portal.</div>
        </div>
        <div class="role-card">
            <span class="role-emoji">⚙️</span>
            <div class="role-title">Administrators</div>
            <div class="role-desc">Oversee the entire hospital system — manage doctors, patients, appointments and view detailed statistics.</div>
        </div>
    </div>
</div>

<!-- CTA -->
<div class="cta">
    <div class="cta-box">
        <h2>Ready to Get Started?</h2>
        <p>Create your free patient account and book your first appointment in minutes.</p>
        <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap">
            <a href="{{ route('register') }}" class="btn-hero-primary">Create Account →</a>
            <a href="{{ route('login') }}" class="btn-hero-ghost">Sign In</a>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-logo">
        <div class="footer-logo-icon">🏥</div>
        <span class="footer-logo-text">MediCare</span>
    </div>
    <div class="footer-copy">© {{ date('Y') }} MediCare Hospital Management System. All rights reserved.</div>
</footer>

</body>
</html>