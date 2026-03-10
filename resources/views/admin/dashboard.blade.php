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
        --gold: #c8952a;
        --muted: #6b7280;
        --border: #e5ded5;
        --red: #dc2626;
        --green: #16a34a;
        --blue: #1d4ed8;
        --purple: #7c3aed;
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

    .dash-logo { display: flex; align-items: center; gap: 12px; }

    .dash-logo-icon {
        width: 38px; height: 38px;
        background: var(--teal); border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 18px;
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

    .dash-welcome { color: #9ca3af; font-size: 14px; }
    .dash-welcome strong { color: #fff; font-weight: 600; }

    .btn-logout {
        background: transparent;
        border: 1px solid rgba(255,255,255,0.2);
        color: #fff; padding: 8px 20px;
        border-radius: 8px; font-family: 'DM Sans', sans-serif;
        font-size: 13px; cursor: pointer; transition: all 0.2s;
    }
    .btn-logout:hover { background: rgba(255,255,255,0.1); }

    /* ── HERO ── */
    .hero {
        background: linear-gradient(135deg, var(--deep) 0%, #0d2d40 60%, #0a3d35 100%);
        padding: 40px 40px 48px;
        position: relative; overflow: hidden;
    }

    .hero::before {
        content: '';
        position: absolute; top: -80px; right: -80px;
        width: 350px; height: 350px;
        background: rgba(10,126,110,0.1); border-radius: 50%;
    }

    .hero::after {
        content: '';
        position: absolute; bottom: -60px; left: 20%;
        width: 200px; height: 200px;
        background: rgba(10,126,110,0.06); border-radius: 50%;
    }

    .hero-content {
        max-width: 1200px; margin: 0 auto;
        position: relative; z-index: 1;
        display: flex; justify-content: space-between; align-items: flex-end;
    }

    .hero-left {}

    .hero-tag {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.15);
        color: rgba(255,255,255,0.8);
        font-size: 11px; font-weight: 500;
        letter-spacing: 1.5px; text-transform: uppercase;
        padding: 5px 14px; border-radius: 20px; margin-bottom: 14px;
    }

    .hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 34px; color: #fff; font-weight: 700;
        line-height: 1.2; margin-bottom: 8px;
    }

    .hero p { color: rgba(255,255,255,0.6); font-size: 14px; }

    .hero-date {
        text-align: right; color: rgba(255,255,255,0.5); font-size: 13px;
    }

    .hero-date strong { display: block; color: #fff; font-size: 18px; font-weight: 600; margin-bottom: 2px; }

    /* ── STATS CARDS ── */
    .stats-wrap {
        max-width: 1200px; margin: -28px auto 0;
        padding: 0 40px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        position: relative; z-index: 10;
    }

    .stat-card {
        background: #fff;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid var(--border);
        box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        text-decoration: none;
        color: inherit;
        transition: all 0.25s;
        display: block;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.1);
    }

    .stat-top {
        display: flex; align-items: center;
        justify-content: space-between; margin-bottom: 16px;
    }

    .stat-icon {
        width: 44px; height: 44px; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px;
    }

    .stat-icon.blue   { background: #eff6ff; }
    .stat-icon.teal   { background: var(--teal-pale); }
    .stat-icon.purple { background: #f5f3ff; }
    .stat-icon.gold   { background: #fffbeb; }

    .stat-trend {
        font-size: 11px; font-weight: 600; padding: 3px 8px;
        border-radius: 20px;
    }
    .trend-up   { background: #dcfce7; color: #166534; }
    .trend-warn { background: #fef9c3; color: #854d0e; }

    .stat-value {
        font-family: 'Playfair Display', serif;
        font-size: 36px; font-weight: 700;
        color: var(--deep); line-height: 1;
        margin-bottom: 6px;
    }

    .stat-label { font-size: 13px; color: var(--muted); font-weight: 500; }

    .stat-link {
        font-size: 12px; color: var(--teal);
        font-weight: 600; margin-top: 12px;
        display: block;
    }

    /* ── MAIN CONTENT ── */
    .main-wrap {
        max-width: 1200px; margin: 32px auto 60px;
        padding: 0 40px;
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 24px;
        align-items: start;
    }

    /* ── SECTION TITLE ── */
    .section-title {
        font-family: 'Playfair Display', serif;
        font-size: 18px; font-weight: 700;
        color: var(--deep); margin-bottom: 16px;
        display: flex; align-items: center; gap: 10px;
    }

    .section-title::after {
        content: ''; flex: 1; height: 1px;
        background: var(--border); margin-left: 8px;
    }

    /* ── TABLE CARD ── */
    .table-card {
        background: #fff; border-radius: 20px;
        border: 1px solid var(--border); overflow: hidden;
    }

    .table-card-header {
        padding: 20px 24px; border-bottom: 1px solid var(--border);
        display: flex; align-items: center; justify-content: space-between;
    }

    .table-card-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 17px; font-weight: 700;
    }

    .count-badge {
        background: var(--teal); color: #fff;
        font-size: 12px; font-weight: 600;
        padding: 3px 12px; border-radius: 20px;
    }

    table { width: 100%; border-collapse: collapse; }

    thead th {
        background: #f7f3ee; padding: 12px 20px;
        text-align: left; font-size: 11px;
        font-weight: 600; color: var(--muted);
        text-transform: uppercase; letter-spacing: 0.8px;
    }

    tbody td {
        padding: 14px 20px; font-size: 13px;
        border-bottom: 1px solid #f3ede6; color: var(--deep);
    }

    tbody tr:last-child td { border-bottom: none; }
    tbody tr:hover td { background: #fafaf8; }

    .patient-name { font-weight: 600; }

    .doctor-cell { display: flex; align-items: center; gap: 8px; }

    .doc-mini-avatar {
        width: 28px; height: 28px; border-radius: 8px;
        background: var(--teal); color: #fff;
        display: flex; align-items: center; justify-content: center;
        font-size: 11px; font-weight: 700; flex-shrink: 0;
    }

    .status-badge {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 3px 10px; border-radius: 20px;
        font-size: 11px; font-weight: 600;
    }

    .status-pending   { background: #fef9c3; color: #854d0e; }
    .status-completed { background: #dcfce7; color: #166534; }
    .status-cancelled { background: #fee2e2; color: #991b1b; }

    .empty-cell { text-align: center; padding: 48px !important; color: var(--muted); }

    /* ── SIDEBAR ── */
    .sidebar {}

    /* Quick Links */
    .quick-links {
        background: #fff; border-radius: 20px;
        border: 1px solid var(--border);
        overflow: hidden; margin-bottom: 24px;
    }

    .ql-header {
        padding: 18px 20px; border-bottom: 1px solid var(--border);
        font-family: 'Playfair Display', serif;
        font-size: 16px; font-weight: 700;
    }

    .ql-item {
        display: flex; align-items: center; gap: 12px;
        padding: 14px 20px; text-decoration: none;
        color: var(--deep); font-size: 14px; font-weight: 500;
        border-bottom: 1px solid #f3ede6;
        transition: all 0.2s;
    }

    .ql-item:last-child { border-bottom: none; }

    .ql-item:hover {
        background: var(--teal-pale); color: var(--teal);
        padding-left: 26px;
    }

    .ql-icon {
        width: 34px; height: 34px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 15px; flex-shrink: 0;
    }

    .ql-icon.teal   { background: var(--teal-pale); }
    .ql-icon.blue   { background: #eff6ff; }
    .ql-icon.purple { background: #f5f3ff; }
    .ql-icon.gold   { background: #fffbeb; }

    .ql-arrow { margin-left: auto; color: var(--muted); font-size: 12px; }

    /* Summary card */
    .summary-card {
        background: var(--deep); border-radius: 20px;
        padding: 24px; color: #fff;
    }

    .summary-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 16px; font-weight: 700;
        margin-bottom: 20px; padding-bottom: 14px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .summary-row {
        display: flex; justify-content: space-between;
        align-items: center; margin-bottom: 14px;
        font-size: 13px;
    }

    .summary-row .s-label { color: rgba(255,255,255,0.5); }
    .summary-row .s-value { font-weight: 600; color: #fff; }

    .s-value.green  { color: #4ade80; }
    .s-value.yellow { color: #fbbf24; }
    .s-value.red    { color: #f87171; }

    .summary-divider {
        border: none; border-top: 1px solid rgba(255,255,255,0.08);
        margin: 6px 0 16px;
    }

    @media (max-width: 1024px) {
        .stats-wrap { grid-template-columns: repeat(2, 1fr); }
        .main-wrap  { grid-template-columns: 1fr; }
    }

    @media (max-width: 640px) {
        .dash-header { padding: 0 20px; }
        .hero { padding: 28px 20px 40px; }
        .hero h1 { font-size: 24px; }
        .stats-wrap { grid-template-columns: 1fr 1fr; padding: 0 20px; }
        .main-wrap  { padding: 0 20px; }
    }
</style>

<!-- HEADER -->
<header class="dash-header">
    <div class="dash-logo">
        <div class="dash-logo-icon">🏥</div>
        <span class="dash-logo-text">MediCare</span>
    </div>
    <div class="dash-right">
        <span class="admin-badge">⚙️ Admin</span>
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
        <div class="hero-left">
            <div class="hero-tag">⚙️ Administration Panel</div>
            <h1>Hospital Dashboard</h1>
            <p>Overview of doctors, patients, and appointments</p>
        </div>
        <div class="hero-date">
            <strong>{{ now()->format('d M Y') }}</strong>
            {{ now()->format('l') }}
        </div>
    </div>
</div>

<!-- STATS -->
<div class="stats-wrap">
    <a href="{{ route('admin.doctors') }}" class="stat-card">
        <div class="stat-top">
            <div class="stat-icon blue">👨‍⚕️</div>
            <span class="stat-trend trend-up">Active</span>
        </div>
        <div class="stat-value">{{ $totalDoctors }}</div>
        <div class="stat-label">Total Doctors</div>
        <span class="stat-link">View all doctors →</span>
    </a>

    <a href="{{ route('admin.patients') }}" class="stat-card">
        <div class="stat-top">
            <div class="stat-icon teal">🧑‍⚕️</div>
            <span class="stat-trend trend-up">Registered</span>
        </div>
        <div class="stat-value">{{ $totalPatients }}</div>
        <div class="stat-label">Total Patients</div>
        <span class="stat-link">View all patients →</span>
    </a>

    <div class="stat-card">
        <div class="stat-top">
            <div class="stat-icon purple">📋</div>
            <span class="stat-trend trend-up">All time</span>
        </div>
        <div class="stat-value">{{ $totalAppointments }}</div>
        <div class="stat-label">Total Appointments</div>
    </div>

    <div class="stat-card">
        <div class="stat-top">
            <div class="stat-icon gold">⏳</div>
            <span class="stat-trend trend-warn">Pending</span>
        </div>
        <div class="stat-value">{{ $pendingAppointments }}</div>
        <div class="stat-label">Pending Appointments</div>
    </div>
</div>

<!-- MAIN -->
<div class="main-wrap">

    <!-- LEFT: Recent Appointments -->
    <div>
        <div class="section-title">Recent Appointments</div>
        <div class="table-card">
            <div class="table-card-header">
                <h2>Latest Activity</h2>
                <span class="count-badge">{{ $latestAppointments->count() }} records</span>
            </div>
            <div style="overflow-x:auto">
                <table>
                    <thead>
                        <tr>
                            <th>Patient</th>
                            <th>Doctor</th>
                            <th>Reason</th>
                            <th>Date & Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestAppointments as $appt)
                        <tr>
                            <td class="patient-name">{{ $appt->patient->name }}</td>
                            <td>
                                <div class="doctor-cell">
                                    <div class="doc-mini-avatar">
                                        {{ strtoupper(substr($appt->doctor->name, 4, 1)) }}
                                    </div>
                                    {{ $appt->doctor->name }}
                                </div>
                            </td>
                            <td>{{ $appt->reason ?? 'General Checkup' }}</td>
                            <td>
                                <div style="font-weight:600">
                                    {{ \Carbon\Carbon::parse($appt->appointment_date)->format('d M Y') }}
                                </div>
                                <div style="font-size:11px;color:var(--muted)">
                                    {{ \Carbon\Carbon::parse($appt->appointment_time)->format('h:i A') }}
                                </div>
                            </td>
                            <td>
                                @php $cls = match($appt->status) {
                                    'completed' => 'status-completed',
                                    'cancelled' => 'status-cancelled',
                                    default     => 'status-pending',
                                }; @endphp
                                <span class="status-badge {{ $cls }}">
                                    {{ ucfirst($appt->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr><td class="empty-cell" colspan="5">No appointments yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- RIGHT: Sidebar -->
    <div class="sidebar">

        <!-- Quick Links -->
        <div class="quick-links">
            <div class="ql-header">Quick Actions</div>

            <a href="{{ route('admin.doctors') }}" class="ql-item">
                <div class="ql-icon teal">👨‍⚕️</div>
                Manage Doctors
                <span class="ql-arrow">→</span>
            </a>

            <a href="{{ route('admin.patients') }}" class="ql-item">
                <div class="ql-icon blue">🧑‍⚕️</div>
                Manage Patients
                <span class="ql-arrow">→</span>
            </a>

            <a href="{{ route('admin.doctors') }}" class="ql-item">
                <div class="ql-icon purple">📋</div>
                View Appointments
                <span class="ql-arrow">→</span>
            </a>
        </div>

        <!-- Appointment Summary -->
        <div class="summary-card">
            <div class="summary-card-title">📊 Appointment Summary</div>

            <div class="summary-row">
                <span class="s-label">Total</span>
                <span class="s-value">{{ $totalAppointments }}</span>
            </div>
            <hr class="summary-divider">
            <div class="summary-row">
                <span class="s-label">Pending</span>
                <span class="s-value yellow">{{ $pendingAppointments }}</span>
            </div>
            <div class="summary-row">
                <span class="s-label">Completed</span>
                <span class="s-value green">{{ $completedAppointments ?? 0 }}</span>
            </div>
            <div class="summary-row">
                <span class="s-label">Cancelled</span>
                <span class="s-value red">{{ $cancelledAppointments ?? 0 }}</span>
            </div>
        </div>

    </div>
</div>

@endsection