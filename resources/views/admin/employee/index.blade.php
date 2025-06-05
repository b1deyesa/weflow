<x-layout.admin>
    <div class="d-flex align-items-center gap-3">
        <h1 class="fs-5 fw-bold text-dark" style="margin: 0"><i class="bi bi-person-rolodex opacity-50 me-2"></i>Employee Data</h1>
        <a href="{{ route('admin.employee.create') }}" class="btn btn-outline-secondary btn-sm py-0">Add Employee</a>
    </div>
    <div class="d-flex justify-content-between gap-2 mt-4" style="height: 220px">
        <x-cart id="employee-day" type="pie" :datas="$cart['day']" title="Employee Day" class="w-full" />
        <x-cart id="employee-position" type="pie" :datas="$cart['position']" title="Employee Position" class="w-full" />
        <div class="d-flex flex-column justify-content-between w-100">
            <x-cart id="employee-total" type="count" :datas="$cart['total']" title="Total Employee" class="w-100" />
            <x-cart id="employee-active" type="count" :datas="$cart['active']" title="Active Employee" class="w-100" />
        </div>
        <x-cart id="employee-ey" type="pie" :datas="$cart['day']" title="Employee Day" class="w-full" />
    </div>
    <x-table>
        <x-slot:head>
            <th>Employee ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Position</th>
            <th>Days</th>
            <th>Status</th>
            <th></th>
        </x-slot:head>
        <x-slot:body>
            @foreach ($employees as $employee)
                <tr>
                    <td width="80px">{{ $employee->code }}</td>
                    <td width="50px" align="center">
                        <img src="{{ $employee->photo ? asset('storage/Employee/' . $employee->photo) : asset('img/user.jpg') }}" class="object-fit-cover border rounded-1" width="50px" style="aspect-ratio: 3/3.5;">
                    </td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->position }}</td>
                    <td width="1%">{!! days($employee->working_days) !!}</td>
                    <td width="1%" align="center">
                        @livewire('admin.employee.status', ['employee' => $employee], key($employee->id))
                    </td>
                    <td width="1%">
                        <div class="d-flex align-items-center gap-1">
                            <a href="{{ route('admin.employee.edit', compact('employee')) }}" class="btn btn-outline-dark btn-sm px-1 py-0"><i class="bi bi-pencil-square"></i></a>
                            @livewire('admin.employee.delete', ['employee' => $employee], ['key' => 'delete-'.$employee->id])
                        </div>
                    </td>
                </tr>
            @endforeach
        </x-slot:body>
    </x-table>
</x-layout.admin>