{{-- LEFT: Yuran Keahlian --}}
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

</div>
