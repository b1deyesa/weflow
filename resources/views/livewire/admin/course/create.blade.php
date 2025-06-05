<x-form class="mt-4">
    <div class="d-flex gap-3 w-100">
        <x-input label="Course Code" type="text" wire="code" :disabled="true" />
        <x-input label="Course Name" type="text" wire="name" />
    </div>
    <x-input label="Description" type="textarea" wire="description" />
    <x-input label="Price" type="number" wire="price" />
    <x-input label="Days" type="checkbox" :options="json_encode([1 => 'Monday', 2 => 'Tuesday', 3 => 'Wednesday', 4 => 'Thursday', 5 => 'Friday', 6 => 'Saturday', 7 => 'Sunday'])" wire="days" />
    <div class="d-flex gap-3 w-100">
        <x-input label="Time Start" type="time" wire="time_start" />
        <x-input label="Time End" type="time" wire="time_end" />
    </div>
    <div class="d-flex gap-3 w-100">
        <x-input label="Date Start" type="date" wire="date_start" />
        <x-input label="Date End" type="date" wire="date_end" />
    </div>
    <x-input label="Course Status (Active/Inactive)" type="switch" wire="status" />
    <hr class="my-4 border-dashed">
    <div class="d-flex flex-column gap-2">
        <h5 class="fs-6 fw-bold text-secondary"><i class="bi bi-person-rolodex me-2"></i>Employee Available</h5>
        @error('employee_id')
            <div class="alert alert-danger" role="alert">
                {{ $message }}
            </div>
        @enderror
        <table>
            <tr class="bg-secondary text-light fw-bold" style="font-size: .9em">
                <td class="px-2 py-1 border" width="60%"></td>
                <td class="px-2 py-1 border">Day Off</td>
                <td width="100px"></td>
            </tr>
            @forelse ($employees as $employee)
                <tr>
                    <td class="px-2 py-1 border">
                        <span class="fw-bold" style="font-size: .9em">{{ $employee->code }}</span> -- {{ $employee->name }}
                    </td>
                    <td class="px-2 py-1 border">
                        <div class="d-flex flex-column">
                            <span>{!! avail_days($employee->working_days, $days) !!}</span>
                        </div>
                    </td>
                    <td class="px-2 py-1 border" align="center">
                        <input type="checkbox" class="btn-check" wire:model.live="employee_id.{{ $employee->id }}" id="employee-{{ $employee->id }}" autocomplete="off">
                        <label class="btn btn-outline-secondary py-1" for="employee-{{ $employee->id }}" style="font-size: .9em">Select</label><br>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="py-5 text-center" style="background: #00000005; border-bottom: .8px solid #00000050"><span style="font-size: .9em">Please select the days first.</span></td>
                </tr>
            @endforelse
        </table>
    </div>
    <div class="d-flex justify-content-end gap-2 mt-3">
        <a href="{{ route('admin.course.index') }}" class="btn btn-outline-primary" style="min-width: 80px">Close</a>
        <x-button type="button" wire:click="store()" class="btn-primary" width="80px">Submit</x-button>
    </div>
</x-form>