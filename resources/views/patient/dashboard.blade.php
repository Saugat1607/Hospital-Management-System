@extends('layouts.app')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    :root {
        --cream: #f7f3ee;
        --deep: #0d1b2a;
        --teal: #0a7e6e;
        --teal-light: #0fa88f;
        --gold: #c8952a;
        --muted: #6b7280;
        --card-bg: #ffffff;
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
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 68px;
        position: sticky;
        top: 0;
        z-index: 100;
        box-shadow: 0 2px 20px rgba(0,0,0,0.25);
    }

    .dash-logo {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .dash-logo-icon {
        width: 38px;
        height: 38px;
        background: var(--teal);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .dash-logo-text {
        font-family: 'Playfair Display', serif;
        color: #fff;
        font-size: 18px;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    .dash-user {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .dash-welcome {
        color: #9ca3af;
        font-size: 14px;
    }

    .dash-welcome strong {
        color: #fff;
        font-weight: 600;
    }

    .btn-logout {
        background: transparent;
        border: 1px solid rgba(255,255,255,0.2);
        color: #fff;
        padding: 8px 20px;
        border-radius: 8px;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-logout:hover {
        background: rgba(255,255,255,0.1);
        border-color: rgba(255,255,255,0.4);
    }

    /* ── HERO BANNER ── */
    .hero {
        background: linear-gradient(135deg, var(--teal) 0%, #065a4e 100%);
        padding: 48px 40px;
        position: relative;
        overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute;
        top: -60px; right: -60px;
        width: 300px; height: 300px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }

    .hero::after {
        content: '';
        position: absolute;
        bottom: -80px; left: 30%;
        width: 200px; height: 200px;
        background: rgba(255,255,255,0.03);
        border-radius: 50%;
    }

    .hero-content {
        max-width: 1200px;
        margin: 0 auto;
        position: relative;
        z-index: 1;
    }

    .hero-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
        color: rgba(255,255,255,0.9);
        font-size: 12px;
        font-weight: 500;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        padding: 5px 14px;
        border-radius: 20px;
        margin-bottom: 16px;
    }

    .hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 36px;
        color: #fff;
        font-weight: 700;
        line-height: 1.2;
        margin-bottom: 10px;
    }

    .hero p {
        color: rgba(255,255,255,0.7);
        font-size: 15px;
        max-width: 480px;
    }

    /* ── MAIN ── */
    .main-wrap {
        max-width: 1200px;
        margin: 0 auto;
        padding: 40px 40px 60px;
    }

    /* ── SECTION TITLE ── */
    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 22px;
        font-weight: 700;
        color: var(--deep);
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title::after {
        content: '';
        flex: 1;
        height: 1px;
        background: var(--border);
        margin-left: 8px;
    }

    /* ── CATEGORY PILLS ── */
    .categories-wrap {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 40px;
    }

    .cat-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 20px;
        border-radius: 50px;
        border: 2px solid var(--border);
        background: #fff;
        color: var(--muted);
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        user-select: none;
    }

    .cat-pill:hover {
        border-color: var(--teal);
        color: var(--teal);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(10,126,110,0.12);
    }

    .cat-pill.active {
        background: var(--teal);
        border-color: var(--teal);
        color: #fff;
        box-shadow: 0 4px 16px rgba(10,126,110,0.3);
        transform: translateY(-2px);
    }

    .cat-pill .cat-icon {
        font-size: 16px;
    }

    .cat-pill .cat-count {
        background: rgba(0,0,0,0.08);
        border-radius: 10px;
        padding: 1px 7px;
        font-size: 11px;
        font-weight: 600;
    }

    .cat-pill.active .cat-count {
        background: rgba(255,255,255,0.25);
    }

    /* ── DOCTORS GRID ── */
    .doctors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 24px;
        margin-bottom: 48px;
    }

    .doctor-card {
        background: var(--card-bg);
        border-radius: 20px;
        border: 1px solid var(--border);
        overflow: hidden;
        transition: all 0.3s ease;
        animation: fadeUp 0.4s ease both;
    }

    .doctor-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        border-color: var(--teal);
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .doctor-card:nth-child(1) { animation-delay: 0.05s; }
    .doctor-card:nth-child(2) { animation-delay: 0.10s; }
    .doctor-card:nth-child(3) { animation-delay: 0.15s; }
    .doctor-card:nth-child(4) { animation-delay: 0.20s; }
    .doctor-card:nth-child(5) { animation-delay: 0.25s; }
    .doctor-card:nth-child(6) { animation-delay: 0.30s; }

    .card-top {
        background: linear-gradient(135deg, #f0faf8 0%, #e6f7f5 100%);
        padding: 28px 24px 20px;
        display: flex;
        align-items: center;
        gap: 18px;
        border-bottom: 1px solid var(--border);
    }

    .doctor-avatar {
        width: 68px;
        height: 68px;
        border-radius: 18px;
        background: var(--teal);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Playfair Display', serif;
        font-size: 26px;
        font-weight: 700;
        flex-shrink: 0;
        box-shadow: 0 8px 20px rgba(10,126,110,0.3);
    }

    .doctor-info h3 {
        font-family: 'Playfair Display', serif;
        font-size: 17px;
        font-weight: 700;
        color: var(--deep);
        margin-bottom: 4px;
    }

    .doctor-info .doc-email {
        font-size: 12px;
        color: var(--muted);
        margin-bottom: 8px;
    }

    .doc-category-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(10,126,110,0.1);
        color: var(--teal);
        font-size: 11px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 20px;
        letter-spacing: 0.3px;
    }

    .card-bottom {
        padding: 18px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .avail-info {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .avail-label {
        font-size: 11px;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 0.8px;
        font-weight: 500;
    }

    .avail-time {
        font-size: 13px;
        font-weight: 600;
        color: var(--deep);
    }

    .btn-book {
        background: var(--teal);
        color: #fff;
        border: none;
        padding: 11px 24px;
        border-radius: 12px;
        font-family: 'DM Sans', sans-serif;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s;
    }

    .btn-book:hover {
        background: var(--teal-light);
        transform: scale(1.04);
        box-shadow: 0 6px 18px rgba(10,126,110,0.35);
    }

    /* ── NO RESULTS ── */
    .no-doctors {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
        color: var(--muted);
    }

    .no-doctors .nd-icon { font-size: 48px; margin-bottom: 12px; }
    .no-doctors p { font-size: 15px; }

    /* ── APPOINTMENTS TABLE ── */
    .appt-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid var(--border);
        overflow: hidden;
    }

    .appt-card-header {
        padding: 20px 28px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .appt-card-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 18px;
        font-weight: 700;
    }

    .appt-count {
        background: var(--teal);
        color: #fff;
        font-size: 12px;
        font-weight: 600;
        padding: 3px 12px;
        border-radius: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead th {
        background: #f7f3ee;
        padding: 13px 24px;
        text-align: left;
        font-size: 11px;
        font-weight: 600;
        color: var(--muted);
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    tbody td {
        padding: 16px 24px;
        font-size: 14px;
        border-bottom: 1px solid #f3ede6;
        color: var(--deep);
    }

    tbody tr:last-child td { border-bottom: none; }

    tbody tr:hover td { background: #fafaf8; }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-pending  { background: #fef9c3; color: #854d0e; }
    .status-completed { background: #dcfce7; color: #166534; }
    .status-cancelled { background: #fee2e2; color: #991b1b; }

    .empty-row td {
        text-align: center;
        padding: 48px;
        color: var(--muted);
        font-size: 14px;
    }

    /* responsive */
    @media (max-width: 768px) {
        .dash-header { padding: 0 20px; }
        .hero { padding: 32px 20px; }
        .hero h1 { font-size: 26px; }
        .main-wrap { padding: 24px 20px 48px; }
        .doctors-grid { grid-template-columns: 1fr; }
    }
</style>

<!-- HEADER -->
<header class="dash-header">
    <div class="dash-logo">
        <div class="dash-logo-icon">🏥</div>
        <span class="dash-logo-text">MediCare</span>
    </div>
    <div class="dash-user">
        <span class="dash-welcome">Welcome, <strong>{{ auth()->user()->name }}</strong></span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</header>

<!-- HERO -->
<div class="hero">
    <div class="hero-content">
        <div class="hero-tag">✦ Patient Portal</div>
        <h1>Find & Book a Doctor</h1>
        <p>Browse specialists by category and book your appointment in seconds.</p>
    </div>
</div>

<!-- MAIN -->
<div class="main-wrap">

    <!-- CATEGORIES -->
    <div class="section-title">Browse by Specialization</div>
    <div class="categories-wrap">
        <div class="cat-pill active" data-category="all" onclick="filterDoctors('all', this)">
            <span class="cat-icon">🔍</span>
            All Doctors
            <span class="cat-count">{{ $doctors->count() }}</span>
        </div>
        @foreach($categories as $category)
        <div class="cat-pill" data-category="{{ $category->id }}" onclick="filterDoctors('{{ $category->id }}', this)">
            <span class="cat-icon">
                @switch($category->name)
                    @case('Cardiology') ❤️ @break
                    @case('Neurology') 🧠 @break
                    @case('Orthopedics') 🦴 @break
                    @case('Pediatrics') 👶 @break
                    @case('Dermatology') 🌿 @break
                    @default 🩺
                @endswitch
            </span>
            {{ $category->name }}
            <span class="cat-count">{{ $category->doctors->count() }}</span>
        </div>
        @endforeach
    </div>

    <!-- DOCTORS GRID -->
    <div class="section-title">Available Doctors</div>
    <div class="doctors-grid" id="doctorsGrid">
        @forelse($doctors as $doctor)
        <div class="doctor-card" data-category="{{ $doctor->category_id }}">
            <div class="card-top">
                <div class="doctor-avatar">{{ strtoupper(substr($doctor->name, 4, 1)) }}</div>
                <div class="doctor-info">
                    <h3>{{ $doctor->name }}</h3>
                    <div class="doc-email">{{ $doctor->email }}</div>
                    <span class="doc-category-badge">
                        🩺 {{ $doctor->category->name ?? 'General' }}
                    </span>
                </div>
            </div>
            <div class="card-bottom">
                <div class="avail-info">
                    <span class="avail-label">Available</span>
                    <span class="avail-time">9:00 AM – 5:00 PM</span>
                </div>
                <a href="{{ route('patient.doctor.book', $doctor->id) }}" class="btn-book">
                    Book Now →
                </a>
            </div>
        </div>
        @empty
        <div class="no-doctors">
            <div class="nd-icon">🩺</div>
            <p>No doctors available at the moment.</p>
        </div>
        @endforelse
    </div>

    <!-- APPOINTMENTS -->
    <div class="appt-card">
        <div class="appt-card-header">
            <h2>My Appointments</h2>
            <span class="appt-count">{{ $appointments->count() }} total</span>
        </div>
        <div style="overflow-x:auto">
            <table>
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Specialization</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Reason</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($appointments as $appointment)
                    <tr>
                        <td><strong>{{ $appointment->doctor->name }}</strong></td>
                        <td>{{ $appointment->doctor->category->name ?? '—' }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}</td>
                        <td>{{ $appointment->reason }}</td>
                        <td>
                            @php
                                $cls = match($appointment->status) {
                                    'completed' => 'status-completed',
                                    'cancelled' => 'status-cancelled',
                                    default     => 'status-pending',
                                };
                                $dot = match($appointment->status) {
                                    'completed' => '●',
                                    'cancelled' => '●',
                                    default     => '●',
                                };
                            @endphp
                            <span class="status-badge {{ $cls }}">
                                {{ $dot }} {{ ucfirst($appointment->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr class="empty-row">
                        <td colspan="6">No appointments yet. Book one above! 👆</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
function filterDoctors(categoryId, el) {
    // update active pill
    document.querySelectorAll('.cat-pill').forEach(p => p.classList.remove('active'));
    el.classList.add('active');

    // filter cards
    const cards = document.querySelectorAll('.doctor-card');
    let visible = 0;
    cards.forEach(card => {
        const match = categoryId === 'all' || card.dataset.category === categoryId;
        card.style.display = match ? '' : 'none';
        if (match) visible++;
    });

    // show empty state if none
    const grid = document.getElementById('doctorsGrid');
    let emptyEl = grid.querySelector('.no-doctors');
    if (visible === 0) {
        if (!emptyEl) {
            emptyEl = document.createElement('div');
            emptyEl.className = 'no-doctors';
            emptyEl.innerHTML = '<div class="nd-icon">🔍</div><p>No doctors in this category.</p>';
            grid.appendChild(emptyEl);
        }
        emptyEl.style.display = '';
    } else if (emptyEl) {
        emptyEl.style.display = 'none';
    }
}
</script>
@endsection
