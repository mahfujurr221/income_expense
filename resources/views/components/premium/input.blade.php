@props([
    'label' => null,
    'name' => null,
    'value' => '',
    'type' => 'text',
    'placeholder' => '',
    'required' => false,
    'readonly' => false,
    'id' => null,
])

<div {{ $attributes->merge(['class' => 'mb-3']) }}>
    @if ($label)
        <label class="form-label small fw-bold text-muted text-uppercase mb-2">{{ $label }} @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
    <input type="{{ $type }}" name="{{ $name }}"
        @if ($id) id="{{ $id }}" @endif value="{{ $value }}"
        class="form-control shadow-none border-light bg-light rounded-3" placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }} {{ $readonly ? 'readonly' : '' }}>
</div>
