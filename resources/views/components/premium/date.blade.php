@props(['label' => null, 'name' => null, 'value' => date('Y-m-d'), 'required' => false])

<div {{ $attributes->merge(['class' => 'mb-3']) }}>
    @if ($label)
        <label class="form-label small fw-bold text-muted text-uppercase mb-2">{{ $label }} @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
    <input type="date" name="{{ $name }}" value="{{ $value }}"
        class="form-control shadow-none border-light bg-light rounded-3" {{ $required ? 'required' : '' }}>
</div>
