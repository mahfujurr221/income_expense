@props(['action', 'method' => 'GET', 'showPrint' => true, 'printSelector' => '.table', 'printTitle' => 'Report'])

<x-premium.card bodyClass="p-3" class="mb-3">
    <form action="{{ $action }}" method="{{ $method }}">
        <div class="row g-3 align-items-center py-2">
            {{ $slot }}
            <div class="col-md-auto d-flex gap-2 ms-auto">
                {{ $extraButtons ?? '' }}
                <button type="submit" class="btn btn-primary btn-sm rounded-3 shadow-sm">
                    <i class="bx bx-search"></i>
                </button>
                <a href="{{ $action }}" class="btn btn-light btn-sm rounded-3 border shadow-sm" title="Reset">
                    <i class="bx bx-refresh"></i>
                </a>
                @if ($showPrint)
                    <button type="button" class="btn btn-secondary btn-sm rounded-3 shadow-sm"
                        onclick='printTable(@json($printSelector), @json($printTitle))'>
                        <i class="bx bx-printer"></i>
                    </button>
                @endif
            </div>
        </div>
    </form>
</x-premium.card>
