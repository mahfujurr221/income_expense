@props(['id', 'title', 'size' => 'modal-dialog-centered', 'gradient' => false])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}-label" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog {{ $size }}">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            {{-- Header --}}
            <div class="modal-header {{ $gradient ? 'bg-primary text-white p-4 border-0' : 'bg-light border-bottom p-3' }}">
                <h5 class="modal-title fw-bold m-0 {{ $gradient ? 'text-white' : 'text-dark' }}" id="{{ $id }}-label">
                    {{ $title }}
                </h5>
                <button type="button" class="btn-close {{ $gradient ? 'btn-close-white' : '' }}" 
                    data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- Body --}}
            <div class="modal-body p-0">
                {{-- Dynamic Summary Wrapper --}}
                <div id="{{ $id }}-summary-wrapper">
                    @if (isset($summary))
                        <div class="p-4 border-bottom bg-light">
                            {{ $summary }}
                        </div>
                    @endif
                </div>

                {{-- Actual Content Slot (Loader + Partial Content) --}}
                <div id="{{ $id }}-content-wrapper">
                    {{ $slot }}
                </div>
            </div>

            {{-- Optional Footer --}}
            @if (isset($footer))
                <div class="modal-footer border-top bg-light p-3">
                    {{ $footer }}
                </div>
            @endif
        </div>
    </div>
</div>
