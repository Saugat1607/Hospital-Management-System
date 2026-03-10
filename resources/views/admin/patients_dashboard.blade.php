@extends('layouts.app')

@section('content')
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

    * { box-sizing: border-box; margin: 0; padding: 0; }
    body { background: var(--cream); font-family: 'DM Sans', sans-serif; color: var(--deep); min-height: 100vh; }

    /* HEADER */
    .dash-header {
        background: var(--deep); padding: 0 40px;
        display: flex; align-items: center; justify-content: space-between;
        height: 68px; position: sticky; top: 0; z-index: 100;
        box-shadow: 0 2px 20px rgba(0,0,0,0.25);
    }
    .dash-logo { display: flex; align-items: center; gap: 12px; }
    .dash-logo-icon {
        width: 38px; height: 38px; background: var(--teal);
        border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 18px;
    }
    .dash-logo-text { font-family: 'Playfair Display', serif; color: #fff; font-size: 18px; font-weight: 700; }
    .dash-right { display: flex; align-items: center; gap: 16px; }
    .admin-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(10,126,110,0.2); border: 1px solid rgba(10,126,110,0.4);
        color: var(--teal-light); font-size: 12px; font-weight: 600;
        padding: 4px 12px; border-radius: 20px;
    }
    .back-btn { color: rgba(255,255,255,0.6); font-size: 13px; text-decoration: none; transition: color 0.2s; }
    .back-btn:hover { color: #fff; }
    .btn-logout {
        background: transparent; border: 1px solid rgba(255,255,255,0.2);
        color: #fff; padding: 8px 20px; border-radius: 8px;
        font-family: 'DM Sans', sans-serif; font-size: 13px; cursor: pointer; transition: all 0.2s;
    }
    .btn-logout:hover { background: rgba(255,255,255,0.1); }

    /* HERO */
    .hero {
        background: linear-gradient(135deg, var(--teal) 0%, #065a4e 100%);
        padding: 40px; position: relative; overflow: hidden;
    }
    .hero::before {
        content: ''; position: absolute; top: -60px; right: -60px;
        width: 280px; height: 280px; background: rgba(255,255,255,0.04); border-radius: 50%;
    }
    .hero-content {
        max-width: 1200px; margin: 0 auto;
        position: relative; z-index: 1;
        display: flex; justify-content: space-between; align-items: center;
    }
    .hero-tag {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2);
        color: rgba(255,255,255,0.9); font-size: 11px; font-weight: 500;
        letter-spacing: 1.5px; text-transform: uppercase;
        padding: 4px 14px; border-radius: 20px; margin-bottom: 12px;
    }
    .hero h1 { font-family: 'Playfair Display', serif; font-size: 30px; color: #fff; font-weight: 700; margin-bottom: 6px; }
    .hero p { color: rgba(255,255,255,0.7); font-size: 14px; }
    .hero-count {
        background: rgba(255,255,255,0.12); border: 1px solid rgba(255,255,255,0.2);
        border-radius: 16px; padding: 20px 32px; text-align: center; color: #fff;
    }
    .hero-count strong { font-family: 'Playfair Display', serif; font-size: 40px; font-weight: 700; display: block; line-height: 1; }
    .hero-count span { font-size: 13px; opacity: 0.7; }

    /* SEARCH BAR */
    .search-wrap {
        max-width: 1200px; margin: 0 auto;
        padding: 28px 40px 0;
    }
    .search-box {
        position: relative; max-width: 400px;
    }
    .search-box input {
        width: 100%; padding: 11px 16px 11px 42px;
        border: 1.5px solid var(--border); border-radius: 12px;
        font-family: 'DM Sans', sans-serif; font-size: 14px;
        background: #fff; color: var(--deep); outline: none; transition: all 0.2s;
    }
    .search-box input:focus { border-color: var(--teal); box-shadow: 0 0 0 3px rgba(10,126,110,0.1); }
    .search-icon { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); font-size: 15px; pointer-events: none; }

    /* MAIN */
    .main-wrap { max-width: 1200px; margin: 24px auto 60px; padding: 0 40px; }

    .section-title {
        font-family: 'Playfair Display', serif; font-size: 20px; font-weight: 700;
        color: var(--deep); margin-bottom: 20px;
        display: flex; align-items: center; gap: 10px;
    }
    .section-title::after { content: ''; flex: 1; height: 1px; background: var(--border); margin-left: 8px; }

    /* PATIENTS GRID */
    .patients-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
    }

    .patient-card {
        background: #fff; border-radius: 20px;
        border: 1px solid var(--border); overflow: hidden;
        transition: all 0.3s; animation: fadeUp 0.4s ease both;
    }
    .patient-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 36px rgba(0,0,0,0.09);
        border-color: var(--teal);
    }
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .patient-card:nth-child(1) { animation-delay: 0.04s; }
    .patient-card:nth-child(2) { animation-delay: 0.08s; }
    .patient-card:nth-child(3) { animation-delay: 0.12s; }
    .patient-card:nth-child(4) { animation-delay: 0.16s; }
    .patient-card:nth-child(5) { animation-delay: 0.20s; }
    .patient-card:nth-child(6) { animation-delay: 0.24s; }

    .card-top {
        background: linear-gradient(135deg, #f0faf8 0%, #e6f7f5 100%);
        padding: 24px 20px 18px;
        display: flex; align-items: center; gap: 16px;
        border-bottom: 1px solid var(--border);
    }
    .patient-avatar {
        width: 56px; height: 56px; border-radius: 16px;
        background: var(--deep); color: #fff;
        display: flex; align-items: center; justify-content: center;
        font-family: 'Playfair Display', serif;
        font-size: 22px; font-weight: 700; flex-shrink: 0;
        box-shadow: 0 6px 16px rgba(13,27,42,0.2);
    }
    .patient-info h3 { font-family: 'Playfair Display', serif; font-size: 16px; font-weight: 700; color: var(--deep); margin-bottom: 4px; }
    .patient-email { font-size: 12px; color: var(--muted); margin-bottom: 8px; }
    .patient-badge {
        display: inline-flex; align-items: center; gap: 4px;
        background: rgba(13,27,42,0.07); color: var(--deep);
        font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px;
    }

    .card-bottom {
        padding: 14px 20px;
        display: flex; align-items: center; justify-content: space-between;
    }
    .joined-wrap {}
    .joined-label { font-size: 10px; color: var(--muted); text-transform: uppercase; letter-spacing: 0.8px; font-weight: 600; margin-bottom: 3px; }
    .joined-date { font-size: 13px; font-weight: 600; color: var(--deep); }

    .appt-count-badge {
        display: inline-flex; align-items: center; gap: 5px;
        background: var(--teal-pale); color: var(--teal);
        font-size: 12px; font-weight: 600;
        padding: 6px 14px; border-radius: 10px;
    }

    /* EMPTY */
    .empty-state { text-align: center; padding: 60px 20px; color: var(--muted); grid-column: 1/-1; }
    .empty-state .ei { font-size: 48px; margin-bottom: 12px; }

    @media (max-width: 768px) {
        .dash-header { padding: 0 20px; }
        .hero { padding: 28px 20px; }
        .hero-content { flex-direction: column; align-items: flex-start; gap: 16px; }
        .search-wrap, .main-wrap { padding: 20px; }
        .patients-grid { grid-template-columns: 1fr; }
    }
</style>

<!-- HEADER -->
<header class="dash-header">
    <div class="dash-logo">
        <div class="dash-logo-icon">🏥</div>
        <span class="dash-logo-text">MediCare</span>
    </div>
    <div class="dash-right">
        <a href="{{ route('admin.dashboard') }}" class="back-btn">← Dashboard</a>
        <span class="admin-badge">⚙️ Admin</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</header>

<!-- HERO -->
<div class="hero">
    <div class="hero-content">
        <div>
            <div class="hero-tag">🧑‍⚕️ Registered Users</div>
            <h1>Patients Directory</h1>
            <p>All registered patients in the hospital system</p>
        </div>
        <div class="hero-count">
            <strong>{{ $patients->count() }}</strong>
            <span>Total Patients</span>
        </div>
    </div>
</div>

<!-- SEARCH -->
<div class="search-wrap">
    <div class="search-box">
        <span class="search-icon">🔍</span>
        <input type="text" id="searchInput" placeholder="Search patients by name or email..." oninput="searchPatients()">
    </div>
</div>

<!-- MAIN -->
<div class="main-wrap">
    <div class="section-title">All Patients</div>

    <div class="patients-grid" id="patientsGrid">
        @forelse($patients as $patient)
        <div class="patient-card" data-name="{{ strtolower($patient->name) }}" data-email="{{ strtolower($patient->email) }}">
            <div class="card-top">
                <div class="patient-avatar">
                    {{ strtoupper(substr($patient->name, 0, 1)) }}
                </div>
                <div class="patient-info">
                    <h3>{{ $patient->name }}</h3>
                    <div class="patient-email">{{ $patient->email }}</div>
                    <span class="patient-badge">🧑‍⚕️ Patient</span>
                </div>
            </div>
            <div class="card-bottom">
                <div class="joined-wrap">
                    <div class="joined-label">Joined</div>
                    <div class="joined-date">
                        {{ \Carbon\Carbon::parse($patient->created_at)->format('d M Y') }}
                    </div>
                </div>
                <span class="appt-count-badge">
                    📋 {{ $patient->appointments()->count() }} appts
                </span>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="ei">🧑‍⚕️</div>
            <p>No patients registered yet.</p>
        </div>
        @endforelse
    </div>
</div>

<script>
function searchPatients() {
    const query = document.getElementById('searchInput').value.toLowerCase();
    const cards = document.querySelectorAll('.patient-card');
    let visible = 0;

    cards.forEach(card => {
        const name  = card.dataset.name;
        const email = card.dataset.email;
        const match = name.includes(query) || email.includes(query);
        card.style.display = match ? '' : 'none';
        if (match) visible++;
    });

    const grid = document.getElementById('patientsGrid');
    let empty = grid.querySelector('.empty-state');
    if (visible === 0) {
        if (!empty) {
            empty = document.createElement('div');
            empty.className = 'empty-state';
            empty.innerHTML = '<div class="ei">🔍</div><p>No patients match your search.</p>';
            grid.appendChild(empty);
        }
        empty.style.display = '';
    } else if (empty) {
        empty.style.display = 'none';
    }
}
</script>

@endsection