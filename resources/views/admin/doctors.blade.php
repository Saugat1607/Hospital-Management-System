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

    body {
        background: var(--cream);
        font-family: 'DM Sans', sans-serif;
        color: var(--deep);
        min-height: 100vh;
    }

    /* ── HEADER ── */
    .dash-header {
        background: var(--deep);
        padding: 0 40px;
        display: flex; align-items: center; justify-content: space-between;
        height: 68px; position: sticky; top: 0; z-index: 100;
        box-shadow: 0 2px 20px rgba(0,0,0,0.25);
    }
    .dash-logo { display: flex; align-items: center; gap: 12px; }
    .dash-logo-icon {
        width: 38px; height: 38px; background: var(--teal);
        border-radius: 10px; display: flex; align-items: center;
        justify-content: center; font-size: 18px;
    }
    .dash-logo-text {
        font-family: 'Playfair Display', serif;
        color: #fff; font-size: 18px; font-weight: 700;
    }
    .dash-right { display: flex; align-items: center; gap: 16px; }
    .admin-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(10,126,110,0.2);
        border: 1px solid rgba(10,126,110,0.4);
        color: var(--teal-light);
        font-size: 12px; font-weight: 600;
        padding: 4px 12px; border-radius: 20px;
    }
    .back-btn {
        color: rgba(255,255,255,0.6); font-size: 13px;
        text-decoration: none; transition: color 0.2s;
    }
    .back-btn:hover { color: #fff; }
    .btn-logout {
        background: transparent;
        border: 1px solid rgba(255,255,255,0.2);
        color: #fff; padding: 8px 20px; border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px; cursor: pointer; transition: all 0.2s;
    }
    .btn-logout:hover { background: rgba(255,255,255,0.1); }

    /* ── HERO ── */
    .hero {
        background: linear-gradient(135deg, var(--teal) 0%, #065a4e 100%);
        padding: 40px 40px;
        position: relative; overflow: hidden;
    }
    .hero::before {
        content: ''; position: absolute;
        top: -60px; right: -60px;
        width: 280px; height: 280px;
        background: rgba(255,255,255,0.04); border-radius: 50%;
    }
    .hero-content {
        max-width: 1200px; margin: 0 auto;
        position: relative; z-index: 1;
        display: flex; justify-content: space-between; align-items: center;
    }
    .hero-tag {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
        color: rgba(255,255,255,0.9);
        font-size: 11px; font-weight: 500;
        letter-spacing: 1.5px; text-transform: uppercase;
        padding: 4px 14px; border-radius: 20px; margin-bottom: 12px;
    }
    .hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 30px; color: #fff; font-weight: 700; margin-bottom: 6px;
    }
    .hero p { color: rgba(255,255,255,0.7); font-size: 14px; }
    .hero-count {
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
        border-radius: 16px; padding: 20px 32px;
        text-align: center; color: #fff;
    }
    .hero-count strong {
        font-family: 'Playfair Display', serif;
        font-size: 40px; font-weight: 700;
        display: block; line-height: 1;
    }
    .hero-count span { font-size: 13px; opacity: 0.7; }

    /* ── FILTER PILLS ── */
    .filter-wrap {
        max-width: 1200px; margin: 0 auto;
        padding: 28px 40px 0;
        display: flex; flex-wrap: wrap; gap: 10px;
        align-items: center;
    }
    .filter-label {
        font-size: 12px; font-weight: 600;
        color: var(--muted); text-transform: uppercase;
        letter-spacing: 0.8px; margin-right: 4px;
    }
    .filter-pill {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 18px; border-radius: 50px;
        border: 1.5px solid var(--border);
        background: #fff; color: var(--muted);
        font-size: 13px; font-weight: 500;
        cursor: pointer; transition: all 0.2s; user-select: none;
    }
    .filter-pill:hover {
        border-color: var(--teal); color: var(--teal);
        transform: translateY(-1px);
    }
    .filter-pill.active {
        background: var(--teal); border-color: var(--teal);
        color: #fff; box-shadow: 0 4px 12px rgba(10,126,110,0.25);
    }
    .pill-count {
        background: rgba(0,0,0,0.08);
        border-radius: 10px; padding: 1px 7px;
        font-size: 11px; font-weight: 600;
    }
    .filter-pill.active .pill-count { background: rgba(255,255,255,0.25); }

    /* ── GRID ── */
    .main-wrap {
        max-width: 1200px; margin: 24px auto 60px;
        padding: 0 40px;
    }
    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 20px; font-weight: 700;
        color: var(--deep); margin-bottom: 20px;
        display: flex; align-items: center; gap: 10px;
    }
    .section-title::after {
        content: ''; flex: 1; height: 1px;
        background: var(--border); margin-left: 8px;
    }

    .doctors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }

    /* ── DOCTOR CARD ── */
    .doctor-card {
        background: #fff; border-radius: 20px;
        border: 1px solid var(--border); overflow: hidden;
        transition: all 0.3s; animation: fadeUp 0.4s ease both;
    }
    .doctor-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 36px rgba(0,0,0,0.09);
        border-color: var(--teal);
    }
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .doctor-card:nth-child(1) { animation-delay: 0.04s; }
    .doctor-card:nth-child(2) { animation-delay: 0.08s; }
    .doctor-card:nth-child(3) { animation-delay: 0.12s; }
    .doctor-card:nth-child(4) { animation-delay: 0.16s; }
    .doctor-card:nth-child(5) { animation-delay: 0.20s; }
    .doctor-card:nth-child(6) { animation-delay: 0.24s; }
    .doctor-card:nth-child(7) { animation-delay: 0.28s; }
    .doctor-card:nth-child(8) { animation-delay: 0.32s; }
    .doctor-card:nth-child(9) { animation-delay: 0.36s; }
    .doctor-card:nth-child(10) { animation-delay: 0.40s; }

    .card-top {
        background: linear-gradient(135deg, #f0faf8 0%, #e6f7f5 100%);
        padding: 24px 20px 18px;
        display: flex; align-items: center; gap: 16px;
        border-bottom: 1px solid var(--border);
    }
    .doc-avatar {
        width: 60px; height: 60px; border-radius: 16px;
        background: var(--teal); color: #fff;
        display: flex; align-items: center; justify-content: center;
        font-family: 'Playfair Display', serif;
        font-size: 24px; font-weight: 700; flex-shrink: 0;
        box-shadow: 0 6px 16px rgba(10,126,110,0.3);
    }
    .doc-info h3 {
        font-family: 'Playfair Display', serif;
        font-size: 16px; font-weight: 700;
        color: var(--deep); margin-bottom: 4px;
    }
    .doc-email { font-size: 12px; color: var(--muted); margin-bottom: 8px; }
    .doc-cat-badge {
        display: inline-flex; align-items: center; gap: 4px;
        background: rgba(10,126,110,0.1); color: var(--teal);
        font-size: 11px; font-weight: 600;
        padding: 3px 10px; border-radius: 20px;
    }

    .card-bottom {
        padding: 16px 20px;
        display: flex; align-items: center; justify-content: space-between;
    }
    .avail-wrap {}
    .avail-label {
        font-size: 10px; color: var(--muted);
        text-transform: uppercase; letter-spacing: 0.8px;
        font-weight: 600; margin-bottom: 3px;
    }
    .avail-time { font-size: 13px; font-weight: 600; color: var(--deep); }

    .btn-view {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--teal); color: #fff;
        padding: 9px 18px; border-radius: 10px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px; font-weight: 600;
        text-decoration: none; transition: all 0.2s;
    }
    .btn-view:hover {
        background: var(--teal-light);
        box-shadow: 0 4px 14px rgba(10,126,110,0.35);
    }

    /* ── CATEGORY ICONS ── */
    .cat-icon { font-size: 13px; }

    /* ── EMPTY STATE ── */
    .empty-state {
        text-align: center; padding: 60px 20px;
        color: var(--muted); grid-column: 1/-1;
    }
    .empty-state .ei { font-size: 48px; margin-bottom: 12px; }

    @media (max-width: 768px) {
        .dash-header { padding: 0 20px; }
        .hero { padding: 28px 20px; }
        .hero-content { flex-direction: column; align-items: flex-start; gap: 16px; }
        .filter-wrap { padding: 20px 20px 0; }
        .main-wrap { padding: 20px; }
        .doctors-grid { grid-template-columns: 1fr; }
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
            <div class="hero-tag">👨‍⚕️ Medical Staff</div>
            <h1>Doctors Directory</h1>
            <p>All registered doctors grouped by specialization</p>
        </div>
        <div class="hero-count">
            <strong>{{ $doctors->count() }}</strong>
            <span>Total Doctors</span>
        </div>
    </div>
</div>

<!-- CATEGORY FILTERS -->
<div class="filter-wrap">
    <span class="filter-label">Filter:</span>
    <div class="filter-pill active" data-cat="all" onclick="filterDoctors('all', this)">
        All
        <span class="pill-count">{{ $doctors->count() }}</span>
    </div>
    @foreach($doctors->groupBy('category.name') as $catName => $catDoctors)
    <div class="filter-pill" data-cat="{{ $catName }}" onclick="filterDoctors('{{ $catName }}', this)">
        @switch($catName)
            @case('Cardiology') ❤️ @break
            @case('Neurology') 🧠 @break
            @case('Orthopedics') 🦴 @break
            @case('Pediatrics') 👶 @break
            @case('Dermatology') 🌿 @break
            @default 🩺
        @endswitch
        {{ $catName }}
        <span class="pill-count">{{ $catDoctors->count() }}</span>
    </div>
    @endforeach
</div>

<!-- DOCTORS GRID -->
<div class="main-wrap">
    <div class="section-title">All Doctors</div>
    <div class="doctors-grid" id="doctorsGrid">
        @forelse($doctors as $doctor)
        <div class="doctor-card" data-cat="{{ $doctor->category->name ?? 'General' }}">
            <div class="card-top">
                <div class="doc-avatar">
                    {{ strtoupper(substr($doctor->name, 4, 1)) }}
                </div>
                <div class="doc-info">
                    <h3>{{ $doctor->name }}</h3>
                    <div class="doc-email">{{ $doctor->email }}</div>
                    <span class="doc-cat-badge">
                        <span class="cat-icon">
                            @switch($doctor->category->name ?? '')
                                @case('Cardiology') ❤️ @break
                                @case('Neurology') 🧠 @break
                                @case('Orthopedics') 🦴 @break
                                @case('Pediatrics') 👶 @break
                                @case('Dermatology') 🌿 @break
                                @default 🩺
                            @endswitch
                        </span>
                        {{ $doctor->category->name ?? 'General' }}
                    </span>
                </div>
            </div>
            <div class="card-bottom">
                <div class="avail-wrap">
                    <div class="avail-label">Available</div>
                    <div class="avail-time">9:00 AM – 5:00 PM</div>
                </div>
                <a href="{{ route('admin.doctor.appointments', $doctor->id) }}" class="btn-view">
                    Appointments →
                </a>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="ei">👨‍⚕️</div>
            <p>No doctors found.</p>
        </div>
        @endforelse
    </div>
</div>

<script>
function filterDoctors(cat, el) {
    document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
    el.classList.add('active');

    const cards = document.querySelectorAll('.doctor-card');
    let visible = 0;
    cards.forEach(card => {
        const match = cat === 'all' || card.dataset.cat === cat;
        card.style.display = match ? '' : 'none';
        if (match) visible++;
    });

    const grid = document.getElementById('doctorsGrid');
    let empty = grid.querySelector('.empty-state');
    if (visible === 0) {
        if (!empty) {
            empty = document.createElement('div');
            empty.className = 'empty-state';
            empty.innerHTML = '<div class="ei">🔍</div><p>No doctors in this category.</p>';
            grid.appendChild(empty);
        }
        empty.style.display = '';
    } else if (empty) {
        empty.style.display = 'none';
    }
}
</script>

@endsection