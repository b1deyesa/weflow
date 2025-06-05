<x-layout.admin>
    <div class="d-flex align-items-center justify-content-between gap-2">
        <h1 class="fs-5 fw-bold text-dark" style="margin: 0">Teams</h1>
        <div class="d-flex gap-2 justify-content-end">
            @livewire('admin.team.generate')                    
            <a href="{{ route('admin.team.create') }}" class="btn btn-outline-secondary btn-sm">Add Team</a>
        </div>
    </div>
    <div class="d-flex flex-wrap row-gap-3 column-gap-3 justify-content-start align-items-stretch mt-4">
        @foreach ($teams as $team)
            <div class="team-card d-flex flex-column p-3 rounded-2 border" style="width: 49%; font-size: .9em; background: linear-gradient(20deg, #ffffff60, #ffffff40, #ffffff50);">
                <img src="{{ asset('storage/Team/'. $team->logo) }}" alt="">
                <div class="d-flex flex-column w-100 justify-content-between h-100">
                    <h6 class="fw-bold">{{ $team->name }}</h6>
                    <small style="font-size: .75em; margin: .7em 0 0;" class="text-secondary fw-bold mb-1">Employee:</small>
                    <span style="font-size: .85em;" class="mb-1">{{ $team->employees?->first()?->name }}</li></span>
                    <small style="font-size: .75em; margin: .7em 0 0;" class="text-secondary fw-bold mb-1">Customer:</small>
                    <ul style="font-size: .85em; padding-left: .0;" class="mb-1">
                        @foreach ($team->customers as $customer)
                            <li>{{ $customer->name }}</li>
                        @endforeach
                    </ul>
                    <div class="d-flex gap-1 ms-auto mt-auto justify-self-end p-1 rounded" style="font-size: .9em; background: linear-gradient( #ffffffAA, #ffffff90, #ffffffCC);">
                        <a href="{{ route('admin.team.edit', compact('team')) }}" class="btn btn-outline-secondary btn-sm px-1 py-0" style="width: fit-content; height: fit-content;"><i class="bi bi-pencil-fill"></i></a>
                        <a href="{{ route('admin.team.show', compact('team')) }}" class="btn btn-outline-primary btn-sm px-1 py-0" style="width: fit-content; height: fit-content;"><i class="bi bi-eye-fill"></i></a>
                        @livewire('admin.team.delete', compact('team'), key($team->id))
                    </div>
                </div>
            </div> 
        @endforeach  
    </div>
</x-layout.admin>
