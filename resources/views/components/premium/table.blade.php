@props(['headers' => []])

<div class="table-responsive">
    <table {{ $attributes->merge(['class' => 'table table-hover align-middle mb-0']) }}>
        <thead class="bg-light">
            <tr>
                @foreach ($headers as $header)
                    <th class="py-3 border-0 text-muted small fw-bold uppercase @if (isset($header['class'])) {{ $header['class'] }} @endif"
                        @if (isset($header['style'])) style="{{ $header['style'] }}" @endif>
                        {{ $header['label'] ?? $header }}
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
        @if (isset($footer))
            <tfoot class="bg-dark fw-bold">
                {{ $footer }}
            </tfoot>
        @endif
    </table>
</div>
