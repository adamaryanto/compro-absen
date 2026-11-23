<?php

namespace Tests\Feature;

use App\Models\Faq;
use App\Models\Highlight;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_guests_are_redirected_to_login(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->get('/admin/konten')->assertRedirect('/admin/login');
    }

    public function test_seeded_admin_can_log_in(): void
    {
        $email = config('compro.admin.email');
        $password = config('compro.admin.password');
        $user = User::where('email', $email)->firstOrFail();

        $this->assertTrue(Hash::check($password, $user->password));

        $this->post('/admin/login', [
            'email' => $email,
            'password' => $password,
        ])->assertRedirect('/admin');

        $this->assertAuthenticatedAs($user);
    }

    public function test_wrong_password_is_rejected(): void
    {
        $this->from('/admin/login')->post('/admin/login', [
            'email' => config('compro.admin.email'),
            'password' => 'salah-total',
        ])->assertRedirect('/admin/login')->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_admin_can_update_page_content(): void
    {
        $user = User::firstOrFail();

        $this->actingAs($user)->post('/admin/konten', [
            'brand_name' => 'HRIS',
            'hero_title' => 'Absensi rapi.',
            'hero_title_accent' => 'Gaji tepat waktu.',
            'hero_cta_label' => 'Masuk',
            'section_intro_enabled' => '1',
            'section_benefits_enabled' => '1',
            'section_showcase_enabled' => '1',
            'section_modules_enabled' => '1',
            'section_steps_enabled' => '1',
            'section_stats_enabled' => '1',
            'section_faq_enabled' => '1',
            'section_cta_enabled' => '1',
        ])->assertRedirect('/admin/konten')->assertSessionHasNoErrors();

        $this->assertSame('Gaji tepat waktu.', Setting::get('hero_title_accent'));
    }

    public function test_admin_can_create_and_delete_a_highlight(): void
    {
        $user = User::firstOrFail();

        $this->actingAs($user)->post('/admin/keunggulan', [
            'title' => 'Absensi tanpa kertas',
            'description' => 'Semua rekap tersimpan di satu basis data.',
            'icon' => 'fingerprint',
            'sort_order' => 9,
            'is_active' => '1',
        ])->assertRedirect('/admin/keunggulan');

        $item = Highlight::where('title', 'Absensi tanpa kertas')->firstOrFail();
        $this->assertTrue($item->is_active);

        $this->actingAs($user)->delete('/admin/keunggulan/'.$item->id)
            ->assertRedirect('/admin/keunggulan');

        $this->assertModelMissing($item);
    }

    public function test_admin_can_hide_faq_without_deleting_it(): void
    {
        $user = User::firstOrFail();
        $faq = Faq::firstOrFail();

        $this->actingAs($user)->put('/admin/faq/'.$faq->id, [
            'question' => $faq->question,
            'answer' => $faq->answer,
            'sort_order' => 1,
        ])->assertRedirect('/admin/faq');

        $this->assertFalse($faq->fresh()->is_active);
    }
}
