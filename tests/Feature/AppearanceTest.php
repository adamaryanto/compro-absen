<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AppearanceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    private function palettePayload(array $overrides = []): array
    {
        $payload = [];

        foreach (array_keys(config('compro.palette')) as $key) {
            $payload[$key] = Setting::get($key, '#000000');
        }

        return array_merge($payload, $overrides);
    }

    public function test_admin_can_change_palette_colours(): void
    {
        $user = User::firstOrFail();

        $this->actingAs($user)
            ->post('/admin/tampilan', $this->palettePayload([
                'color_accent' => '#00c2a8',
            ]))
            ->assertRedirect('/admin/tampilan')
            ->assertSessionHasNoErrors();

        $this->assertSame('#00C2A8', Setting::get('color_accent'));
    }

    public function test_invalid_hex_colour_is_rejected(): void
    {
        $user = User::firstOrFail();

        $this->actingAs($user)
            ->from('/admin/tampilan')
            ->post('/admin/tampilan', $this->palettePayload([
                'color_accent' => 'kuning',
            ]))
            ->assertRedirect('/admin/tampilan')
            ->assertSessionHasErrors('color_accent');

        $this->assertNotSame('kuning', Setting::get('color_accent'));
    }

    public function test_admin_can_upload_a_logo(): void
    {
        Storage::fake('public');
        $user = User::firstOrFail();

        $this->actingAs($user)
            ->post('/admin/tampilan', $this->palettePayload([
                'logo' => UploadedFile::fake()->image('logo.png', 200, 200),
            ]))
            ->assertRedirect('/admin/tampilan')
            ->assertSessionHasNoErrors();

        $path = Setting::get('logo_path');
        $this->assertStringStartsWith('storage/', $path);
        Storage::disk('public')->assertExists(substr($path, 8));
    }

    public function test_admin_can_remove_logo(): void
    {
        $user = User::firstOrFail();

        $this->actingAs($user)
            ->post('/admin/tampilan', $this->palettePayload([
                'remove_logo' => '1',
            ]))
            ->assertRedirect('/admin/tampilan');

        $this->assertSame('', Setting::get('logo_path'));
    }

    public function test_guest_cannot_change_appearance(): void
    {
        $this->post('/admin/tampilan', $this->palettePayload())
            ->assertRedirect('/admin/login');
    }
}
