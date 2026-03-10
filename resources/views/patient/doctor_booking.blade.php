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
        background: var(--teal);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 18px;
    }
    .dash-logo-text {
        font-family: 'Playfair Display', serif;
        color: #fff; font-size: 18px; font-weight: 700;
    }
    .dash-nav { display: flex; align-items: center; gap: 20px; }
    .back-btn {
        display: inline-flex; align-items: center; gap: 6px;
        color: rgba(255,255,255,0.7); font-size: 13px;
        text-decoration: none; transition: color 0.2s;
    }
    .back-btn:hover { color: #fff; }
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
        background: linear-gradient(135deg, var(--teal) 0%, #065a4e 100%);
        padding: 36px 40px;
        position: relative; overflow: hidden;
    }
    .hero::before {
        content: ''; position: absolute;
        top: -60px; right: -60px;
        width: 250px; height: 250px;
        background: rgba(255,255,255,0.04); border-radius: 50%;
    }
    .hero-content { max-width: 1000px; margin: 0 auto; position: relative; z-index: 1; }
    .hero-tag {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.2);
        color: rgba(255,255,255,0.9); font-size: 11px;
        font-weight: 500; letter-spacing: 1.5px;
        text-transform: uppercase; padding: 4px 14px;
        border-radius: 20px; margin-bottom: 12px;
    }
    .hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 30px; color: #fff; font-weight: 700;
        line-height: 1.2; margin-bottom: 6px;
    }
    .hero p { color: rgba(255,255,255,0.7); font-size: 14px; }

    /* ── LAYOUT ── */
    .main-wrap {
        max-width: 1000px;
        margin: 0 auto;
        padding: 36px 40px 60px;
        display: grid;
        grid-template-columns: 1fr 380px;
        gap: 28px;
        align-items: start;
    }

    /* ── CARDS ── */
    .card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid var(--border);
        overflow: hidden;
        margin-bottom: 24px;
    }
    .card-header {
        padding: 20px 24px;
        border-bottom: 1px solid var(--border);
        display: flex; align-items: center; gap: 10px;
    }
    .card-header h2 {
        font-family: 'Playfair Display', serif;
        font-size: 17px; font-weight: 700;
    }
    .card-header .icon {
        width: 32px; height: 32px;
        background: var(--teal-pale);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 15px;
    }
    .card-body { padding: 24px; }

    /* ── DOCTOR PROFILE ── */
    .doc-profile {
        display: flex; align-items: center; gap: 20px;
        padding: 24px;
    }
    .doc-avatar {
        width: 80px; height: 80px;
        border-radius: 20px;
        background: var(--teal);
        color: #fff;
        display: flex; align-items: center; justify-content: center;
        font-family: 'Playfair Display', serif;
        font-size: 30px; font-weight: 700;
        flex-shrink: 0;
        box-shadow: 0 8px 20px rgba(10,126,110,0.3);
    }
    .doc-details h2 {
        font-family: 'Playfair Display', serif;
        font-size: 20px; font-weight: 700; margin-bottom: 4px;
    }
    .doc-email { font-size: 13px; color: var(--muted); margin-bottom: 8px; }
    .doc-meta { display: flex; gap: 10px; flex-wrap: wrap; }
    .meta-badge {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 12px; font-weight: 600; padding: 4px 12px;
        border-radius: 20px;
    }
    .badge-teal { background: rgba(10,126,110,0.1); color: var(--teal); }
    .badge-blue { background: #eff6ff; color: #1d4ed8; }

    /* ── ALERTS ── */
    .alert {
        padding: 12px 16px; border-radius: 10px;
        font-size: 13px; font-weight: 500;
        margin-bottom: 20px;
        display: flex; align-items: center; gap: 8px;
    }
    .alert-error   { background: #fef2f2; color: var(--red); border: 1px solid #fecaca; }
    .alert-success { background: #f0fdf4; color: var(--green); border: 1px solid #bbf7d0; }

    /* ── FORM ── */
    .form-group { margin-bottom: 20px; }
    .form-label {
        display: block; font-size: 13px; font-weight: 600;
        color: var(--deep); margin-bottom: 8px;
        text-transform: uppercase; letter-spacing: 0.5px;
    }
    .form-input {
        width: 100%; padding: 11px 14px;
        border: 1.5px solid var(--border);
        border-radius: 10px; font-family: 'DM Sans', sans-serif;
        font-size: 14px; color: var(--deep);
        transition: border-color 0.2s;
        background: #fff;
    }
    .form-input:focus {
        outline: none;
        border-color: var(--teal);
        box-shadow: 0 0 0 3px rgba(10,126,110,0.1);
    }

    /* ── TIME SLOTS ── */
    .slots-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 8px;
        margin-top: 4px;
    }
    .slot-btn {
        padding: 10px 6px;
        border-radius: 10px;
        border: 1.5px solid var(--border);
        background: #fff;
        font-family: 'DM Sans', sans-serif;
        font-size: 13px; font-weight: 600;
        cursor: pointer;
        transition: all 0.18s;
        color: var(--deep);
    }
    .slot-btn:hover:not(:disabled) {
        border-color: var(--teal);
        background: var(--teal-pale);
        color: var(--teal);
    }
    .slot-btn.selected {
        background: var(--teal);
        border-color: var(--teal);
        color: #fff;
        box-shadow: 0 4px 12px rgba(10,126,110,0.3);
    }
    .slot-btn:disabled {
        background: #f3f4f6;
        color: #9ca3af;
        border-color: #e5e7eb;
        cursor: not-allowed;
        text-decoration: line-through;
    }
    .slots-loading {
        text-align: center; padding: 20px;
        color: var(--muted); font-size: 13px;
    }
    .slots-hint {
        font-size: 12px; color: var(--muted);
        margin-top: 8px; text-align: center;
    }

    /* ── SUBMIT BTN ── */
    .btn-submit {
        width: 100%; padding: 14px;
        background: var(--teal); color: #fff;
        border: none; border-radius: 12px;
        font-family: 'DM Sans', sans-serif;
        font-size: 15px; font-weight: 700;
        cursor: pointer; transition: all 0.2s;
        display: flex; align-items: center;
        justify-content: center; gap: 8px;
    }
    .btn-submit:hover {
        background: var(--teal-light);
        box-shadow: 0 6px 18px rgba(10,126,110,0.35);
        transform: translateY(-1px);
    }
    .btn-submit:disabled {
        background: #9ca3af; cursor: not-allowed;
        transform: none; box-shadow: none;
    }

    /* ── APPOINTMENTS TABLE ── */
    .appt-table { width: 100%; border-collapse: collapse; }
    .appt-table thead th {
        background: #f7f3ee;
        padding: 11px 16px;
        text-align: left; font-size: 11px;
        font-weight: 600; color: var(--muted);
        text-transform: uppercase; letter-spacing: 0.8px;
    }
    .appt-table tbody td {
        padding: 14px 16px;
        font-size: 13px;
        border-bottom: 1px solid #f3ede6;
        color: var(--deep);
    }
    .appt-table tbody tr:last-child td { border-bottom: none; }
    .appt-table tbody tr:hover td { background: #fafaf8; }

    .status-badge {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 3px 10px; border-radius: 20px;
        font-size: 11px; font-weight: 600;
    }
    .status-pending   { background: #fef9c3; color: #854d0e; }
    .status-completed { background: #dcfce7; color: #166534; }
    .status-cancelled { background: #fee2e2; color: #991b1b; }

    .empty-cell {
        text-align: center; padding: 36px !important;
        color: var(--muted); font-size: 13px;
    }

    /* ── BOOKING SUMMARY (right sidebar) ── */
    .summary-card {
        background: var(--deep);
        border-radius: 20px;
        padding: 24px;
        color: #fff;
        position: sticky;
        top: 88px;
    }
    .summary-title {
        font-family: 'Playfair Display', serif;
        font-size: 16px; font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 14px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .summary-row {
        display: flex; justify-content: space-between;
        align-items: flex-start; margin-bottom: 14px;
        font-size: 13px;
    }
    .summary-row .label { color: rgba(255,255,255,0.5); font-size: 11px; text-transform: uppercase; letter-spacing: 0.5px; }
    .summary-row .value { color: #fff; font-weight: 600; text-align: right; max-width: 180px; }
    .summary-divider { border: none; border-top: 1px solid rgba(255,255,255,0.1); margin: 16px 0; }

    .summary-time-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: var(--teal); color: #fff;
        padding: 6px 14px; border-radius: 20px;
        font-size: 14px; font-weight: 700;
    }

    @media (max-width: 768px) {
        .dash-header { padding: 0 20px; }
        .hero { padding: 28px 20px; }
        .main-wrap { grid-template-columns: 1fr; padding: 20px; }
        .summary-card { position: static; }
        .slots-grid { grid-template-columns: repeat(3, 1fr); }
    }
</style>

<!-- HEADER -->
<header class="dash-header">
    <div class="dash-logo">
        <div class="dash-logo-icon">🏥</div>
        <span class="dash-logo-text">MediCare</span>
    </div>
    <div class="dash-nav">
        <a href="{{ route('patient.dashboard') }}" class="back-btn">← Back to Dashboard</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</header>

<!-- HERO -->
<div class="hero">
    <div class="hero-content">
        <div class="hero-tag">✦ Book Appointment</div>
        <h1>Schedule with {{ $doctor->name }}</h1>
        <p>{{ $doctor->category->name ?? 'General' }} Specialist · Available 9:00 AM – 5:00 PM</p>
    </div>
</div>

<!-- MAIN -->
<div class="main-wrap">

    <!-- LEFT COLUMN -->
    <div>

        <!-- Doctor Profile Card -->
        <div class="card">
            <div class="doc-profile">
                <div class="doc-avatar">{{ strtoupper(substr($doctor->name, 4, 1)) }}</div>
                <div class="doc-details">
                    <h2>{{ $doctor->name }}</h2>
                    <div class="doc-email">{{ $doctor->email }}</div>
                    <div class="doc-meta">
                        <span class="meta-badge badge-teal">🩺 {{ $doctor->category->name ?? 'General' }}</span>
                        <span class="meta-badge badge-blue">🕐 9:00 AM – 5:00 PM</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Form -->
        <div class="card">
            <div class="card-header">
                <div class="icon">📅</div>
                <h2>Book an Appointment</h2>
            </div>
            <div class="card-body">

                @if(session('error'))
                    <div class="alert alert-error">⚠️ {{ session('error') }}</div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success">✅ {{ session('success') }}</div>
                @endif

                <form action="{{ route('patient.book.store') }}" method="POST" id="bookingForm">
                    @csrf
                    <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">

                    <!-- Date -->
                    <div class="form-group">
                        <label class="form-label">Appointment Date</label>
                        <input type="date" name="appointment_date" id="appointment_date"
                               class="form-input" min="{{ date('Y-m-d') }}" required>
                    </div>

                    <!-- Time Slots -->
                    <div class="form-group">
                        <label class="form-label">Select Time Slot</label>
                        <div id="slots-wrap">
                            <div class="slots-loading">← Pick a date to see available slots</div>
                        </div>
                        <input type="hidden" name="appointment_time" id="appointment_time_input">
                        <p class="slots-hint" id="slots-hint" style="display:none">
                            🔴 Booked &nbsp;&nbsp; 🟢 Available &nbsp;&nbsp; ✅ Selected
                        </p>
                    </div>

                    <!-- Reason -->
                    <div class="form-group">
                        <label class="form-label">Reason for Visit</label>
                        <input type="text" name="reason" id="reason_input"
                               class="form-input" required
                               placeholder="e.g. Regular checkup, follow-up, consultation...">
                    </div>

                    <button type="submit" class="btn-submit" id="submitBtn" disabled>
                        📋 Confirm Appointment
                    </button>
                </form>
            </div>
        </div>

        <!-- My Appointments -->
        <div class="card">
            <div class="card-header">
                <div class="icon">📋</div>
                <h2>My Appointments with this Doctor</h2>
            </div>
            <div style="overflow-x:auto">
                <table class="appt-table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Reason</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($appointments as $appt)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($appt->appointment_date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($appt->appointment_time)->format('H:i') }}</td>
                            <td>{{ $appt->reason }}</td>
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
                        <tr><td class="empty-cell" colspan="4">No appointments with this doctor yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- RIGHT COLUMN — Summary -->
    <div>
        <div class="summary-card">
            <div class="summary-title">📋 Booking Summary</div>

            <div class="summary-row">
                <span class="label">Doctor</span>
                <span class="value">{{ $doctor->name }}</span>
            </div>
            <div class="summary-row">
                <span class="label">Specialization</span>
                <span class="value">{{ $doctor->category->name ?? 'General' }}</span>
            </div>
            <div class="summary-row">
                <span class="label">Patient</span>
                <span class="value">{{ auth()->user()->name }}</span>
            </div>

            <hr class="summary-divider">

            <div class="summary-row">
                <span class="label">Date</span>
                <span class="value" id="summary-date" style="color:rgba(255,255,255,0.35)">Not selected</span>
            </div>
            <div class="summary-row">
                <span class="label">Time</span>
                <span class="value" id="summary-time-wrap">
                    <span style="color:rgba(255,255,255,0.35)">Not selected</span>
                </span>
            </div>
            <div class="summary-row">
                <span class="label">Reason</span>
                <span class="value" id="summary-reason" style="color:rgba(255,255,255,0.35)">Not entered</span>
            </div>

            <hr class="summary-divider">

            <div style="font-size:12px; color:rgba(255,255,255,0.4); line-height:1.6;">
                ℹ️ Appointments can be cancelled up to 2 hours before the scheduled time. Please arrive 10 minutes early.
            </div>
        </div>
    </div>

</div>

<script>
const TIME_SLOTS = ['09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00'];
const doctorId   = '{{ $doctor->id }}';

const dateInput   = document.getElementById('appointment_date');
const slotsWrap   = document.getElementById('slots-wrap');
const timeInput   = document.getElementById('appointment_time_input');
const submitBtn   = document.getElementById('submitBtn');
const reasonInput = document.getElementById('reason_input');

// Summary elements
const sumDate   = document.getElementById('summary-date');
const sumTimeW  = document.getElementById('summary-time-wrap');
const sumReason = document.getElementById('summary-reason');

function checkSubmit() {
    submitBtn.disabled = !(timeInput.value && reasonInput.value.trim());
}

// Update summary live
dateInput.addEventListener('change', async () => {
    const date = dateInput.value;
    if (!date) return;

    // Update summary date
    const d = new Date(date + 'T00:00:00');
    sumDate.textContent = d.toLocaleDateString('en-GB', { day:'2-digit', month:'short', year:'numeric' });
    sumDate.style.color = '#fff';

    // Reset time
    timeInput.value = '';
    sumTimeW.innerHTML = '<span style="color:rgba(255,255,255,0.35)">Not selected</span>';
    checkSubmit();

    slotsWrap.innerHTML = '<div class="slots-loading">⏳ Loading available slots...</div>';
    document.getElementById('slots-hint').style.display = 'none';

    try {
        const res  = await fetch(`/patient/booked-slots/${doctorId}/${date}`);
        const booked = await res.json();
        renderSlots(booked, date);
        document.getElementById('slots-hint').style.display = 'block';
    } catch(e) {
        slotsWrap.innerHTML = '<div class="slots-loading" style="color:#dc2626">Failed to load slots. Try again.</div>';
    }
});

function renderSlots(booked, date) {
    const now   = new Date();
    const today = now.toISOString().split('T')[0];
    const grid  = document.createElement('div');
    grid.className = 'slots-grid';

    TIME_SLOTS.forEach(slot => {
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.textContent = slot;
        btn.className = 'slot-btn';

        let disabled = booked.includes(slot);

        if (!disabled && date === today) {
            const [h, m] = slot.split(':');
            const slotTime = new Date(now.getFullYear(), now.getMonth(), now.getDate(), +h, +m);
            if (slotTime <= now) disabled = true;
        }

        if (disabled) {
            btn.disabled = true;
            btn.title = 'Already booked';
        } else {
            btn.addEventListener('click', () => {
                grid.querySelectorAll('.slot-btn').forEach(b => b.classList.remove('selected'));
                btn.classList.add('selected');
                timeInput.value = slot;

                // Update summary
                sumTimeW.innerHTML = `<span class="summary-time-badge">🕐 ${slot}</span>`;
                checkSubmit();
            });
        }

        grid.appendChild(btn);
    });

    slotsWrap.innerHTML = '';
    slotsWrap.appendChild(grid);
}

reasonInput.addEventListener('input', () => {
    sumReason.textContent = reasonInput.value.trim() || 'Not entered';
    sumReason.style.color = reasonInput.value.trim() ? '#fff' : 'rgba(255,255,255,0.35)';
    checkSubmit();
});

// Prevent double submit
document.getElementById('bookingForm').addEventListener('submit', function(e) {
    if (!timeInput.value) {
        e.preventDefault();
        alert('Please select a time slot.');
        return;
    }
    submitBtn.disabled = true;
    submitBtn.textContent = '⏳ Booking...';
});
</script>

@endsection