@php
    $type = $field['type'] ?? 'text';
    $id = 'field-' . $name;
    $oldValue = old($name, $value);
    $required = isset($field['rules']) && str_contains($field['rules'], 'required');
    $rows = $field['rows'] ?? 4;
@endphp

<div class="field {{ $type === 'checkbox' ? 'field--check' : '' }} {{ $type === 'textarea' ? 'field--full' : '' }} {{ ($field['full'] ?? false) ? 'field--full' : '' }}">
    @if ($type === 'checkbox')
        <input type="hidden" name="{{ $name }}" value="0">
        <input type="checkbox" id="{{ $id }}" name="{{ $name }}" value="1" @checked((string) $oldValue === '1' || $oldValue === true || $oldValue === 1)>
        <label for="{{ $id }}">
            {{ $field['label'] }}
            @if (! empty($field['help']))
                <span class="field-help" style="display:block">{{ $field['help'] }}</span>
            @endif
        </label>
    @else
        <label for="{{ $id }}">
            {{ $field['label'] }}
            @if ($required)
                <span class="req" aria-hidden="true">*</span>
            @endif
        </label>

        @if ($type === 'textarea')
            <textarea id="{{ $id }}" name="{{ $name }}" rows="{{ $rows }}" placeholder="{{ $field['placeholder'] ?? '' }}">{{ $oldValue }}</textarea>
        @elseif ($type === 'select')
            <select id="{{ $id }}" name="{{ $name }}">
                @foreach ($field['options'] ?? [] as $optionValue => $optionLabel)
                    <option value="{{ $optionValue }}" @selected((string) $oldValue === (string) $optionValue)>{{ $optionLabel }}</option>
                @endforeach
            </select>
        @elseif ($type === 'number')
            <input id="{{ $id }}" type="number" name="{{ $name }}" value="{{ $oldValue }}" min="0" max="999" step="1">
        @elseif ($type === 'color')
            <input id="{{ $id }}" type="color" name="{{ $name }}" value="{{ $oldValue }}">
        @else
            <input id="{{ $id }}" type="{{ $type }}" name="{{ $name }}" value="{{ $oldValue }}" placeholder="{{ $field['placeholder'] ?? '' }}" @if ($type === 'url') inputmode="url" @endif>
        @endif

        @if (! empty($field['help']))
            <p class="field-help">{{ $field['help'] }}</p>
        @endif

        @error($name)
            <p class="field-error">{{ $message }}</p>
        @enderror
    @endif
</div>
