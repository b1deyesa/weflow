<form>
    <div class="d-flex gap-2 ms-auto align-items-center">
        <x-modal class="btn-secondary text-light">
            <x-slot:label>Generate</x-slot:label>
            <p>Generate match bracket</p>
            <table>
                <tr>
                    <td style="padding-right: 1em">Tournament type</td>
                    <td style="padding-bottom: .3em">
                        <select class="form-select form-select-sm" wire:model.live="type" aria-label="Default select example" style="width: 200px">
                            <option value="liga" disabled>Liga</option>
                            <option value="deadmatch">Deadmatch</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="padding-right: 1em">Start Match</td>
                    <td style="padding-bottom: .3em">
                        <input type="date" class="form-control form-control-sm" wire:model.live="start_match" style="width: 200px" />
                    </td>
                </tr>
            </table>
            <div style="overflow-y: auto; height: 200px; border: .8px solid #000000;" class=" mt-3">
                <table class="w-100">
                    <tr class="bg-secondary text-light" style="font-size: .85em">
                        <th class="px-2 py-1" style="border-right: .8px solid #ffffffCC;">Team</th>
                        <th class="px-2 py-1">Available</th>
                    </tr>
                    @foreach ($teams as $team)
                        <tr>
                            <td style="border: .8px solid #00000080; padding: 3px 5px" width="100%">
                                <div class="d-flex gap-2 align-items-center">
                                    <div style="width: 30px" class="d-flex justify-content-end">
                                        <img src="{{ asset('storage/Team/'. $team->logo) }}" style="height: 2em">
                                    </div>
                                    {{ $team->name }}
                                </div>
                            </td>
                            <td style="border: .8px solid #00000080; padding: 3px 5px">
                                <div class="d-flex gap-1" style="font-size: .8em">
                                    @foreach ([1 => 'M', 2 => 'T', 3 => 'W', 4 => 'T', 5 => 'F', 6 => 'S', 7 => 'S', 8 => 'Unavail'] as $key => $label)
                                        <input type="checkbox" value="{{ $key }}" wire:model.live="avail.{{ $team->id }}" class="btn-check" id="avail-{{ $team->id }}-{{ $key }}">
                                        <label class="btn btn-sm btn-outline-secondary @if ($loop->last) btn-outline-danger @endif" style="font-size: .85em; padding: 4px; min-width: 10px; height: fit-content;" for="avail-{{ $team->id }}-{{ $key }}">{{ $label }}</label>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-3">
                <x-button wire="close" class="btn-outline-primary" width="80px">No</x-button>
                <x-button type="button" wire="roll" class="btn-primary" width="80px">Yes</x-button>
            </div>
        </x-modal>
    </div>
</form>