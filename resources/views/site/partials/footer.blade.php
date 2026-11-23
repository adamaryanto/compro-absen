@php
    $email = csetting('contact_email');
    $phone = csetting('contact_phone');
    $address = csetting('contact_address');
@endphp

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <a class="brand" href="{{ route('home') }}">
                    <span class="brand-mark">
                        <img src="{{ cmedia(csetting('logo_path')) }}" alt="" width="40" height="40">
                    </span>
                    <span class="brand-divider" aria-hidden="true"></span>
                    <span>
                        <span class="brand-name">{{ csetting('brand_name') }}</span>
                        <span class="brand-sub">{{ csetting('brand_tagline') }}</span>
                    </span>
                </a>
                <p>{{ csetting('footer_note') }}</p>
            </div>

            <div class="footer-col">
                <h3>Jelajahi</h3>
                <ul>
                    @if (is_on('section_benefits_enabled'))
                        <li><a href="#keunggulan">Keunggulan</a></li>
                    @endif
                    @if (is_on('section_modules_enabled'))
                        <li><a href="#modul">Modul</a></li>
                    @endif
                    @if (is_on('section_steps_enabled'))
                        <li><a href="#alur">Alur kerja</a></li>
                    @endif
                    @if (is_on('section_faq_enabled'))
                        <li><a href="#faq">FAQ</a></li>
                    @endif
                </ul>
            </div>

            <div class="footer-col">
                <h3>Kontak</h3>
                <ul>
                    @if ($email)
                        <li><a href="mailto:{{ $email }}">{{ $email }}</a></li>
                    @endif
                    @if ($phone)
                        <li><a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}">{{ $phone }}</a></li>
                    @endif
                    @if ($address)
                        <li><span>{{ $address }}</span></li>
                    @endif
                    <li><a href="{{ route('admin.login') }}">Masuk</a></li>
                    <li><a href="{{ route('register') }}">Daftar</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <span>&copy; {{ date('Y') }} {{ csetting('company_name') }}. Seluruh data bersifat internal.</span>
            <span>{{ csetting('footer_note') }}</span>
        </div>
    </div>
</footer>
