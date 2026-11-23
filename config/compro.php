<?php

use App\Models\Faq;
use App\Models\Highlight;
use App\Models\ProductModule;
use App\Models\Stat;
use App\Models\Step;

return [

    /*
    |--------------------------------------------------------------------------
    | Akun admin awal
    |--------------------------------------------------------------------------
    | Bisa diisi lewat variabel lingkungan sebelum migrate --seed.
    */
    'admin' => [
        'email' => env('ADMIN_EMAIL', 'admin@example.com'),
        'password' => env('ADMIN_PASSWORD', 'password'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Default palette
    |--------------------------------------------------------------------------
    | Disimpan di tabel settings saat seeder dijalankan. Admin bisa
    | mengubahnya lewat /admin/tampilan.
    */
    'palette' => [
        'color_primary' => ['label' => 'Biru utama', 'default' => '#0B3D91'],
        'color_primary_dark' => ['label' => 'Biru gelap', 'default' => '#061F4E'],
        'color_accent' => ['label' => 'Biru aksen', 'default' => '#2F5FE0'],
        'color_ink' => ['label' => 'Tinta teks', 'default' => '#0E1A2B'],
        'color_paper' => ['label' => 'Latar lembut', 'default' => '#F4F3EF'],
        'color_line' => ['label' => 'Garis', 'default' => '#E2E1DB'],
        'color_muted' => ['label' => 'Teks sekunder', 'default' => '#5C6B80'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Field konten (tabel settings)
    |--------------------------------------------------------------------------
    */
    'groups' => [
        'identitas' => [
            'label' => 'Identitas',
            'hint' => 'Nama produk, perusahaan, dan tautan ke aplikasi absen.',
            'fields' => [
                'brand_name' => ['label' => 'Nama produk', 'type' => 'text', 'default' => 'absenku', 'help' => 'Tampil di header, footer, dan judul tab.'],
                'brand_tagline' => ['label' => 'Tagline produk', 'type' => 'text', 'default' => 'Absensi & Payroll'],
                'company_name' => ['label' => 'Nama perusahaan', 'type' => 'text', 'default' => 'Nama Perusahaan'],
                'app_url' => ['label' => 'URL aplikasi absen', 'type' => 'url', 'default' => 'http://localhost', 'help' => 'Tujuan tombol "Masuk daftar".'],
                'site_title' => ['label' => 'Judul halaman (SEO)', 'type' => 'text', 'default' => 'absenku — Absensi, Jadwal, dan Payroll'],
                'site_description' => ['label' => 'Deskripsi halaman (SEO)', 'type' => 'textarea', 'default' => 'Satu sistem untuk absensi fingerprint, jadwal shift, lembur, dan payroll.', 'rows' => 3],
            ],
        ],

        'hero' => [
            'label' => 'Hero',
            'hint' => 'Bagian pertama yang dilihat pengunjung.',
            'fields' => [
                'hero_eyebrow' => ['label' => 'Label kecil di atas judul', 'type' => 'text', 'default' => 'Absensi dan payroll'],
                'hero_title' => ['label' => 'Judul baris 1', 'type' => 'text', 'default' => 'Absensi rapi.'],
                'hero_title_accent' => ['label' => 'Judul baris 2', 'type' => 'text', 'default' => 'Gaji tepat waktu.', 'help' => 'Baris kedua diberi warna aksen.'],
                'hero_subtitle' => ['label' => 'Deskripsi', 'type' => 'textarea', 'default' => 'Satu sistem untuk mencatat kehadiran dari mesin fingerprint, menyusun jadwal shift, dan menghitung gaji tanpa rekap manual di spreadsheet.', 'rows' => 4],
                'hero_cta_label' => ['label' => 'Tombol utama', 'type' => 'text', 'default' => 'Daftar'],
                'hero_cta_url' => ['label' => 'Tautan tombol utama', 'type' => 'url', 'default' => '', 'help' => 'Kosongkan untuk memakai halaman daftar.'],
                'hero_cta2_label' => ['label' => 'Tombol kedua', 'type' => 'text', 'default' => 'Masuk'],
                'hero_cta2_url' => ['label' => 'Tautan tombol kedua', 'type' => 'text', 'default' => '', 'help' => 'Kosongkan untuk memakai halaman masuk.'],
                'hero_note' => ['label' => 'Catatan kecil di bawah tombol', 'type' => 'text', 'default' => 'Untuk Admin HR, Kepala Pabrik, Owner, dan OS.'],
            ],
        ],

        'intro' => [
            'label' => 'Latar',
            'hint' => 'Bagian setelah hero. Jelaskan masalah yang diselesaikan.',
            'fields' => [
                'section_intro_enabled' => ['label' => 'Tampilkan bagian ini', 'type' => 'checkbox', 'default' => '1'],
                'intro_eyebrow' => ['label' => 'Label bagian', 'type' => 'text', 'default' => 'Latar'],
                'intro_title' => ['label' => 'Judul', 'type' => 'text', 'default' => 'Rekap absen tanpa perlu lembur.'],
                'intro_body' => ['label' => 'Paragraf', 'type' => 'textarea', 'default' => 'Data mesin fingerprint, jadwal shift, lembur, izin, dan potongan sering berakhir di lima file Excel berbeda. Di sini semuanya bertemu di satu periode payroll yang bisa diperiksa baris per baris.', 'rows' => 5],
                'intro_points' => ['label' => 'Poin (satu per baris)', 'type' => 'textarea', 'default' => "Tarik data langsung dari mesin fingerprint di tiap lokasi.\nSandingkan jadwal, realisasi, dan izin dalam satu layar.\nSlip gaji dibuat dari data yang sama, bukan salinan.", 'rows' => 5],
            ],
        ],

        'benefits' => [
            'label' => 'Keunggulan',
            'hint' => 'Judul bagian. Daftar kartunya dikelola di menu Keunggulan.',
            'fields' => [
                'section_benefits_enabled' => ['label' => 'Tampilkan bagian ini', 'type' => 'checkbox', 'default' => '1'],
                'benefits_eyebrow' => ['label' => 'Label bagian', 'type' => 'text', 'default' => 'Keunggulan'],
                'benefits_title' => ['label' => 'Judul', 'type' => 'text', 'default' => 'Yang membuat rekap berhenti menyakitkan.'],
                'benefits_note' => ['label' => 'Catatan pendamping', 'type' => 'textarea', 'default' => 'Empat hal yang paling sering diminta admin HR saat tutup periode.', 'rows' => 3],
            ],
        ],

        'showcase' => [
            'label' => 'Sorotan produk',
            'hint' => 'Bagian gelap dengan tampilan ponsel dan daftar poin.',
            'fields' => [
                'section_showcase_enabled' => ['label' => 'Tampilkan bagian ini', 'type' => 'checkbox', 'default' => '1'],
                'showcase_eyebrow' => ['label' => 'Label bagian', 'type' => 'text', 'default' => 'Realisasi'],
                'showcase_title' => ['label' => 'Judul', 'type' => 'text', 'default' => 'Dari mesin absen ke slip gaji, tanpa pindah aplikasi.'],
                'showcase_body' => ['label' => 'Paragraf', 'type' => 'textarea', 'default' => 'Setiap pagi data mesin ditarik. Siangnya admin bisa memeriksa kehadiran per bagian. Menjelang tutup periode, rekap sudah siap dipakai finance.', 'rows' => 5],
                'showcase_points' => ['label' => 'Poin (satu per baris)', 'type' => 'textarea', 'default' => "Verifikasi kehadiran harian per bagian dan lokasi.\nKoreksi terpusat dengan jejak persetujuan.\nKunci periode sebelum slip dicetak.", 'rows' => 5],
                'showcase_cta_label' => ['label' => 'Label tombol', 'type' => 'text', 'default' => 'Buka realisasi'],
                'showcase_cta_url' => ['label' => 'Tautan tombol', 'type' => 'url', 'default' => '', 'help' => 'Kosongkan untuk memakai URL aplikasi.'],
            ],
        ],

        'modules' => [
            'label' => 'Modul',
            'hint' => 'Judul bagian. Daftar modul dikelola di menu Modul.',
            'fields' => [
                'section_modules_enabled' => ['label' => 'Tampilkan bagian ini', 'type' => 'checkbox', 'default' => '1'],
                'modules_eyebrow' => ['label' => 'Label bagian', 'type' => 'text', 'default' => 'Modul'],
                'modules_title' => ['label' => 'Judul', 'type' => 'text', 'default' => 'Enam modul, satu alur kerja.'],
                'modules_note' => ['label' => 'Catatan pendamping', 'type' => 'textarea', 'default' => 'Semua modul memakai data karyawan dan periode yang sama.', 'rows' => 3],
            ],
        ],

        'steps' => [
            'label' => 'Alur',
            'hint' => 'Judul bagian. Langkah-langkahnya dikelola di menu Langkah.',
            'fields' => [
                'section_steps_enabled' => ['label' => 'Tampilkan bagian ini', 'type' => 'checkbox', 'default' => '1'],
                'steps_eyebrow' => ['label' => 'Label bagian', 'type' => 'text', 'default' => 'Alur'],
                'steps_title' => ['label' => 'Judul', 'type' => 'text', 'default' => 'Dari mesin ke slip, lima langkah.'],
                'steps_note' => ['label' => 'Catatan pendamping', 'type' => 'textarea', 'default' => 'Alur yang sama dipakai di setiap periode payroll.', 'rows' => 3],
            ],
        ],

        'stats' => [
            'label' => 'Statistik',
            'hint' => 'Judul bagian. Angkanya dikelola di menu Statistik.',
            'fields' => [
                'section_stats_enabled' => ['label' => 'Tampilkan bagian ini', 'type' => 'checkbox', 'default' => '1'],
                'stats_eyebrow' => ['label' => 'Label bagian', 'type' => 'text', 'default' => 'Angka yang penting'],
                'stats_title' => ['label' => 'Judul', 'type' => 'text', 'default' => 'Tiga hal yang tidak perlu diulang lagi.'],
            ],
        ],

        'faq' => [
            'label' => 'FAQ',
            'hint' => 'Judul bagian. Daftar tanya-jawab dikelola di menu FAQ.',
            'fields' => [
                'section_faq_enabled' => ['label' => 'Tampilkan bagian ini', 'type' => 'checkbox', 'default' => '1'],
                'faq_eyebrow' => ['label' => 'Label bagian', 'type' => 'text', 'default' => 'Tanya jawab'],
                'faq_title' => ['label' => 'Judul', 'type' => 'text', 'default' => 'Pertanyaan yang sering muncul.'],
                'faq_note' => ['label' => 'Catatan pendamping', 'type' => 'textarea', 'default' => 'Belum terjawab? Hubungi admin HR lewat aplikasi.', 'rows' => 3],
            ],
        ],

        'kontak' => [
            'label' => 'Kontak & footer',
            'hint' => 'Informasi kontak yang tampil di footer.',
            'fields' => [
                'contact_email' => ['label' => 'Email kontak (opsional)', 'type' => 'email', 'default' => ''],
                'contact_phone' => ['label' => 'Telepon kontak (opsional)', 'type' => 'text', 'default' => ''],
                'contact_address' => ['label' => 'Alamat (opsional)', 'type' => 'text', 'default' => ''],
                'footer_note' => ['label' => 'Catatan footer', 'type' => 'text', 'default' => 'Sistem internal untuk operasional pabrik.'],
            ],
        ],

        'harga' => [
            'label' => 'Harga',
            'hint' => 'Judul bagian dan isi tiga paket. Daftar fitur ditulis satu per baris.',
            'fields' => [
                'section_pricing_enabled' => ['label' => 'Tampilkan bagian ini', 'type' => 'checkbox', 'default' => '1'],
                'pricing_eyebrow' => ['label' => 'Label bagian', 'type' => 'text', 'default' => 'Harga'],
                'pricing_title' => ['label' => 'Judul', 'type' => 'text', 'default' => 'Mulai gratis, naikkan saat tim siap'],
                'pricing_subtitle' => ['label' => 'Deskripsi', 'type' => 'textarea', 'default' => 'Mulai gratis buat 5 orang. Naik ke Pro kalau butuh Face ID dan geofence.', 'rows' => 2],

                'free_name' => ['label' => 'Nama paket Free', 'type' => 'text', 'default' => 'Free'],
                'free_desc' => ['label' => 'Deskripsi Free', 'type' => 'text', 'default' => 'Cocok untuk pilot kecil dan absensi QR dasar.'],
                'free_price' => ['label' => 'Harga Free', 'type' => 'text', 'default' => 'Gratis'],
                'free_features' => ['label' => 'Fitur Free', 'type' => 'textarea', 'default' => "Absensi QR + jadwal kehadiran\nInvite rekan\nDashboard & riwayat dasar", 'rows' => 4],
                'free_excluded' => ['label' => 'Tidak termasuk Free', 'type' => 'textarea', 'default' => "Tanpa Face ID\nTanpa geofence dan IP whitelist\nTanpa cuti, izin, dan ekspor", 'rows' => 4],
                'free_cta' => ['label' => 'Tombol Free', 'type' => 'text', 'default' => 'Mulai gratis'],
                'free_url' => ['label' => 'Tautan Free', 'type' => 'url', 'default' => '', 'help' => 'Kosongkan untuk memakai URL aplikasi.'],

                'pro_name' => ['label' => 'Nama paket Pro', 'type' => 'text', 'default' => 'Pro'],
                'pro_badge' => ['label' => 'Label paket Pro', 'type' => 'text', 'default' => 'Paling cocok'],
                'pro_desc' => ['label' => 'Deskripsi Pro', 'type' => 'text', 'default' => 'Untuk tim yang butuh guardrail operasional dan laporan lengkap.'],
                'pro_price' => ['label' => 'Harga Pro', 'type' => 'text', 'default' => 'Rp 150.000'],
                'pro_period' => ['label' => 'Periode harga Pro', 'type' => 'text', 'default' => '/ workspace / 30 hari'],
                'pro_features' => ['label' => 'Fitur Pro', 'type' => 'textarea', 'default' => "Hingga 50 member, 5 device QR\nGeofence + IP whitelist\nFace ID (izin admin tetap utuh)\nLeave management + team management\nExport laporan + invite entry", 'rows' => 6],
                'pro_cta' => ['label' => 'Tombol Pro', 'type' => 'text', 'default' => 'Pilih Pro'],
                'pro_url' => ['label' => 'Tautan Pro', 'type' => 'url', 'default' => '', 'help' => 'Kosongkan untuk memakai URL aplikasi.'],

                'enterprise_name' => ['label' => 'Nama paket Enterprise', 'type' => 'text', 'default' => 'Enterprise'],
                'enterprise_desc' => ['label' => 'Deskripsi Enterprise', 'type' => 'text', 'default' => 'Untuk organisasi yang butuh skala dan penyesuaian layanan.'],
                'enterprise_price' => ['label' => 'Harga Enterprise', 'type' => 'text', 'default' => 'Hubungi kami'],
                'enterprise_features' => ['label' => 'Fitur Enterprise', 'type' => 'textarea', 'default' => "Semua di Pro, plus:\nMember & device tanpa batas\nPriority support\nFeature-request channel\nCustom config / integration", 'rows' => 6],
                'enterprise_cta' => ['label' => 'Tombol Enterprise', 'type' => 'text', 'default' => 'Hubungi kami'],
                'enterprise_url' => ['label' => 'Tautan Enterprise', 'type' => 'url', 'default' => '', 'help' => 'Kosongkan untuk memakai URL aplikasi.'],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Koleksi konten berulang
    |--------------------------------------------------------------------------
    */
    'collections' => [
        'keunggulan' => [
            'label' => 'Keunggulan',
            'singular' => 'keunggulan',
            'model' => Highlight::class,
            'order' => 'sort_order',
            'fields' => [
                'title' => ['label' => 'Judul', 'type' => 'text', 'rules' => 'required|string|max:120'],
                'description' => ['label' => 'Deskripsi', 'type' => 'textarea', 'rules' => 'required|string|max:400', 'rows' => 4],
                'icon' => [
                    'label' => 'Ikon',
                    'type' => 'select',
                    'rules' => 'required|in:fingerprint,calendar,calculator,receipt,clock,users,shield',
                    'options' => [
                        'fingerprint' => 'Sidik jari',
                        'calendar' => 'Kalender',
                        'calculator' => 'Kalkulator',
                        'receipt' => 'Slip / nota',
                        'clock' => 'Jam',
                        'users' => 'Karyawan',
                        'shield' => 'Perisai / akses',
                    ],
                ],
                'sort_order' => ['label' => 'Urutan', 'type' => 'number', 'rules' => 'nullable|integer|min:0|max:999', 'default' => 0],
                'is_active' => ['label' => 'Tampilkan di halaman', 'type' => 'checkbox', 'rules' => 'nullable|boolean', 'default' => 1],
            ],
        ],

        'modul' => [
            'label' => 'Modul',
            'singular' => 'modul',
            'model' => ProductModule::class,
            'order' => 'sort_order',
            'fields' => [
                'name' => ['label' => 'Nama modul', 'type' => 'text', 'rules' => 'required|string|max:80'],
                'description' => ['label' => 'Deskripsi', 'type' => 'textarea', 'rules' => 'required|string|max:400', 'rows' => 3],
                'meta' => ['label' => 'Label kecil (opsional)', 'type' => 'text', 'rules' => 'nullable|string|max:40', 'help' => 'Contoh: Inti, Opsional, Finance.'],
                'sort_order' => ['label' => 'Urutan', 'type' => 'number', 'rules' => 'nullable|integer|min:0|max:999', 'default' => 0],
                'is_active' => ['label' => 'Tampilkan di halaman', 'type' => 'checkbox', 'rules' => 'nullable|boolean', 'default' => 1],
            ],
        ],

        'langkah' => [
            'label' => 'Langkah',
            'singular' => 'langkah',
            'model' => Step::class,
            'order' => 'sort_order',
            'fields' => [
                'phase' => ['label' => 'Nomor / fase', 'type' => 'text', 'rules' => 'required|string|max:10', 'help' => 'Contoh: 01'],
                'title' => ['label' => 'Judul langkah', 'type' => 'text', 'rules' => 'required|string|max:120'],
                'description' => ['label' => 'Deskripsi', 'type' => 'textarea', 'rules' => 'required|string|max:400', 'rows' => 3],
                'sort_order' => ['label' => 'Urutan', 'type' => 'number', 'rules' => 'nullable|integer|min:0|max:999', 'default' => 0],
                'is_active' => ['label' => 'Tampilkan di halaman', 'type' => 'checkbox', 'rules' => 'nullable|boolean', 'default' => 1],
            ],
        ],

        'faq' => [
            'label' => 'FAQ',
            'singular' => 'FAQ',
            'model' => Faq::class,
            'order' => 'sort_order',
            'fields' => [
                'question' => ['label' => 'Pertanyaan', 'type' => 'text', 'rules' => 'required|string|max:200'],
                'answer' => ['label' => 'Jawaban', 'type' => 'textarea', 'rules' => 'required|string|max:1200', 'rows' => 4],
                'sort_order' => ['label' => 'Urutan', 'type' => 'number', 'rules' => 'nullable|integer|min:0|max:999', 'default' => 0],
                'is_active' => ['label' => 'Tampilkan di halaman', 'type' => 'checkbox', 'rules' => 'nullable|boolean', 'default' => 1],
            ],
        ],

        'statistik' => [
            'label' => 'Statistik',
            'singular' => 'statistik',
            'model' => Stat::class,
            'order' => 'sort_order',
            'fields' => [
                'value' => ['label' => 'Angka / kata kunci', 'type' => 'text', 'rules' => 'required|string|max:20', 'help' => 'Contoh: 1×, 0, 6.'],
                'label' => ['label' => 'Keterangan', 'type' => 'text', 'rules' => 'required|string|max:80'],
                'sort_order' => ['label' => 'Urutan', 'type' => 'number', 'rules' => 'nullable|integer|min:0|max:999', 'default' => 0],
                'is_active' => ['label' => 'Tampilkan di halaman', 'type' => 'checkbox', 'rules' => 'nullable|boolean', 'default' => 1],
            ],
        ],
    ],

    'icons' => [
        'fingerprint', 'calendar', 'calculator', 'receipt', 'clock', 'users', 'shield',
    ],
];
