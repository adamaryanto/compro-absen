<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public $timestamps = true;

    /** @var array<string, string|null>|null */
    protected static ?array $memo = null;

    public static function allValues(): array
    {
        if (static::$memo !== null) {
            return static::$memo;
        }

        $stored = Cache::rememberForever('compro.settings', function () {
            return static::query()->pluck('value', 'key')->all();
        });

        return static::$memo = $stored;
    }

    public static function get(string $key, ?string $default = null): ?string
    {
        $values = static::allValues();

        if (array_key_exists($key, $values)) {
            return $values[$key];
        }

        if ($default !== null) {
            return $default;
        }

        foreach (config('compro.groups', []) as $group) {
            if (isset($group['fields'][$key])) {
                return $group['fields'][$key]['default'] ?? null;
            }
        }

        return null;
    }

    public static function put(string $key, ?string $value): void
    {
        static::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        static::flush();
    }

    public static function setMany(array $pairs): void
    {
        foreach ($pairs as $key => $value) {
            static::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }

        static::flush();
    }

    public static function flush(): void
    {
        static::$memo = null;
        Cache::forget('compro.settings');
    }

    /**
     * Resolve an uploaded brand file, a public path, or an absolute URL.
     */
    public static function media(?string $path): ?string
    {
        if (! $path) {
            return null;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }

        if (str_starts_with($path, 'storage/')) {
            return asset($path);
        }

        return asset(ltrim($path, '/'));
    }

    public static function uploadMedia($file, string $folder = 'brand'): string
    {
        $name = $file->store($folder, 'public');

        return 'storage/'.$name;
    }
}
