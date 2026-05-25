@props(['label' => null, 'name' => null, 'isSelect2' => false, 'id' => null, 'required' => false])

<div {{ $attributes->merge(['class' => 'mb-3']) }}>
    @if ($label)
        <label class="form-label small fw-bold text-muted text-uppercase mb-2">{{ $label }} @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif
    <select name="{{ $name }}" @if ($id) id="{{ $id }}" @endif
        {{ $attributes->merge(['class' => 'form-select border-light bg-light rounded-3 shadow-none' . ($isSelect2 ? ' select2' : '')]) }}
        {{ $required ? 'required' : '' }}>
        {{ $slot }}
    </select>
</div>
