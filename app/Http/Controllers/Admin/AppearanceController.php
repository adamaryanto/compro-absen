<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AppearanceController extends Controller
{
    public function edit()
    {
        return view('admin.appearance', [
            'palette' => config('compro.palette'),
        ]);
    }

    public function update(Request $request)
    {
        $palette = config('compro.palette');

        $rules = [
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'remove_logo' => ['nullable', 'boolean'],
        ];

        foreach (array_keys($palette) as $key) {
            $rules[$key] = ['required', 'regex:/^#[0-9A-Fa-f]{6}$/'];
        }

        $validated = $request->validate($rules, [
            'regex' => 'Gunakan format warna hex, contoh #0B3D91.',
            'logo.image' => 'Logo harus berupa gambar.',
            'logo.mimes' => 'Format logo: JPG, PNG, WEBP, atau SVG.',
        ]);

        $pairs = collect($palette)
            ->keys()
            ->mapWithKeys(fn ($key) => [$key => strtoupper($validated[$key])])
            ->all();

        if ($request->boolean('remove_logo')) {
            $old = (string) Setting::get('logo_path');
            if (str_starts_with($old, 'storage/')) {
                Storage::disk('public')->delete(substr($old, 8));
            }
            $pairs['logo_path'] = '';
        }

        if ($request->hasFile('logo')) {
            $old = (string) Setting::get('logo_path');
            if (str_starts_with($old, 'storage/')) {
                Storage::disk('public')->delete(substr($old, 8));
            }
            $pairs['logo_path'] = Setting::uploadMedia($request->file('logo'));
        }

        Setting::setMany($pairs);

        return redirect()
            ->route('admin.appearance.edit')
            ->with('status', 'Tampilan diperbarui.');
    }
}
