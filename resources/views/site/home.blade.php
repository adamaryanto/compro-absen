@extends('layouts.site')

@section('content')
    @php
        $introPoints = text_lines(csetting('intro_points'));
        $showcasePoints = text_lines(csetting('showcase_points'));
        $heroPrimary = trim((string) csetting('hero_cta_url')) ?: route('register');
        $heroSecondary = trim((string) csetting('hero_cta2_url')) ?: route('admin.login');
        $showcaseUrl = cta_url('showcase_cta_url');
    @endphp

    {{-- ============================== HERO ============================== --}}
    <section class="hero">
        <svg class="hero-art" viewBox="0 0 1440 900" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
            <defs>
                <linearGradient id="heroTint" x1="0" y1="0" x2="1" y2="1">
                    <stop offset="0" stop-color="#ffffff" stop-opacity="0.06" />
                    <stop offset="1" stop-color="#ffffff" stop-opacity="0" />
                </linearGradient>
            </defs>
            <path fill="url(#heroTint)" d="M860 -120C1120 -70 1300 90 1440 230V780C1180 850 960 740 880 540Z" />
        </svg>

        <div class="container hero-grid">
            <div class="hero-copy reveal">
                <p class="eyebrow eyebrow--light">{{ csetting('hero_eyebrow') }}</p>
                <h1>
                    {{ csetting('hero_title') }}<br>
                    <span class="accent">{{ csetting('hero_title_accent') }}</span>
                </h1>
                <p class="hero-sub">{{ csetting('hero_subtitle') }}</p>

                <div class="hero-actions">
                    <a class="btn btn--accent" href="{{ $heroPrimary }}">
                        {{ csetting('hero_cta_label') }}
                    </a>
                    <a class="btn btn--ghost" href="{{ $heroSecondary }}">
                        {{ csetting('hero_cta2_label') }}
                    </a>
                </div>

                <p class="hero-note">{{ csetting('hero_note') }}</p>
            </div>

            <div class="hero-visual reveal">
                <div class="hero-frame">
                    @include('site.partials.app-window')
                </div>

            </div>
        </div>

        <svg class="hero-curve" viewBox="0 0 1440 140" preserveAspectRatio="none" aria-hidden="true">
            <path fill="#ffffff" d="M0 66C210 138 420 24 660 58S1140 34 1440 44V140H0Z" />
        </svg>
    </section>

    {{-- ============================== LATAR ============================== --}}
    @if (is_on('section_intro_enabled'))
        <section class="section section--intro" id="latar">
            <div class="container intro-grid">
                <div class="ledger-wrap reveal">
                    <div class="ledger" role="img" aria-label="Pratinjau rekap periode November 2026 dengan total lembur 214,5 jam dan status terkunci">
                        <div class="ledger-head">
                            <div>
                                <div class="ledger-kicker">Payroll · Rekap</div>
                                <div class="ledger-title">Periode 01–30 Nov</div>
                            </div>
                            <span class="ledger-stamp">Terkunci</span>
                        </div>

                        <div class="ledger-row ledger-row--head">
                            <span>Karyawan</span>
                            <span>Hadir</span>
                            <span>Lembur</span>
                            <span>Potongan</span>
                        </div>
                        <div class="ledger-row">
                            <span><strong>Siti Aminah</strong></span>
                            <span>25</span>
                            <span>6,5</span>
                            <span>-</span>
                        </div>
                        <div class="ledger-row">
                            <span><strong>Budi Santoso</strong></span>
                            <span>24</span>
                            <span>4,0</span>
                            <span>25.000</span>
                        </div>
                        <div class="ledger-row">
                            <span><strong>Rina Wulandari</strong></span>
                            <span>25</span>
                            <span>8,5</span>
                            <span>-</span>
                        </div>
                        <div class="ledger-row is-mark">
                            <span><strong>Agus Priyo</strong></span>
                            <span>23</span>
                            <span>12,0</span>
                            <span>50.000</span>
                        </div>
                        <div class="ledger-row">
                            <span><strong>Nur Hidayah</strong></span>
                            <span>22</span>
                            <span>3,0</span>
                            <span>75.000</span>
                        </div>

                        <div class="ledger-foot">
                            <div>
                                <span>Total lembur</span>
                                <strong>214,5 jam</strong>
                            </div>
                            <span class="ledger-check">
                                <x-icon name="check" /> Cocok dengan mesin
                            </span>
                        </div>
                    </div>
                    <p class="preview-note">Data contoh</p>
                </div>

                <div class="intro-copy reveal">
                    <p class="eyebrow">{{ csetting('intro_eyebrow') }}</p>
                    <h2>{{ csetting('intro_title') }}</h2>
                    <p>{{ csetting('intro_body') }}</p>

                    @if ($introPoints)
                        <ul class="intro-list">
                            @foreach ($introPoints as $point)
                                <li>{{ $point }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </section>
    @endif

    {{-- ============================ KEUNGGULAN =========================== --}}
    @if (is_on('section_benefits_enabled') && $highlights->isNotEmpty())
        <section class="section section--benefits" id="keunggulan">
            <div class="container">
                <div class="section-head reveal">
                    <div>
                        <p class="eyebrow">{{ csetting('benefits_eyebrow') }}</p>
                        <h2 class="section-title">{{ csetting('benefits_title') }}</h2>
                    </div>
                    <p class="section-note">{{ csetting('benefits_note') }}</p>
                </div>

                <div class="benefit-grid">
                    @foreach ($highlights as $highlight)
                        <article class="benefit-card reveal">
                            <div class="benefit-icon">
                                <x-icon :name="$highlight->icon" />
                            </div>
                            <h3>{{ $highlight->title }}</h3>
                            <p>{{ $highlight->description }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============================= SOROTAN ============================= --}}
    @if (is_on('section_showcase_enabled'))
        <section class="section section--showcase" id="realisasi">
            <div class="container showcase-grid">
                <div class="phone-stage reveal">
                    @include('site.partials.phone')
                    <p class="preview-note preview-note--light">Data contoh</p>
                </div>

                <div class="showcase-copy reveal">
                    <p class="eyebrow eyebrow--light">{{ csetting('showcase_eyebrow') }}</p>
                    <h2>{{ csetting('showcase_title') }}</h2>
                    <p>{{ csetting('showcase_body') }}</p>

                    @if ($showcasePoints)
                        <ul class="showcase-points">
                            @foreach ($showcasePoints as $point)
                                <li>
                                    <x-icon name="check" />
                                    {{ $point }}
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <a class="btn btn--accent" href="{{ $showcaseUrl }}">
                        {{ csetting('showcase_cta_label') }}
                    </a>
                </div>
            </div>
        </section>
    @endif

    {{-- ============================== MODUL ============================== --}}
    @if (is_on('section_modules_enabled') && $modules->isNotEmpty())
        <section class="section" id="modul">
            <div class="container">
                <div class="section-head reveal">
                    <div>
                        <p class="eyebrow">{{ csetting('modules_eyebrow') }}</p>
                        <h2 class="section-title">{{ csetting('modules_title') }}</h2>
                    </div>
                    <p class="section-note">{{ csetting('modules_note') }}</p>
                </div>

                <div class="module-list">
                    @foreach ($modules as $module)
                        <a class="module-row reveal" href="#harga">
                            <span class="module-index">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="module-name">{{ $module->name }}</span>
                            <span class="module-desc">{{ $module->description }}</span>
                            <span class="module-meta">{{ $module->meta ?: 'Modul' }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============================== ALUR =============================== --}}
    @if (is_on('section_steps_enabled') && $steps->isNotEmpty())
        <section class="section section--steps" id="alur">
            <div class="container">
                <div class="section-head reveal">
                    <div>
                        <p class="eyebrow">{{ csetting('steps_eyebrow') }}</p>
                        <h2 class="section-title">{{ csetting('steps_title') }}</h2>
                    </div>
                    <p class="section-note">{{ csetting('steps_note') }}</p>
                </div>

                <div class="timeline">
                    @foreach ($steps as $step)
                        <div class="step reveal">
                            <span class="step-dot" aria-hidden="true"></span>
                            <span class="step-phase">{{ $step->phase }}</span>
                            <h3>{{ $step->title }}</h3>
                            <p>{{ $step->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ============================ STATISTIK ============================ --}}
    @if (is_on('section_stats_enabled') && $stats->isNotEmpty())
        <section class="section section--stats" id="statistik">
            <div class="container stats-inner">
                <div class="stats-head reveal">
                    <div>
                        <p class="eyebrow">{{ csetting('stats_eyebrow') }}</p>
                        <h2>{{ csetting('stats_title') }}</h2>
                        <p class="stats-note">Ilustrasi alur kerja, bukan data produksi.</p>
                    </div>
                </div>

                <div class="stats-grid">
                    @foreach ($stats as $stat)
                        <div class="stat reveal">
                            <span class="stat-value">{{ $stat->value }}</span>
                            <span class="stat-label">{{ $stat->label }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- =============================== FAQ =============================== --}}
    @if (is_on('section_faq_enabled') && $faqs->isNotEmpty())
        <section class="section" id="faq">
            <div class="container faq-grid">
                <div class="faq-intro reveal">
                    <p class="eyebrow">{{ csetting('faq_eyebrow') }}</p>
                    <h2>{{ csetting('faq_title') }}</h2>
                    <p>{{ csetting('faq_note') }}</p>
                </div>

                <div class="faq-list reveal">
                    @foreach ($faqs as $faq)
                        <details class="faq-item" @if ($loop->first) open @endif>
                            <summary>
                                {{ $faq->question }}
                                <span class="faq-plus" aria-hidden="true"></span>
                            </summary>
                            <div class="faq-answer">{{ $faq->answer }}</div>
                        </details>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- =============================== HARGA ============================== --}}
    @if (is_on('section_pricing_enabled'))
        @php
            $freeFeatures = text_lines(csetting('free_features'));
            $freeExcluded = text_lines(csetting('free_excluded'));
            $proFeatures = text_lines(csetting('pro_features'));
            $enterpriseFeatures = text_lines(csetting('enterprise_features'));
        @endphp
        <section class="section section--pricing" id="harga">
            <div class="container">
                <div class="pricing-head reveal">
                    <p class="eyebrow">{{ csetting('pricing_eyebrow') }}</p>
                    <h2>{{ csetting('pricing_title') }}</h2>
                    <p>{{ csetting('pricing_subtitle') }}</p>
                </div>

                <div class="pricing-grid">
                    <div class="price-card reveal">
                        <h3 class="price-name">{{ csetting('free_name') }}</h3>
                        <p class="price-desc">{{ csetting('free_desc') }}</p>
                        <p class="price-amount">{{ csetting('free_price') }}</p>
                        <ul class="price-list">
                            @foreach ($freeFeatures as $feature)
                                <li><x-icon name="check" /> {{ $feature }}</li>
                            @endforeach
                        </ul>
                        <ul class="price-list price-list--off">
                            @foreach ($freeExcluded as $item)
                                <li>{{ $item }}</li>
                            @endforeach
                        </ul>
                        <a class="price-cta" href="{{ cta_url('free_url') }}">{{ csetting('free_cta') }}</a>
                    </div>

                    <div class="price-card price-card--featured reveal">
                        @if (csetting('pro_badge'))
                            <span class="price-badge">{{ csetting('pro_badge') }}</span>
                        @endif
                        <h3 class="price-name">{{ csetting('pro_name') }}</h3>
                        <p class="price-desc">{{ csetting('pro_desc') }}</p>
                        <p class="price-amount">
                            {{ csetting('pro_price') }}
                            <span class="price-period">{{ csetting('pro_period') }}</span>
                        </p>
                        <ul class="price-list">
                            @foreach ($proFeatures as $feature)
                                <li><x-icon name="check" /> {{ $feature }}</li>
                            @endforeach
                        </ul>
                        <a class="price-cta price-cta--solid" href="{{ cta_url('pro_url') }}">{{ csetting('pro_cta') }}</a>
                    </div>

                    <div class="price-card reveal">
                        <h3 class="price-name">{{ csetting('enterprise_name') }}</h3>
                        <p class="price-desc">{{ csetting('enterprise_desc') }}</p>
                        <p class="price-amount">{{ csetting('enterprise_price') }}</p>
                        <ul class="price-list">
                            @foreach ($enterpriseFeatures as $index => $feature)
                                <li class="@if ($index === 0) is-intro @endif">
                                    @if ($index > 0) <x-icon name="check" /> @endif{{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                        <a class="price-cta" href="{{ cta_url('enterprise_url') }}">{{ csetting('enterprise_cta') }}</a>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection
