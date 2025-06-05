<x-layout.admin>
    <div class="d-flex align-items-center justify-content-between gap-2">
        <h1 class="fs-5 fw-bold text-dark" style="margin: 0">Course List</h1>
        <div class="d-flex gap-2 justify-content-end">
            <a href="{{ route('admin.course.create') }}" class="btn btn-outline-secondary btn-sm">Add Course</a>
        </div>
    </div>
    <div class="d-flex flex-wrap row-gap-3 gap-3 mt-4">
        @foreach ($courses as $course)
            <div class="d-flex flex-column p-3 rounded-2 border" style="font-size: .9em; background: linear-gradient(20deg, #ffffff60, #ffffff40, #ffffff90); width: 32.2%;">
                <div class="d-flex flex-column w-100">
                    <h6 class="fw-bold">{{ $course->name }}</h6>
                    <small class="mb-3 text-secondary fw-bold" style="font-size: .9em">{{ currency($course->price) }}</small>
                    <span>{!! day($course->days) !!}</span>
                    <small class="mt-3"><b class="text-secondary me-1"><i class="bi bi-calendar-event"></i></b> {{ \Carbon\Carbon::parse($course->date_start)->format('d M Y') }} - {{ \Carbon\Carbon::parse($course->date_end)->format('d M Y') }}</small>
                    <small style="margin-top: 2px"><b class="text-secondary"><i class="bi bi-clock"></i></b> {{ \Carbon\Carbon::parse($course->time_start)->format('h:i A') }} - {{ \Carbon\Carbon::parse($course->time_end)->format('h:i A') }}</small>
                    <hr style="border: .5px solid #00000030;">
                    <small style="font-size: .75em; margin-top: -.7em;" class="text-secondary fw-bold mb-1">Employee:</small>
                    <ul style="font-size: .85em; list-style: square; padding-left: 1rem;" class="mb-1">
                        @foreach ($course->employees as $employee)
                            <li>{{ $employee->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="d-flex gap-1 ms-auto mt-auto">
                    <a href="{{ route('admin.course.edit', compact('course')) }}" class="btn btn-outline-secondary btn-sm px-1 py-0" style="width: fit-content; height: fit-content;"><i class="bi bi-pencil-fill"></i></a>
                    <a href="{{ route('admin.course.show', compact('course')) }}" class="btn btn-outline-primary btn-sm px-1 py-0" style="width: fit-content; height: fit-content;"><i class="bi bi-eye-fill"></i></a>
                    @livewire('admin.course.delete', compact('course'), key($course->id))
                </div>
            </div>
        @endforeach
    </div>
</x-layout.admin>

{{-- <div class="mt-5">
        <x-table>
            <x-slot:head>
                <th>Code</th>
                <th>Name</th>
                <th>Price/Person</th>
                <th>Days on Week</th>
                <th>Course Start</th>
                <th>Course End</th>
                <th>Status</th>
                <th></th>
            </x-slot:head>
            <x-slot:body>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->code }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ currency($course->price) }}</td>
                        <td>
                            
                        </td>
                        <td>{{ \Carbon\Carbon::parse($course->date_start)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($course->date_end)->format('d M Y') }}</td>
                        <td>{!! status($course->status) !!}</td>
                        <td width="1%">
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.salary.edit', compact('salary')) }}" class="btn btn-outline-secondary btn-sm">Edit</a>
                                @livewire('admin.salary.delete', ['salary' => $salary], ['key' => 'delete-'.$salary->id])
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-slot:body>
        </x-table>
</div> --}}