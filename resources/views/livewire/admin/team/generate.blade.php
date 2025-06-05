<form>
    <div class="d-flex gap-2 ms-auto align-items-center">
        <span>Team Size</span>
        <select class="form-select form-select-sm" wire:model.live="teamSize" aria-label="Default select example" style="width: 100px">
            @for($i = 1; $i <= 13; $i++)
                <option value="{{ $i }}" @selected(session('teamSize') == $i)>{{ $i }}</option>
            @endfor
        </select>
        <x-modal class="btn-secondary text-light">
            <x-slot:label>Generate</x-slot:label>
            <p>Generate team</p>
            <div class="d-flex justify-content-end gap-2 mt-3">
                <x-button wire="close" class="btn-outline-primary" width="80px">No</x-button>
                <x-button type="button" wire="roll" class="btn-primary" width="80px">Yes</x-button>
            </div>
        </x-modal>
    </div>
</form>