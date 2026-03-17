@extends('layouts.app')

@section('title', 'Keahlian | Sabah Teachers Union')

@section('content')

<style>
/* ─── Animations ─────────────────────────────────── */
@keyframes fadeInUp {
    from { opacity:0; transform:translateY(32px); }
    to   { opacity:1; transform:translateY(0); }
}
@keyframes fadeInLeft {
    from { opacity:0; transform:translateX(-36px); }
    to   { opacity:1; transform:translateX(0); }
}
@keyframes fadeInRight {
    from { opacity:0; transform:translateX(36px); }
    to   { opacity:1; transform:translateX(0); }
}
@keyframes countUp {
    from { opacity:0; transform:scale(0.7); }
    to   { opacity:1; transform:scale(1); }
}
@keyframes softPulse {
    0%,100% { box-shadow: 0 0 0 0 rgba(239,68,68,0.25); }
    50%      { box-shadow: 0 0 0 10px rgba(239,68,68,0); }
}
@keyframes ripple {
    0%   { transform:scale(0); opacity:0.6; }
    100% { transform:scale(4); opacity:0; }
}

.anim-up    { animation: fadeInUp   0.75s cubic-bezier(.2,.8,.2,1) both; }
.anim-left  { animation: fadeInLeft 0.75s cubic-bezier(.2,.8,.2,1) both; }
.anim-right { animation: fadeInRight 0.75s cubic-bezier(.2,.8,.2,1) both; }
.d1 { animation-delay:.1s; } .d2 { animation-delay:.2s; }
.d3 { animation-delay:.3s; } .d4 { animation-delay:.4s; }
.d5 { animation-delay:.5s; } .d6 { animation-delay:.6s; }

/* ─── Panel cards ─────────────────────────────────── */
.k-card {
    background:#fff;
    border-radius:24px;
    overflow:hidden;
    box-shadow:0 2px 8px rgba(0,0,0,.06), 0 16px 48px rgba(0,0,0,.07);
    border:1px solid rgba(0,0,0,.05);
    transition:transform .3s ease, box-shadow .3s ease;
}
.k-card:hover {
    transform:translateY(-5px);
    box-shadow:0 8px 24px rgba(0,0,0,.09), 0 32px 64px rgba(0,0,0,.1);
}

/* ─── Panel headers ───────────────────────────────── */
.ph-blue { background:linear-gradient(135deg,#1e3a5f 0%,#2d5986 60%,#1a4a7a 100%); }
.ph-red  { background:linear-gradient(135deg,#7f1d1d 0%,#b91c1c 60%,#991b1b 100%); }
.ph-base {
    padding:32px 28px 26px;
    position:relative; overflow:hidden;
}
.ph-base::after {
    content:'';
    position:absolute; top:-60px; right:-60px;
    width:180px; height:180px;
    border-radius:50%;
    background:rgba(255,255,255,.07);
    pointer-events:none;
}
.ph-icon {
    width:56px; height:56px;
    border-radius:16px;
    display:flex; align-items:center; justify-content:center;
    background:rgba(255,255,255,.18);
    margin-bottom:16px;
}

/* ─── Fee rows ────────────────────────────────────── */
.fee-row {
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:16px;
    padding:18px 24px;
    border-bottom:1px solid #f1f5f9;
    cursor:default;
    position:relative;
    transition:background .22s;
    /* Ripple base */
    overflow:hidden;
}
.fee-row:last-child { border-bottom:none; }
.fee-row:hover { background:#f8fafd; }
.fee-row:focus-within { background:#f0f7ff; outline:2px solid #2d5986; }

/* ripple on click */
.fee-row .ripple {
    position:absolute;
    border-radius:50%;
    width:60px; height:60px;
    margin-top:-30px; margin-left:-30px;
    background:rgba(45,89,134,.18);
    animation:ripple .5s linear;
    pointer-events:none;
}

.fee-label-text {
    font-size:1rem;
    font-weight:700;
    color:#1e293b;
    line-height:1.4;
}
.fee-label-sub {
    font-size:0.82rem;
    font-weight:500;
    color:#94a3b8;
    margin-top:3px;
}

.fee-badge {
    flex-shrink:0;
    font-size:0.95rem;
    font-weight:800;
    padding:8px 20px;
    border-radius:50px;
    white-space:nowrap;
    letter-spacing:.01em;
    transition:transform .2s, box-shadow .2s, filter .2s;
}

/* Kemasukan — indigo */
.b-blue {
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    color: #fff;
    animation: softPulseIndigo 3s ease-in-out infinite;
}
/* Yuran Ahli — emerald */
.b-green {
    background: linear-gradient(135deg, #10b981, #059669);
    color: #fff;
    animation: softPulseEmerald 3s ease-in-out infinite;
}
/* Skim Kebajikan — amber-orange */
.b-slate {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: #fff;
    animation: softPulseAmber 3s ease-in-out infinite;
}

@keyframes softPulseIndigo {
    0%,100% { box-shadow: 0 0 0 0 rgba(99,102,241,0.35); }
    50%      { box-shadow: 0 0 0 9px rgba(99,102,241,0); }
}
@keyframes softPulseEmerald {
    0%,100% { box-shadow: 0 0 0 0 rgba(16,185,129,0.35); }
    50%      { box-shadow: 0 0 0 9px rgba(16,185,129,0); }
}
@keyframes softPulseAmber {
    0%,100% { box-shadow: 0 0 0 0 rgba(245,158,11,0.35); }
    50%      { box-shadow: 0 0 0 9px rgba(245,158,11,0); }
}

/* ─── Wakalah responsive ─────────────────────────── */
.wm-table-wrap { display:block; }   /* shown on desktop */
.wm-cards     { display:none;  }   /* shown on mobile  */
@media (max-width: 767px) {
    .wm-table-wrap { display:none; }
    .wm-cards      { display:block; }
}
.wm-card {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 16px;
    margin-bottom: 12px;
    overflow: hidden;
}
.wm-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 20px;
    cursor: pointer;
    user-select: none;
    gap: 12px;
    transition: background .2s;
}
.wm-card-header:hover { background: rgba(255,255,255,0.06); }
.wm-card-header .wm-ch-title { color:#e2e8f0; font-size:0.95rem; font-weight:700; }
.wm-card-header .wm-ch-icon  { color:#93c5fd; font-size:1.2rem; flex-shrink:0; transition:transform .3s; }
.wm-card-header.open .wm-ch-icon { transform:rotate(180deg); }
.wm-card-body {
    display: none;
    padding: 0 20px 16px;
}
.wm-card-body.open { display:block; }
.wm-tier-row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 0;
    border-bottom: 1px solid rgba(255,255,255,0.06);
}
.wm-tier-row:last-child { border-bottom: none; }
.wm-tier-label { color:#94a3b8; font-size:0.82rem; font-weight:700; flex-shrink:0; min-width:50px; }
.wm-tier-val   { font-size:1rem; font-weight:800; text-align:right; }

/* ─── Total bar ───────────────────────────────────── */
.total-bar {
    margin:4px 20px 16px;
    padding:20px 24px;
    border-radius:18px;
    background:linear-gradient(135deg,#1e3a5f,#2d5986);
    display:flex; align-items:center; justify-content:space-between; gap:12px;
}
.total-bar-label { color:#bfdbfe; font-size:0.9rem; font-weight:600; }
.total-bar-amt   {
    color:#fff; font-size:1.5rem; font-weight:900;
    animation:countUp .6s .8s both;
}

/* ─── Angkasa note ────────────────────────────────── */
.angkasa-note {
    margin:0 20px 20px;
    padding:13px 16px;
    border-radius:14px;
    background:#fffbeb;
    border:1px solid #fde68a;
    display:flex; align-items:center; gap:10px;
    font-size:0.88rem; font-weight:600; color:#92400e;
}

/* ─── Benefit rows ────────────────────────────────── */
.ben-row {
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:16px;
    padding:18px 24px;
    border-bottom:1px solid #fef2f2;
    position:relative;
    overflow:hidden;
    transition:background .22s;
    cursor:default;
}
.ben-row:last-child { border-bottom:none; }
.ben-row:hover { background:#fff7f7; }

.ben-icon {
    width:44px; height:44px;
    flex-shrink:0;
    border-radius:12px;
    display:flex; align-items:center; justify-content:center;
    background:#fef2f2;
    transition:background .2s, transform .2s;
}
.ben-row:hover .ben-icon {
    background:#fee2e2;
    transform:scale(1.1) rotate(-4deg);
}

.ben-label { font-size:1rem; font-weight:700; color:#1e293b; line-height:1.4; }
.ben-sub   { font-size:0.82rem; font-weight:500; color:#94a3b8; margin-top:3px; }

.ben-amount {
    flex-shrink:0;
    font-size:1rem; font-weight:900;
    padding:9px 20px;
    border-radius:50px;
    background:linear-gradient(135deg,#ef4444,#b91c1c);
    color:#fff;
    white-space:nowrap;
    animation:softPulse 3s ease-in-out infinite;
    transition:transform .2s, filter .2s;
}
.ben-row:hover .ben-amount {
    transform:scale(1.08);
    filter:brightness(1.08);
}

/* ─── Disclaimer ──────────────────────────────────── */
.disclaimer {
    margin:4px 20px 20px;
    padding:15px 18px;
    border-radius:16px;
    background:linear-gradient(135deg,#166534,#15803d);
    display:flex; gap:10px; align-items:flex-start;
    font-size:0.88rem; font-weight:600; color:#dcfce7; line-height:1.6;
}

/* ─── Tooltip (global, JS-driven, fixed to body) ────── */
#g-tooltip {
    position:fixed;
    background:#1e293b;
    color:#fff;
    font-size:0.8rem;
    font-weight:500;
    line-height:1.5;
    white-space:nowrap;
    padding:7px 14px;
    border-radius:10px;
    pointer-events:none;
    opacity:0;
    transform:translateY(4px);
    transition:opacity .18s ease, transform .18s ease;
    z-index:99999;
}
#g-tooltip.show {
    opacity:1;
    transform:translateY(0);
}
#g-tooltip::after {
    content:'';
    position:absolute;
    top:100%; left:50%;
    transform:translateX(-50%);
    border:5px solid transparent;
    border-top-color:#1e293b;
}

/* ─── Steps ───────────────────────────────────────── */
.step-item {
    display:flex; gap:16px; align-items:flex-start;
    padding:18px 0;
    border-bottom:1px solid #f1f5f9;
    transition:background .2s;
    border-radius:12px;
    padding-left:12px; padding-right:12px;
}
.step-item:last-child { border-bottom:none; }
.step-item:hover { background:#f8fafc; }

.step-num {
    width:40px; height:40px;
    flex-shrink:0;
    border-radius:50%;
    display:flex; align-items:center; justify-content:center;
    font-size:1rem; font-weight:900; color:#fff;
    background:linear-gradient(135deg,#1e3a5f,#2d5986);
}

/* ─── CTA ─────────────────────────────────────────── */
.cta-btn-primary {
    display:inline-flex; align-items:center; gap:10px;
    padding:16px 28px;
    font-size:1rem; font-weight:800;
    border-radius:16px;
    background:#1e293b;
    color:#fff;
    transition:background .25s, transform .25s, box-shadow .25s;
    box-shadow:0 4px 20px rgba(0,0,0,.18);
    position:relative; overflow:hidden;
}
.cta-btn-primary:hover {
    background:var(--color-primary, #b91c1c);
    transform:scale(1.04);
    box-shadow:0 8px 28px rgba(0,0,0,.22);
}
.cta-btn-secondary {
    display:inline-flex; align-items:center; gap:10px;
    padding:16px 28px;
    font-size:1rem; font-weight:700;
    border-radius:16px;
    border:2.5px solid #e2e8f0;
    color:#374151;
    transition:border-color .25s, color .25s, transform .25s;
    background:#fff;
}
.cta-btn-secondary:hover {
    border-color:#b91c1c;
    color:#b91c1c;
    transform:scale(1.03);
}
</style>

<div class="min-h-screen bg-slate-50">

    {{-- ── Hero ─────────────────────────────────────── --}}
    <div class="bg-white border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center anim-up d1">
            
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 mb-5 leading-tight">
                Maklumat <span class="text-primary">Keahlian</span>
            </h1>
            <p class="text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed">
                Semua maklumat berkaitan yuran bulanan dan faedah perlindungan yang anda nikmati sebagai ahli STU.
            </p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">

        {{-- ── Two-column main section ──────────────── --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">

            {{-- ── LEFT: Yuran Keahlian ────────────── --}}
            <div class="k-card anim-left d2">

                {{-- header --}}
                <div class="ph-base ph-blue">
                    <div class="ph-icon">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white">Yuran Keahlian</h2>
                    <p class="text-blue-200 text-base mt-1 font-medium">Kadar semasa yang dikenakan kepada ahli STU</p>
                </div>

                {{-- rows --}}
                <div class="py-2" id="yuran-rows">

                    <div class="fee-row" tabindex="0" onclick="addRipple(event)">
                        <div>
                            <div class="fee-label-text">Yuran Kemasukan</div>
                            <div class="fee-label-sub">Dibayar sekali seumur hidup sahaja</div>
                        </div>
                        <span class="fee-badge b-blue" data-tip="Bayaran pendaftaran ahli baharu">RM 10.00</span>
                    </div>

                    <div class="fee-row" tabindex="0" onclick="addRipple(event)">
                        <div>
                            <div class="fee-label-text">Yuran Ahli</div>
                            <div class="fee-label-sub">Potongan bulanan melalui BPA</div>
                        </div>
                        <span class="fee-badge b-green" data-tip="Ditolak terus daripada gaji anda">RM 4.00</span>
                    </div>

                    <div class="fee-row" tabindex="0" onclick="addRipple(event)">
                        <div>
                            <div class="fee-label-text">Skim Kebajikan Ahli</div>
                            <div class="fee-label-sub">Caruman bulanan untuk manfaat kebajikan</div>
                        </div>
                        <span class="fee-badge b-slate" data-tip="Meliputi rawatan hospital, khairat &amp; lain-lain">RM 10.00</span>
                    </div>

                </div>

                {{-- total --}}
                <div class="total-bar">
                    <div>
                        <div class="total-bar-label">Jumlah Potongan Bulanan</div>
                        <div style="color:#93c5fd; font-size:0.8rem; margin-top:2px;">Yuran Ahli + Skim Kebajikan</div>
                    </div>
                    <div class="total-bar-amt">RM 14.00</div>
                </div>

                {{-- angkasa note --}}
                <div class="angkasa-note">
                    <svg class="w-5 h-5 flex-shrink-0 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span>Potongan dilakukan secara automatik melalui <strong>Biro Perkhidmatan Angkasa (BPA)</strong></span>
                </div>

            </div>{{-- end left --}}


            {{-- ── RIGHT: Faedah Keahlian ───────────── --}}
            <div class="k-card anim-right d3">

                {{-- header --}}
                <div class="ph-base ph-red">
                    <div class="ph-icon">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-white">Faedah Keahlian</h2>
                    <p class="text-red-200 text-base mt-1 font-medium">Manfaat perlindungan yang anda layak terima</p>
                </div>

                {{-- rows --}}
                <div class="py-2">

                    <div class="ben-row" tabindex="0">
                        <div class="ben-icon">
                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                      d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <div style="flex:1">
                            <div class="ben-label">🏥 Rawatan Hospital</div>
                            <div class="ben-sub">Hospital kerajaan atau swasta (setiap kemasukan)</div>
                        </div>
                        <span class="ben-amount" data-tip="Setiap kali dimasukkan ke hospital">RM 20</span>
                    </div>

                    <div class="ben-row" tabindex="0">
                        <div class="ben-icon">
                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                      d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <div style="flex:1">
                            <div class="ben-label">⚕️ Penyakit Kritikal</div>
                            <div class="ben-sub">Penyakit serius yang didiagnos oleh doktor</div>
                        </div>
                        <span class="ben-amount" data-tip="Dibayar sekali sahaja per tuntutan">RM 10,000</span>
                    </div>

                    <div class="ben-row" tabindex="0">
                        <div class="ben-icon">
                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                      d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </div>
                        <div style="flex:1">
                            <div class="ben-label">🕊️ Kematian Ahli</div>
                            <div class="ben-sub">Akibat biasa atau kemalangan</div>
                        </div>
                        <span class="ben-amount" data-tip="Dibayar kepada waris ahli yang meninggal">RM 10,000</span>
                    </div>

                    <div class="ben-row" tabindex="0">
                        <div class="ben-icon">
                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                      d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <div style="flex:1">
                            <div class="ben-label">💐 Khairat Kematian</div>
                            <div class="ben-sub">Ahli dan pasangan</div>
                        </div>
                        <span class="ben-amount" data-tip="Bantuan khas untuk keluarga ahli">RM 1,000</span>
                    </div>

                </div>

                {{-- disclaimer --}}
                <div class="disclaimer">
                    <svg class="w-5 h-5 flex-shrink-0 text-green-300 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                    <span>
                        Semua tuntutan hanya berkuatkuasa <strong class="text-white">60 hari</strong>
                        selepas potongan gaji pertama dibuat melalui BPA.
                    </span>
                </div>

            </div>{{-- end right --}}

        </div>{{-- end grid --}}


        {{-- ══════════════════════════════════════════════════════ --}}
        {{-- ── POSTER: Skim Berkelompok Wakalah Mutiara ────────── --}}
        {{-- ══════════════════════════════════════════════════════ --}}
        <div class="mt-16 anim-up d4">
            <div style="background:linear-gradient(145deg,#0f172a 0%,#1e3a5f 50%,#0f172a 100%);border-radius:28px;overflow:hidden;position:relative;box-shadow:0 20px 60px rgba(0,0,0,0.35);">

                {{-- Decorative blobs --}}
                <div style="position:absolute;width:400px;height:400px;border-radius:50%;background:rgba(99,102,241,0.08);top:-120px;right:-80px;pointer-events:none;"></div>
                <div style="position:absolute;width:300px;height:300px;border-radius:50%;background:rgba(239,68,68,0.07);bottom:-80px;left:-60px;pointer-events:none;"></div>

                {{-- ── Hero ── --}}
                <div style="padding:48px 40px 32px;position:relative;z-index:1;text-align:center;">
                    <span style="display:inline-block;font-size:0.72rem;font-weight:800;letter-spacing:0.12em;text-transform:uppercase;color:#a5b4fc;background:rgba(99,102,241,0.15);border:1px solid rgba(99,102,241,0.3);padding:6px 18px;border-radius:50px;margin-bottom:20px;">Program Tambahan Ahli STU</span>
                    <h2 style="font-size:clamp(1.6rem,4vw,2.5rem);font-weight:900;color:#fff;letter-spacing:-0.02em;line-height:1.2;margin:0 0 6px;">Skim Berkelompok</h2>
                    <h2 style="font-size:clamp(1.6rem,4vw,2.5rem);font-weight:900;background:linear-gradient(90deg,#fbbf24,#f59e0b,#fde68a);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;letter-spacing:-0.02em;line-height:1.2;margin:0 0 32px;">Wakalah Mutiara</h2>

                    {{-- Highlight box --}}
                    <div style="background:rgba(30,58,95,0.7);backdrop-filter:blur(8px);border:1px solid rgba(99,162,241,0.2);border-radius:20px;padding:24px 28px;margin-bottom:16px;max-width:700px;margin-left:auto;margin-right:auto;">
                        <div style="color:#93c5fd;font-size:0.85rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:10px;">Dengan menjadi ahli STU:</div>
                        <p style="color:#fff;font-size:clamp(1rem,2.5vw,1.15rem);font-weight:800;line-height:1.6;margin:0;">
                            Anda &amp; ahli keluarga layak menyertai<br>
                            <span style="color:#fde68a;">Program Hibah Berkelompok</span> berserta Kad Kesihatan
                        </p>
                    </div>

                    {{-- Promo badge --}}
                    <div style="background:linear-gradient(135deg,#dc2626,#b91c1c);border-radius:18px;padding:18px 24px;display:flex;align-items:center;gap:14px;box-shadow:0 8px 24px rgba(239,68,68,0.3);max-width:700px;margin:0 auto;text-align:left;">
                        <div style="font-size:2rem;flex-shrink:0;">📣</div>
                        <div>
                            <div style="color:#fecaca;font-size:0.75rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;margin-bottom:4px;">Promosi Khas</div>
                            <p style="color:#fff;font-size:0.95rem;font-weight:800;margin:0;line-height:1.5;">
                                Bagi yang mempunyai masalah kesihatan —
                                <span style="color:#fde68a;">tanpa perlu laporan perubatan!</span>
                            </p>
                        </div>
                    </div>
                </div>

                {{-- ── Table section ── --}}
                <div style="padding:8px 24px 40px;position:relative;z-index:1;">

                    {{-- Shared title bar --}}
                    <div style="background:rgba(255,255,255,0.07);padding:16px 24px;text-align:center;border-radius:16px 16px 0 0;border:1px solid rgba(255,255,255,0.1);border-bottom:none;">
                        <div style="color:#fbbf24;font-size:0.82rem;font-weight:700;margin-bottom:4px;">* Sumbangan bermula dari RM10 sehingga RM200 sebulan</div>
                        <div style="color:#fff;font-size:1.1rem;font-weight:900;letter-spacing:0.04em;">SKIM TAKAFUL WAKALAH MUTIARA</div>
                    </div>

                    {{-- ── DESKTOP TABLE ─────────────────── --}}
                    <div class="wm-table-wrap" style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);border-radius:0 0 16px 16px;overflow:hidden;">
                        <div style="overflow-x:auto;">
                            <table style="width:100%;border-collapse:collapse;min-width:540px;">
                                <thead>
                                    <tr style="background:linear-gradient(135deg,#166534,#15803d);">
                                        <th style="padding:14px 20px;text-align:left;color:#fff;font-size:0.88rem;font-weight:800;text-transform:uppercase;letter-spacing:0.05em;width:40%;">Perlindungan</th>
                                        <th colspan="3" style="padding:14px 20px;text-align:center;color:#fff;font-size:0.88rem;font-weight:800;text-transform:uppercase;letter-spacing:0.05em;">Pilihan Sumbangan Bulanan</th>
                                    </tr>
                                    <tr style="background:rgba(21,128,61,0.25);border-bottom:1px solid rgba(255,255,255,0.1);">
                                        <th style="padding:10px 20px;color:#86efac;font-size:0.78rem;font-weight:500;text-align:left;">Semakin tinggi sumbangan, semakin besar perlindungan</th>
                                        <th style="padding:10px 16px;text-align:center;color:#fde68a;font-size:1.1rem;font-weight:900;font-style:italic;">RM20</th>
                                        <th style="padding:10px 16px;text-align:center;color:#fde68a;font-size:1.1rem;font-weight:900;font-style:italic;">RM30</th>
                                        <th style="padding:10px 16px;text-align:center;color:#fde68a;font-size:1.1rem;font-weight:900;font-style:italic;">RM40</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="border-bottom:1px solid rgba(255,255,255,0.06);transition:background .2s;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background=''">
                                        <td style="padding:16px 20px;color:#e2e8f0;font-size:0.95rem;font-weight:700;">36 Jenis Kritikal<div style="color:#64748b;font-size:0.78rem;font-weight:400;margin-top:2px;">Kanser, strok, serangan jantung & penyakit serius lain</div></td>
                                        <td style="padding:16px;text-align:center;color:#fff;font-size:0.95rem;font-weight:800;">RM40,000<div style="color:#64748b;font-size:0.72rem;">+TT</div></td>
                                        <td style="padding:16px;text-align:center;color:#fff;font-size:0.95rem;font-weight:800;">RM60,000<div style="color:#64748b;font-size:0.72rem;">+TT</div></td>
                                        <td style="padding:16px;text-align:center;color:#fff;font-size:0.95rem;font-weight:800;">RM80,000<div style="color:#64748b;font-size:0.72rem;">+TT</div></td>
                                    </tr>
                                    <tr style="background:rgba(255,255,255,0.03);border-bottom:1px solid rgba(255,255,255,0.06);">
                                        <td colspan="4" style="padding:8px 20px;color:#93c5fd;font-size:0.78rem;font-weight:800;text-transform:uppercase;letter-spacing:0.06em;">Kematian</td>
                                    </tr>
                                    <tr style="border-bottom:1px solid rgba(255,255,255,0.05);transition:background .2s;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background=''">
                                        <td style="padding:12px 20px 12px 32px;color:#cbd5e1;font-size:0.92rem;">Akibat Penyakit / Biasa<div style="color:#64748b;font-size:0.75rem;margin-top:2px;">Dibayar kepada waris ahli</div></td>
                                        <td style="padding:12px 16px;text-align:center;color:#fff;font-size:0.95rem;font-weight:800;">RM40,000<div style="color:#64748b;font-size:0.72rem;">+TT</div></td>
                                        <td style="padding:12px 16px;text-align:center;color:#fff;font-size:0.95rem;font-weight:800;">RM60,000<div style="color:#64748b;font-size:0.72rem;">+TT</div></td>
                                        <td style="padding:12px 16px;text-align:center;color:#fff;font-size:0.95rem;font-weight:800;">RM80,000<div style="color:#64748b;font-size:0.72rem;">+TT</div></td>
                                    </tr>
                                    <tr style="border-bottom:1px solid rgba(255,255,255,0.06);transition:background .2s;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background=''">
                                        <td style="padding:12px 20px 12px 32px;color:#cbd5e1;font-size:0.92rem;">Akibat Kemalangan<div style="color:#64748b;font-size:0.75rem;margin-top:2px;">Pampasan lebih tinggi jika kemalangan</div></td>
                                        <td style="padding:12px 16px;text-align:center;color:#fde68a;font-size:0.95rem;font-weight:900;">RM80,000<div style="color:#64748b;font-size:0.72rem;font-weight:400;">+TT</div></td>
                                        <td style="padding:12px 16px;text-align:center;color:#fde68a;font-size:0.95rem;font-weight:900;">RM120,000<div style="color:#64748b;font-size:0.72rem;font-weight:400;">+TT</div></td>
                                        <td style="padding:12px 16px;text-align:center;color:#fde68a;font-size:0.95rem;font-weight:900;">RM160,000<div style="color:#64748b;font-size:0.72rem;font-weight:400;">+TT</div></td>
                                    </tr>
                                    <tr style="background:rgba(255,255,255,0.03);border-bottom:1px solid rgba(255,255,255,0.06);">
                                        <td colspan="4" style="padding:8px 20px;color:#93c5fd;font-size:0.78rem;font-weight:800;text-transform:uppercase;letter-spacing:0.06em;">Hilang Upaya Menyeluruh</td>
                                    </tr>
                                    <tr style="border-bottom:1px solid rgba(255,255,255,0.05);transition:background .2s;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background=''">
                                        <td style="padding:12px 20px 12px 32px;color:#cbd5e1;font-size:0.92rem;">Akibat Penyakit / Biasa<div style="color:#64748b;font-size:0.75rem;margin-top:2px;">Tidak berupaya bekerja akibat penyakit</div></td>
                                        <td style="padding:12px 16px;text-align:center;color:#fff;font-size:0.95rem;font-weight:800;">RM40,000<div style="color:#64748b;font-size:0.72rem;">+TT</div></td>
                                        <td style="padding:12px 16px;text-align:center;color:#fff;font-size:0.95rem;font-weight:800;">RM60,000<div style="color:#64748b;font-size:0.72rem;">+TT</div></td>
                                        <td style="padding:12px 16px;text-align:center;color:#fff;font-size:0.95rem;font-weight:800;">RM80,000<div style="color:#64748b;font-size:0.72rem;">+TT</div></td>
                                    </tr>
                                    <tr style="border-bottom:1px solid rgba(255,255,255,0.06);transition:background .2s;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background=''">
                                        <td style="padding:12px 20px 12px 32px;color:#cbd5e1;font-size:0.92rem;">Akibat Kemalangan<div style="color:#64748b;font-size:0.75rem;margin-top:2px;">Kehilangan upaya kekal</div></td>
                                        <td style="padding:12px 16px;text-align:center;color:#fde68a;font-size:0.95rem;font-weight:900;">RM80,000<div style="color:#64748b;font-size:0.72rem;font-weight:400;">+TT</div></td>
                                        <td style="padding:12px 16px;text-align:center;color:#fde68a;font-size:0.95rem;font-weight:900;">RM120,000<div style="color:#64748b;font-size:0.72rem;font-weight:400;">+TT</div></td>
                                        <td style="padding:12px 16px;text-align:center;color:#fde68a;font-size:0.95rem;font-weight:900;">RM160,000<div style="color:#64748b;font-size:0.72rem;font-weight:400;">+TT</div></td>
                                    </tr>
                                    <tr style="border-bottom:1px solid rgba(255,255,255,0.06);transition:background .2s;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background=''">
                                        <td style="padding:16px 20px;color:#e2e8f0;font-size:0.95rem;font-weight:700;">Elaun Hospital<div style="color:#64748b;font-size:0.75rem;font-weight:400;margin-top:2px;">Dibayar setiap hari dirawat (in-patient)</div></td>
                                        <td style="padding:16px;text-align:center;color:#6ee7b7;font-size:0.95rem;font-weight:900;">RM40<div style="color:#64748b;font-size:0.72rem;font-weight:400;">/hari</div></td>
                                        <td style="padding:16px;text-align:center;color:#6ee7b7;font-size:0.95rem;font-weight:900;">RM60<div style="color:#64748b;font-size:0.72rem;font-weight:400;">/hari</div></td>
                                        <td style="padding:16px;text-align:center;color:#6ee7b7;font-size:0.95rem;font-weight:900;">RM80<div style="color:#64748b;font-size:0.72rem;font-weight:400;">/hari</div></td>
                                    </tr>
                                    <tr style="background:rgba(99,102,241,0.12);">
                                        <td style="padding:18px 20px;color:#e2e8f0;font-size:0.95rem;font-weight:700;">Tabung Terkumpul Dikembalikan<div style="color:#64748b;font-size:0.75rem;font-weight:400;margin-top:2px;">Wang caruman tidak hangus</div></td>
                                        <td colspan="3" style="padding:18px 20px;text-align:center;color:#c4b5fd;font-size:0.92rem;font-weight:700;line-height:1.6;">T/T dikembalikan apabila skim matang<br>pada umur peserta <strong style="color:#fff;">65 tahun</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style="padding:12px 24px;border-top:1px solid rgba(255,255,255,0.06);">
                            <span style="color:#64748b;font-size:0.8rem;font-weight:600;"><strong style="color:#a5b4fc;">T/T</strong> = Tabung Terkumpul — jumlah caruman dikembalikan kepada peserta apabila skim matang pada umur 65 tahun</span>
                        </div>
                    </div>{{-- end desktop table --}}

                    {{-- ── MOBILE CARDS ───────────────────── --}}
                    <div class="wm-cards" style="border:1px solid rgba(255,255,255,0.1);border-radius:0 0 16px 16px;overflow:hidden;">

                        {{-- Tier legend --}}
                        <div style="background:rgba(21,128,61,0.3);padding:12px 16px;display:grid;grid-template-columns:1fr 1fr 1fr;gap:4px;text-align:center;">
                            <div style="color:#fde68a;font-size:1rem;font-weight:900;font-style:italic;">RM20</div>
                            <div style="color:#fde68a;font-size:1rem;font-weight:900;font-style:italic;">RM30</div>
                            <div style="color:#fde68a;font-size:1rem;font-weight:900;font-style:italic;">RM40</div>
                            <div style="color:#86efac;font-size:0.7rem;">Sumbangan Bulanan</div>
                            <div></div>
                            <div style="color:#86efac;font-size:0.7rem;text-align:right;">↑ Lebih besar perlindungan</div>
                        </div>

                        <div style="padding:12px;background:rgba(255,255,255,0.02);">

                            {{-- Card: 36 Kritikal --}}
                            <div class="wm-card">
                                <div class="wm-card-header" onclick="wmToggle(this)">
                                    <div>
                                        <div class="wm-ch-title">36 Jenis Penyakit Kritikal</div>
                                        <div style="color:#64748b;font-size:0.75rem;margin-top:2px;">Kanser, strok, serangan jantung & lain-lain</div>
                                    </div>
                                    <span class="wm-ch-icon">⌄</span>
                                </div>
                                <div class="wm-card-body">
                                    <div class="wm-tier-row"><span class="wm-tier-label">RM20</span><span class="wm-tier-val" style="color:#fff;">RM40,000 <span style="color:#64748b;font-size:0.75rem;">+TT</span></span></div>
                                    <div class="wm-tier-row"><span class="wm-tier-label">RM30</span><span class="wm-tier-val" style="color:#fff;">RM60,000 <span style="color:#64748b;font-size:0.75rem;">+TT</span></span></div>
                                    <div class="wm-tier-row"><span class="wm-tier-label">RM40</span><span class="wm-tier-val" style="color:#fff;">RM80,000 <span style="color:#64748b;font-size:0.75rem;">+TT</span></span></div>
                                </div>
                            </div>

                            {{-- Card: Kematian Penyakit --}}
                            <div class="wm-card">
                                <div class="wm-card-header" onclick="wmToggle(this)">
                                    <div>
                                        <div class="wm-ch-title">Kematian Akibat Penyakit</div>
                                        <div style="color:#64748b;font-size:0.75rem;margin-top:2px;">Dibayar kepada waris ahli yang meninggal</div>
                                    </div>
                                    <span class="wm-ch-icon">⌄</span>
                                </div>
                                <div class="wm-card-body">
                                    <div class="wm-tier-row"><span class="wm-tier-label">RM20</span><span class="wm-tier-val" style="color:#fff;">RM40,000 <span style="color:#64748b;font-size:0.75rem;">+TT</span></span></div>
                                    <div class="wm-tier-row"><span class="wm-tier-label">RM30</span><span class="wm-tier-val" style="color:#fff;">RM60,000 <span style="color:#64748b;font-size:0.75rem;">+TT</span></span></div>
                                    <div class="wm-tier-row"><span class="wm-tier-label">RM40</span><span class="wm-tier-val" style="color:#fff;">RM80,000 <span style="color:#64748b;font-size:0.75rem;">+TT</span></span></div>
                                </div>
                            </div>

                            {{-- Card: Kematian Kemalangan --}}
                            <div class="wm-card">
                                <div class="wm-card-header" onclick="wmToggle(this)">
                                    <div>
                                        <div class="wm-ch-title">Kematian Akibat Kemalangan</div>
                                        <div style="color:#64748b;font-size:0.75rem;margin-top:2px;">Pampasan lebih tinggi jika melibatkan kemalangan</div>
                                    </div>
                                    <span class="wm-ch-icon">⌄</span>
                                </div>
                                <div class="wm-card-body">
                                    <div class="wm-tier-row"><span class="wm-tier-label">RM20</span><span class="wm-tier-val" style="color:#fde68a;">RM80,000 <span style="color:#64748b;font-size:0.75rem;">+TT</span></span></div>
                                    <div class="wm-tier-row"><span class="wm-tier-label">RM30</span><span class="wm-tier-val" style="color:#fde68a;">RM120,000 <span style="color:#64748b;font-size:0.75rem;">+TT</span></span></div>
                                    <div class="wm-tier-row"><span class="wm-tier-label">RM40</span><span class="wm-tier-val" style="color:#fde68a;">RM160,000 <span style="color:#64748b;font-size:0.75rem;">+TT</span></span></div>
                                </div>
                            </div>

                            {{-- Card: Hilang Upaya Penyakit --}}
                            <div class="wm-card">
                                <div class="wm-card-header" onclick="wmToggle(this)">
                                    <div>
                                        <div class="wm-ch-title">Hilang Upaya — Akibat Penyakit</div>
                                        <div style="color:#64748b;font-size:0.75rem;margin-top:2px;">Tidak berupaya bekerja sepenuhnya</div>
                                    </div>
                                    <span class="wm-ch-icon">⌄</span>
                                </div>
                                <div class="wm-card-body">
                                    <div class="wm-tier-row"><span class="wm-tier-label">RM20</span><span class="wm-tier-val" style="color:#fff;">RM40,000 <span style="color:#64748b;font-size:0.75rem;">+TT</span></span></div>
                                    <div class="wm-tier-row"><span class="wm-tier-label">RM30</span><span class="wm-tier-val" style="color:#fff;">RM60,000 <span style="color:#64748b;font-size:0.75rem;">+TT</span></span></div>
                                    <div class="wm-tier-row"><span class="wm-tier-label">RM40</span><span class="wm-tier-val" style="color:#fff;">RM80,000 <span style="color:#64748b;font-size:0.75rem;">+TT</span></span></div>
                                </div>
                            </div>

                            {{-- Card: Hilang Upaya Kemalangan --}}
                            <div class="wm-card">
                                <div class="wm-card-header" onclick="wmToggle(this)">
                                    <div>
                                        <div class="wm-ch-title">Hilang Upaya — Akibat Kemalangan</div>
                                        <div style="color:#64748b;font-size:0.75rem;margin-top:2px;">Kehilangan upaya kekal akibat kemalangan</div>
                                    </div>
                                    <span class="wm-ch-icon">⌄</span>
                                </div>
                                <div class="wm-card-body">
                                    <div class="wm-tier-row"><span class="wm-tier-label">RM20</span><span class="wm-tier-val" style="color:#fde68a;">RM80,000 <span style="color:#64748b;font-size:0.75rem;">+TT</span></span></div>
                                    <div class="wm-tier-row"><span class="wm-tier-label">RM30</span><span class="wm-tier-val" style="color:#fde68a;">RM120,000 <span style="color:#64748b;font-size:0.75rem;">+TT</span></span></div>
                                    <div class="wm-tier-row"><span class="wm-tier-label">RM40</span><span class="wm-tier-val" style="color:#fde68a;">RM160,000 <span style="color:#64748b;font-size:0.75rem;">+TT</span></span></div>
                                </div>
                            </div>

                            {{-- Card: Elaun Hospital --}}
                            <div class="wm-card">
                                <div class="wm-card-header" onclick="wmToggle(this)">
                                    <div>
                                        <div class="wm-ch-title">Elaun Hospital</div>
                                        <div style="color:#64748b;font-size:0.75rem;margin-top:2px;">Dibayar setiap hari rawatan (in-patient)</div>
                                    </div>
                                    <span class="wm-ch-icon">⌄</span>
                                </div>
                                <div class="wm-card-body">
                                    <div class="wm-tier-row"><span class="wm-tier-label">RM20</span><span class="wm-tier-val" style="color:#6ee7b7;">RM40 <span style="color:#64748b;font-size:0.75rem;">/hari</span></span></div>
                                    <div class="wm-tier-row"><span class="wm-tier-label">RM30</span><span class="wm-tier-val" style="color:#6ee7b7;">RM60 <span style="color:#64748b;font-size:0.75rem;">/hari</span></span></div>
                                    <div class="wm-tier-row"><span class="wm-tier-label">RM40</span><span class="wm-tier-val" style="color:#6ee7b7;">RM80 <span style="color:#64748b;font-size:0.75rem;">/hari</span></span></div>
                                </div>
                            </div>

                            {{-- Card: Tabung Terkumpul --}}
                            <div class="wm-card" style="background:rgba(99,102,241,0.12);">
                                <div style="padding:16px 20px;">
                                    <div class="wm-ch-title text-white"> Tabung Terkumpul Dikembalikan</div>
                                    <div style="color:#94a3b8;font-size:0.8rem;margin-top:6px;line-height:1.5;">
                                        Wang caruman anda tidak hangus. T/T dikembalikan apabila skim matang pada umur peserta <strong style="color:#fff;">65 tahun</strong>.
                                    </div>
                                </div>
                            </div>

                        </div>{{-- end padding --}}

                        <div style="padding:12px 16px;border-top:1px solid rgba(255,255,255,0.06);">
                            <span style="color:#64748b;font-size:0.78rem;font-weight:600;"><strong style="color:#a5b4fc;">T/T</strong> = Tabung Terkumpul — dikembalikan apabila skim matang pada umur 65 tahun</span>
                        </div>
                    </div>{{-- end mobile cards --}}

                </div>{{-- end table section --}}

            </div>
        </div>
        {{-- ── END POSTER ──────────────────────────────────────── --}}


        {{-- ── Cara Sertai STU ─────────────────────── --}}
        <div class="mt-14 anim-up d4">
            <div class="bg-white rounded-3xl border-2 border-gray-200 shadow-lg p-8 md:p-12">

                {{-- Header --}}
                <div class="text-center mb-10">
                    <span class="inline-block text-xs font-bold tracking-widest text-primary uppercase bg-primary/10 px-4 py-2 rounded-full mb-4">Mudah &amp; Pantas</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900">Cara Sertai STU</h2>
                    <p class="text-gray-500 mt-2 text-base max-w-xl mx-auto">Ikuti 4 langkah mudah ini untuk menjadi ahli STU dan mula menikmati perlindungan penuh.</p>
                </div>

                {{-- Steps grid --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

                    {{-- Step 1: Muat Turun --}}
                    <div class="group flex flex-col bg-gray-50 hover:bg-primary/5 border border-gray-100 hover:border-primary/30 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <div class="flex items-center justify-between mb-5">
                            <span class="w-8 h-8 rounded-full bg-primary text-white text-sm font-bold flex items-center justify-center">1</span>
                            <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="font-bold text-gray-900 text-base mb-2">Muat Turun Borang</h3>
                        <p class="text-gray-500 text-sm leading-relaxed flex-1">Dapatkan borang keahlian STU secara dalam talian atau ambil terus di pejabat STU.</p>
                        <a href="{{ url('/borang/muat-turun') }}" class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-primary hover:text-primary/70 transition-colors">
                            Muat turun sekarang
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>

                    {{-- Step 2: Isi Borang --}}
                    <div class="group flex flex-col bg-gray-50 hover:bg-primary/5 border border-gray-100 hover:border-primary/30 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <div class="flex items-center justify-between mb-5">
                            <span class="w-8 h-8 rounded-full bg-primary text-white text-sm font-bold flex items-center justify-center">2</span>
                            <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="font-bold text-gray-900 text-base mb-2">Isi Borang</h3>
                        <p class="text-gray-500 text-sm leading-relaxed flex-1">Lengkapkan semua maklumat dengan tepat — nombor kad pengenalan, sekolah, dan maklumat peribadi.</p>
                        <span class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-gray-400 select-none">
                            Pastikan maklumat tepat
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </span>
                    </div>

                    {{-- Step 3: Serahkan Borang --}}
                    <div class="group flex flex-col bg-gray-50 hover:bg-primary/5 border border-gray-100 hover:border-primary/30 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <div class="flex items-center justify-between mb-5">
                            <span class="w-8 h-8 rounded-full bg-primary text-white text-sm font-bold flex items-center justify-center">3</span>
                            <div class="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center text-primary group-hover:bg-primary group-hover:text-white transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="font-bold text-gray-900 text-base mb-2">Serahkan Borang</h3>
                        <p class="text-gray-500 text-sm leading-relaxed flex-1">Serahkan borang yang lengkap kepada wakil STU di sekolah anda atau hantar terus melalui portal.</p>
                        <a href="{{ url('/borang/hantar') }}" class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-primary hover:text-primary/70 transition-colors">
                            Hantar dalam talian
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>

                    {{-- Step 4: Potongan Gaji --}}
                    <div class="group flex flex-col bg-gray-50 hover:bg-emerald-50 border border-gray-100 hover:border-emerald-200 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                        <div class="flex items-center justify-between mb-5">
                            <span class="w-8 h-8 rounded-full bg-emerald-500 text-white text-sm font-bold flex items-center justify-center">4</span>
                            <div class="w-10 h-10 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-500 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                        <h3 class="font-bold text-gray-900 text-base mb-2">Potongan Gaji Bermula</h3>
                        <p class="text-gray-500 text-sm leading-relaxed flex-1">Setelah diproses, potongan RM14.00 sebulan akan bermula melalui BPA secara automatik.</p>
                        <span class="mt-5 inline-flex items-center gap-2 text-sm font-semibold text-emerald-600">
                            Selesai — anda kini ahli STU
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                        </span>
                    </div>

                </div>

                {{-- Footer: Hubungi Kami --}}
                <div class="border-t border-gray-100 pt-7 flex flex-col sm:flex-row items-center justify-between gap-5">
                    <div>
                        <p class="text-sm font-semibold text-gray-800 mb-1">Tidak pasti cara mendaftar sendiri?</p>
                        <p class="text-sm text-gray-400">Tiada masalah — anda boleh daftar melalui kami. Pasukan STU akan uruskan semua proses pendaftaran untuk anda.</p>
                    </div>
                    <a href="{{ url('/hubungi') }}" class="flex-shrink-0 inline-flex items-center gap-3 bg-gray-900 hover:bg-gray-700 text-white px-6 py-3 rounded-xl font-semibold text-sm transition-all duration-200 hover:shadow-lg hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Daftar Melalui Kami
                    </a>
                </div>

            </div>
        </div>

    </div>{{-- end max-w --}}
</div>

@push('scripts')
<script>
    /* ── Wakalah mobile accordion ── */
    function wmToggle(header) {
        const body = header.nextElementSibling;
        const isOpen = body.classList.contains('open');
        header.classList.toggle('open', !isOpen);
        body.classList.toggle('open', !isOpen);
    }

    /* ── Global body-level tooltip (bypasses overflow:hidden) ── */

    const tip = document.createElement('div');
    tip.id = 'g-tooltip';
    document.body.appendChild(tip);

    let hideTimer;
    document.querySelectorAll('[data-tip]').forEach(el => {
        el.style.cursor = 'default';
        el.addEventListener('mouseenter', e => {
            clearTimeout(hideTimer);
            tip.textContent = el.dataset.tip;
            const r = el.getBoundingClientRect();
            tip.style.left = (r.left + r.width / 2) + 'px';
            tip.style.top  = (r.top - 10) + 'px';
            tip.style.transform = 'translate(-50%, -100%)';
            tip.classList.add('show');
        });
        el.addEventListener('mouseleave', () => {
            hideTimer = setTimeout(() => tip.classList.remove('show'), 120);
        });
    });

    /* ── Ripple effect on row click ── */
    function addRipple(e) {
        const row = e.currentTarget;
        const circle = document.createElement('span');
        circle.classList.add('ripple');
        row.appendChild(circle);
        const rect = row.getBoundingClientRect();
        circle.style.left = (e.clientX - rect.left) + 'px';
        circle.style.top  = (e.clientY - rect.top)  + 'px';
        setTimeout(() => circle.remove(), 600);
    }

    /* ── Animate total amount on scroll into view ── */
    const totalEl = document.querySelector('.total-bar-amt');
    if (totalEl && 'IntersectionObserver' in window) {
        const ob = new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) {
                totalEl.style.animation = 'none';
                void totalEl.offsetWidth;
                totalEl.style.animation = 'countUp .6s ease both';
                ob.disconnect();
            }
        }, { threshold: 0.5 });
        ob.observe(totalEl);
    }
</script>
@endpush

@endsection
