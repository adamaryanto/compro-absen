<?php

namespace Tests\Feature;

use App\Models\Faq;
use App\Models\Highlight;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SiteTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_home_page_renders_seeded_content(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Absensi rapi.');
        $response->assertSee('Gaji tepat waktu.');
        $response->assertSee('Enam modul, satu alur kerja.');

        $this->assertTrue(Highlight::active()->exists());
        $this->assertTrue(Faq::active()->exists());
    }

    public function test_disabled_section_is_hidden(): void
    {
        Setting::put('section_faq_enabled', '0');

        $this->get('/')->assertOk()->assertDontSee('Pertanyaan yang sering muncul.');
    }

    public function test_pricing_section_renders_and_cta_is_removed(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('Mulai gratis, naikkan saat tim siap')
            ->assertSee('Rp 150.000')
            ->assertSee('Daftar')
            ->assertSee('Masuk')
            ->assertDontSee('Siap memindahkan rekap absen ke satu tempat?')
            ->assertDontSee('Pratinjau panel admin, seluruh data contoh')
            ->assertDontSee('href="http://localhost"');
    }

    public function test_login_and_register_pages_render(): void
    {
        $this->get('/admin/login')->assertOk()->assertSee('Masuk ke absenku')
            ->assertSee('Belum punya akun?')->assertDontSee('Dilindungi oleh')->assertDontSee('Hubungi admin');
        $this->get('/register')->assertOk()->assertSee('Buat akun absenku')
            ->assertDontSee('Dilindungi oleh')->assertDontSee('Hubungi admin');
    }

    public function test_hero_has_separate_login_and_register_buttons(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('href="' . route('admin.login') . '"', false)
            ->assertSee('href="' . route('register') . '"', false);
    }

    public function test_page_content_uses_saved_settings(): void
    {
        Setting::put('hero_title', 'Kehadiran tercatat.');

        $this->get('/')->assertSee('Kehadiran tercatat.');
    }

    public function test_unknown_admin_collection_returns_404(): void
    {
        $user = \App\Models\User::firstOrFail();

        $this->actingAs($user)->get('/admin/tidak-ada')->assertNotFound();
    }
}
