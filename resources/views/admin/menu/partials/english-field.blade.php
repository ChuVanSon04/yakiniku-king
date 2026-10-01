@php
    $fieldId = str_replace(['[', ']'], '-', $name);
    $fieldType = $type ?? 'text';
@endphp

<div style="margin-bottom: {{ $margin ?? '15px' }};">
    <label for="{{ $fieldId }}">{{ $label }} (English)</label>

    @if ($fieldType === 'textarea')
        <textarea
            id="{{ $fieldId }}"
            name="{{ $name }}"
            rows="{{ $rows ?? 4 }}"
            style="width:100%; padding:10px;"
        >{{ old($name, $value ?? '') }}</textarea>
    @else
        <input
            id="{{ $fieldId }}"
            type="text"
            name="{{ $name }}"
            value="{{ old($name, $value ?? '') }}"
            style="width:100%; padding:10px;"
        >
    @endif
</div>