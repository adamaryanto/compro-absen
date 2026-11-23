<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function edit()
    {
        $groups = config('compro.groups');

        return view('admin.settings', compact('groups'));
    }

    public function update(Request $request)
    {
        $groups = config('compro.groups');
        $rules = [];
        $attributes = [];

        foreach ($groups as $group) {
            foreach ($group['fields'] as $key => $field) {
                $rules[$key] = match ($field['type']) {
                    'checkbox' => ['nullable', 'boolean'],
                    'email' => ['nullable', 'email', 'max:255'],
                    'url' => ['nullable', 'url', 'max:2048'],
                    'textarea' => ['nullable', 'string', 'max:20000'],
                    default => ['nullable', 'string', 'max:5000'],
                };
                $attributes[$key] = mb_strtolower($field['label']);
            }
        }

        $validated = $request->validate($rules, [], $attributes);

        $pairs = [];
        foreach ($groups as $group) {
            foreach ($group['fields'] as $key => $field) {
                $pairs[$key] = $field['type'] === 'checkbox'
                    ? ($request->boolean($key) ? '1' : '0')
                    : (string) ($validated[$key] ?? '');
            }
        }

        DB::transaction(fn () => Setting::setMany($pairs));

        return redirect()
            ->route('admin.settings.edit')
            ->with('status', 'Konten halaman disimpan.');
    }
}
