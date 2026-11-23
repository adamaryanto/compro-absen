<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    protected function definition(string $type): array
    {
        $collections = config('compro.collections');

        abort_unless(isset($collections[$type]), 404);

        return $collections[$type] + ['key' => $type];
    }

    public function index(string $type)
    {
        $definition = $this->definition($type);
        $model = $definition['model'];
        $items = $model::query()
            ->orderBy($definition['order'] ?? 'sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.collection.index', compact('definition', 'items', 'type'));
    }

    public function create(string $type)
    {
        $definition = $this->definition($type);
        $model = $definition['model'];
        $item = new $model;

        foreach ($definition['fields'] as $field => $settings) {
            if (array_key_exists('default', $settings)) {
                $item->{$field} = $settings['default'];
            }
        }

        return view('admin.collection.form', compact('definition', 'item', 'type'));
    }

    public function store(string $type, Request $request)
    {
        $definition = $this->definition($type);
        $model = $definition['model'];
        $item = new $model;
        $this->save($item, $definition, $request);

        return redirect()
            ->route('admin.collection.index', $type)
            ->with('status', ucfirst($definition['singular']).' baru ditambahkan.');
    }

    public function edit(string $type, int $id)
    {
        $definition = $this->definition($type);
        $model = $definition['model'];
        $item = $model::findOrFail($id);

        return view('admin.collection.form', compact('definition', 'item', 'type'));
    }

    public function update(string $type, int $id, Request $request)
    {
        $definition = $this->definition($type);
        $model = $definition['model'];
        $item = $model::findOrFail($id);
        $this->save($item, $definition, $request);

        return redirect()
            ->route('admin.collection.index', $type)
            ->with('status', 'Perubahan disimpan.');
    }

    public function destroy(string $type, int $id)
    {
        $definition = $this->definition($type);
        $model = $definition['model'];
        $model::findOrFail($id)->delete();

        return redirect()
            ->route('admin.collection.index', $type)
            ->with('status', 'Data dihapus.');
    }

    protected function save($item, array $definition, Request $request): void
    {
        $rules = [];
        $attributes = [];

        foreach ($definition['fields'] as $field => $settings) {
            $rules[$field] = $settings['rules'] ?? ['nullable', 'string', 'max:1000'];
            $attributes[$field] = mb_strtolower($settings['label'] ?? $field);
        }

        $validated = $request->validate($rules, [], $attributes);

        foreach ($definition['fields'] as $field => $settings) {
            if ($settings['type'] === 'checkbox') {
                $item->{$field} = $request->boolean($field);
            } elseif ($settings['type'] === 'number') {
                $item->{$field} = (int) ($validated[$field] ?? 0);
            } else {
                $value = $validated[$field] ?? null;
                $item->{$field} = is_string($value) ? trim($value) : $value;
            }
        }

        $item->save();
    }
}
