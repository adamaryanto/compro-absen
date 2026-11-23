@php
    $dashInitial = mb_strtoupper(mb_substr((string) csetting('brand_name'), 0, 1));
    $dashHost = parse_url((string) csetting('app_url'), PHP_URL_HOST) ?: 'app.local';
    $machines = [
        ['Mesin 1', '10.10.10.1'],
        ['Mesin 2', '10.10.10.2'],
        ['Mesin 3', '10.10.10.3'],
        ['Mesin 4', '10.10.10.4'],
    ];
@endphp

<div class="hero-preview" role="img" aria-label="Pratinjau dashboard absensi: 639 karyawan, empat mesin online, 52 masuk dan 15 pulang">
    <div class="app-window hero-device">
        <div class="app-chrome hero-device-bar" aria-hidden="true">
            <span class="hero-device-dots"><i></i><i></i><i></i></span>
            <span class="app-url">{{ $dashHost }}/dashboard</span>
            <span class="hero-device-tools">
                <x-icon name="shield" />
                <x-icon name="user" />
            </span>
        </div>

        <div class="app-body hero-dashboard" aria-hidden="true">
            <aside class="dash-rail">
                <div class="dash-logo"><i>{{ $dashInitial }}</i><span>{{ csetting('brand_name') }}</span></div>
                <p class="dash-nav-label">Menu utama</p>
                <div class="dash-nav-item"><x-icon name="grid" /> Dashboard</div>
                <div class="dash-nav-item"><x-icon name="users" /> Master</div>
                <div class="dash-nav-item"><x-icon name="receipt" /> Finance</div>
                <div class="dash-nav-item"><x-icon name="calendar" /> Rencana</div>
                <div class="dash-nav-item is-active"><x-icon name="check" /> Realisasi</div>
                <div class="dash-nav-item"><x-icon name="file-text" /> Tarik data</div>
                <div class="dash-nav-item"><x-icon name="shield" /> SIAC</div>
                <div class="dash-nav-item"><x-icon name="chart" /> Setting device</div>
            </aside>

            <div class="dash-main">
                <div class="dash-head">
                    <div>
                        <h3>Dashboard Overview</h3>
                        <p>HRIS &amp; Payroll Management System</p>
                    </div>
                    <span class="dash-crumb">Home / <b>Dashboard</b></span>
                </div>

                <div class="dash-cards">
                    <div class="dash-card">
                        <p class="dash-card-title">Total karyawan</p>
                        <div class="dash-total">
                            <span>Keseluruhan SDM</span>
                            <strong>639 <em>Orang</em></strong>
                        </div>
                    </div>

                    <div class="dash-card">
                        <p class="dash-card-title">Status mesin</p>
                        <p class="dash-card-sub">Koneksi 4 mesin fingerprint</p>
                        <div class="dash-machines">
                            @foreach ($machines as [$label, $ip])
                                <div class="dash-machine">
                                    <b>{{ $label }}</b>
                                    <small>{{ $ip }}</small>
                                    <span class="dash-online">Online</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="dash-card">
                        <p class="dash-card-title">Absen hari ini</p>
                        <p class="dash-card-sub">22 November 2026</p>
                        <div class="dash-attendance">
                            <div class="dash-att dash-att--in"><span>Masuk</span><strong>52</strong><small>orang</small></div>
                            <div class="dash-att dash-att--out"><span>Pulang</span><strong>15</strong><small>orang</small></div>
                            <div class="dash-att dash-att--overtime"><span>Lembur</span><strong>13</strong><small>&gt; 8 jam</small></div>
                            <div class="dash-att dash-att--incomplete"><span>Tidak lengkap</span><strong>37</strong><small>masuk / pulang saja</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-phone" aria-hidden="true">
        <div class="hero-phone-screen">
            <div class="hero-phone-statusbar"><span>09:41</span><span>•••</span></div>
            <p class="hero-phone-greet">Halo, karyawan</p>
            <p class="hero-phone-name">Siap absen hari ini?</p>
            <div class="hero-phone-scan">
                <svg class="hero-phone-face" viewBox="0 0 64 64" aria-hidden="true">
                    <path d="M14 27c0-11 7-18 18-18s18 7 18 18v5H14z" fill="#25324a" />
                    <circle cx="32" cy="33" r="15" fill="#f2c9a6" />
                    <path d="M15 28c2-11 9-17 17-17s15 6 17 17c-5-5-10-7-17-7s-12 2-17 7z" fill="#25324a" />
                    <circle cx="26" cy="32" r="1.8" fill="#25324a" />
                    <circle cx="38" cy="32" r="1.8" fill="#25324a" />
                    <path d="M28 40c2 2 6 2 8 0" fill="none" stroke="#25324a" stroke-width="2" stroke-linecap="round" />
                </svg>
                <i class="hero-phone-corner hero-phone-corner--tl"></i>
                <i class="hero-phone-corner hero-phone-corner--tr"></i>
                <i class="hero-phone-corner hero-phone-corner--bl"></i>
                <i class="hero-phone-corner hero-phone-corner--br"></i>
                <span class="hero-phone-tag">Wajah terdeteksi</span>
            </div>
            <p class="hero-phone-result">Absensi berhasil</p>
            <strong class="hero-phone-time">12.18</strong>
            <p class="hero-phone-note">Terverifikasi · Mesin 02</p>
        </div>
    </div>
</div>
