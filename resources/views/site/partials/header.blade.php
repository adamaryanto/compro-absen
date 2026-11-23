<header class="site-header" id="siteHeader">
    <div class="container header-inner">
        <a class="brand" href="{{ route('home') }}" aria-label="Beranda {{ csetting('brand_name') }}">
            <span class="brand-mark">
                <img src="{{ cmedia(csetting('logo_path')) }}" alt="Logo {{ csetting('company_name') }}" width="40" height="40">
            </span>
            <span class="brand-divider" aria-hidden="true"></span>
            <span>
                <span class="brand-name">{{ csetting('brand_name') }}</span>
                <span class="brand-sub">{{ csetting('brand_tagline') }}</span>
            </span>
        </a>

        <nav class="site-nav" id="siteNav" aria-label="Navigasi utama">
            @if (is_on('section_benefits_enabled'))
                <a href="#keunggulan">Keunggulan</a>
            @endif
            @if (is_on('section_modules_enabled'))
                <a href="#modul">Modul</a>
            @endif
            @if (is_on('section_steps_enabled'))
                <a href="#alur">Alur</a>
            @endif
            @if (is_on('section_faq_enabled'))
                <a href="#faq">FAQ</a>
            @endif
            <div class="header-actions">
                <a class="btn btn--ghost header-cta" href="{{ route('admin.login') }}">Masuk</a>
                <a class="btn btn--accent header-cta" href="{{ route('register') }}">
                    Daftar
                    <x-icon name="arrow-right" width="14" height="14" />
                </a>
            </div>
        </nav>

        <button class="nav-toggle" type="button" id="navToggle" aria-expanded="false" aria-controls="siteNav" aria-label="Buka menu">
            <span></span>
        </button>
    </div>
</header>
