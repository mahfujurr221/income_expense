@props([
    'title' => null,
    'icon' => null,
    'bodyClass' => 'p-4',
    'headerClass' => 'bg-white border-bottom-0 pt-4 px-4',
])

<div {{ $attributes->merge(['class' => 'card border-0 shadow-sm rounded-4']) }}>
    @if ($title || isset($header))
        <div class="{{ $headerClass }}">
            <div class="d-flex justify-content-between align-items-center">
                @if ($title)
                    <h5 class="fw-bold mb-0">
                        @if ($icon)
                            <i class="{{ $icon }} me-2 text-primary opacity-75"></i>
                        @endif
                        {{ $title }}
                    </h5>
                @endif
                {{ $header ?? '' }}
            </div>
        </div>
    @endif

    <div class="card-body {{ $bodyClass }}">
        {{ $slot }}
    </div>

    @if (isset($footer))
        <div class="card-footer bg-light border-0 p-3">
            {{ $footer }}
        </div>
    @endif
</div>
