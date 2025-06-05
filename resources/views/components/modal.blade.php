<div x-data="{ open: false }">
    <button x-on:click="open = true" type="button" class="btn btn-outline-secondary btn-sm {{ $class }}">{{ $label }}</button>
    <div x-show="open">
        <div class="position-fixed top-0 bottom-0 start-0 end-0 bg-dark bg-opacity-50 d-flex align-items-center justify-content-center z-3" x-cloak>
            <div x-on:click.away="open = false" class="bg-white p-3 rounded shadow-lg" style="width: 400px">
                {{ $slot }}
            </div>
        </div>
    </div>
</div> 