<?php

use App\Models\Setting;

if (! function_exists('csetting')) {
    /**
     * Ambil nilai pengaturan situs (dengan fallback ke default di config).
     */
    function csetting(string $key, ?string $default = null): ?string
    {
        return Setting::get($key, $default);
    }
}

if (! function_exists('cmedia')) {
    /**
     * Ubah path logo/media menjadi URL yang bisa dipakai di <img>.
     */
    function cmedia(?string $path, ?string $fallback = 'images/logo.svg'): ?string
    {
        return Setting::media($path ?: $fallback);
    }
}

if (! function_exists('cta_url')) {
    /**
     * Tautan CTA; kalau kosong pakai URL aplikasi absen.
     */
    function cta_url(string $key): string
    {
        $value = trim((string) csetting($key));

        if ($value !== '') {
            return $value;
        }

        return '#harga';
    }
}

if (! function_exists('text_lines')) {
    /**
     * Pecah textarea "satu poin per baris" menjadi array bersih.
     */
    function text_lines(?string $text): array
    {
        if (! $text) {
            return [];
        }

        return collect(preg_split('/\r\n|\r|\n/', $text))
            ->map(fn ($line) => trim($line))
            ->filter()
            ->values()
            ->all();
    }
}

if (! function_exists('is_on')) {
    function is_on(string $key, bool $default = true): bool
    {
        $value = csetting($key);

        if ($value === null || $value === '') {
            return $default;
        }

        return $value === '1';
    }
}
