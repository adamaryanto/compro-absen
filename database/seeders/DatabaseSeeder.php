<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Highlight;
use App\Models\ProductModule;
use App\Models\Setting;
use App\Models\Stat;
use App\Models\Step;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => config('compro.admin.email')],
            [
                'name' => 'Admin',
                'password' => Hash::make(config('compro.admin.password')),
            ]
        );

        $settings = [];

        foreach (config('compro.groups') as $group) {
            foreach ($group['fields'] as $key => $field) {
                $settings[$key] = (string) ($field['default'] ?? '');
            }
        }

        foreach (config('compro.palette') as $key => $color) {
            $settings[$key] = $color['default'];
        }

        $settings['logo_path'] = 'images/logo.svg';

        Setting::setMany($settings);

        $highlights = [
            ['title' => 'Absensi terkonsolidasi', 'description' => 'Tarik data dari beberapa mesin fingerprint dan cabang, lalu cocokkan otomatis dengan PIN karyawan.', 'icon' => 'fingerprint', 'sort_order' => 1],
            ['title' => 'Jadwal & shift', 'description' => 'Atur pola shift, hari kerja, dan toleransi keterlambatan per bagian tanpa file terpisah.', 'icon' => 'calendar', 'sort_order' => 2],
            ['title' => 'Rekap siap payroll', 'description' => 'Lembur, denda, potongan, dan bonus dihitung dari periode yang sudah diperiksa.', 'icon' => 'calculator', 'sort_order' => 3],
            ['title' => 'Slip & arsip', 'description' => 'Cetak slip per karyawan atau unduh rekap periode, lengkap dengan arsip per periode.', 'icon' => 'receipt', 'sort_order' => 4],
        ];

        foreach ($highlights as $row) {
            Highlight::updateOrCreate(['title' => $row['title']], $row + ['is_active' => true]);
        }

        $modules = [
            ['name' => 'Absensi', 'description' => 'Tarik data mesin, rekap harian, dan pemeriksaan kehadiran per bagian.', 'meta' => 'Inti', 'sort_order' => 1],
            ['name' => 'Jadwal', 'description' => 'Pola shift, hari libur, dan toleransi keterlambatan.', 'meta' => 'Inti', 'sort_order' => 2],
            ['name' => 'Lembur', 'description' => 'Pencatatan jam lembur dan persetujuan atasan.', 'meta' => 'Opsional', 'sort_order' => 3],
            ['name' => 'SIAC', 'description' => 'Sakit, izin, alfa, dan cuti dalam satu catatan.', 'meta' => 'HR', 'sort_order' => 4],
            ['name' => 'Payroll', 'description' => 'Periode gaji, komponen upah, dan rekap pengeluaran.', 'meta' => 'Finance', 'sort_order' => 5],
            ['name' => 'Slip Gaji', 'description' => 'Slip per karyawan, unduhan, dan arsip periode.', 'meta' => 'Finance', 'sort_order' => 6],
        ];

        foreach ($modules as $row) {
            ProductModule::updateOrCreate(['name' => $row['name']], $row + ['is_active' => true]);
        }

        $steps = [
            ['phase' => '01', 'title' => 'Hubungkan mesin', 'description' => 'Daftarkan mesin fingerprint dan tarik data karyawan.', 'sort_order' => 1],
            ['phase' => '02', 'title' => 'Susun jadwal', 'description' => 'Tentukan shift, bagian, dan aturan toleransi.', 'sort_order' => 2],
            ['phase' => '03', 'title' => 'Jalankan periode', 'description' => 'Realisasi harian diperiksa dan dikoreksi bila perlu.', 'sort_order' => 3],
            ['phase' => '04', 'title' => 'Hitung & kunci', 'description' => 'Lembur dan potongan masuk, lalu periode dikunci.', 'sort_order' => 4],
            ['phase' => '05', 'title' => 'Cetak slip', 'description' => 'Slip dibagikan dan arsip tersimpan per periode.', 'sort_order' => 5],
        ];

        foreach ($steps as $row) {
            Step::updateOrCreate(['phase' => $row['phase']], $row + ['is_active' => true]);
        }

        $stats = [
            ['value' => '1×', 'label' => 'Tarik data per mesin', 'sort_order' => 1],
            ['value' => '6', 'label' => 'Modul dalam satu sistem', 'sort_order' => 2],
            ['value' => '0', 'label' => 'Rekap manual di spreadsheet', 'sort_order' => 3],
        ];

        foreach ($stats as $row) {
            Stat::updateOrCreate(['label' => $row['label']], $row + ['is_active' => true]);
        }

        $faqs = [
            ['question' => 'Apakah harus mengganti mesin fingerprint?', 'answer' => 'Tidak. Sistem menarik data dari mesin yang sudah dipakai. Selama mesin bisa diakses jaringan, data kehadiran bisa ditarik dan dicocokkan dengan PIN karyawan.', 'sort_order' => 1],
            ['question' => 'Bisa dipakai lebih dari satu lokasi?', 'answer' => 'Bisa. Setiap mesin didaftarkan per lokasi, lalu rekap digabung dalam satu periode. Admin bisa memeriksa kehadiran per bagian maupun per lokasi.', 'sort_order' => 2],
            ['question' => 'Siapa saja yang bisa melihat data gaji?', 'answer' => 'Akses dibatasi per peran. Admin HR, Kepala Pabrik, Owner, dan OS punya cakupan menu yang berbeda. Data slip gaji tidak terbuka untuk semua pengguna.', 'sort_order' => 3],
            ['question' => 'Bagaimana kalau ada absen yang salah?', 'answer' => 'Admin dapat mengoreksi realisasi kehadiran. Perubahan tercatat pada periode berjalan dan bisa diperiksa sebelum slip dicetak.', 'sort_order' => 4],
            ['question' => 'Apakah slip bisa dicetak massal?', 'answer' => 'Bisa. Pilih periode, lalu cetak slip untuk satu karyawan atau seluruh karyawan sekaligus. Rekap pengeluaran tersedia untuk finance.', 'sort_order' => 5],
        ];

        foreach ($faqs as $row) {
            Faq::updateOrCreate(['question' => $row['question']], $row + ['is_active' => true]);
        }
    }
}
