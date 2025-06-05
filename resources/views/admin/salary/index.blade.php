<x-layout.admin>
    <div class="d-flex align-items-center justify-content-between gap-2">
        <h1 class="fs-5 fw-bold text-dark" style="margin: 0">Salary</h1>
        <div class="d-flex gap-2 justify-content-end">
            <a href="{{ route('admin.salary.create') }}" class="btn btn-outline-secondary btn-sm">Add Employee Salary</a>
            <a href="{{ route('admin.detail-salary.create') }}" class="btn btn-secondary btn-sm">Pay Salary</a>
        </div>
    </div>
    <div class="mt-5">
        <x-table id="salary_detail">
            <x-slot:head>
                <th>Payroll Date</th>
                <th>Period Start</th>
                <th>Period End</th>
                <th>Allowance</th>
                <th>Bonus</th>
                <th>Deducation</th>
                <th>Net Salary</th>
                <th>Payment Status</th>
                <th>Note</th>
                <th></th>
            </x-slot:head>
            <x-slot:body>
                @foreach ($detail_salaries as $detail_salary)
                    <tr>
                        <td>{{ $detail_salary->payroll_date }}</td>
                        <td>{{ $detail_salary->period_start }}</td>
                        <td>{{ $detail_salary->period_end }}</td>
                        <td>@currency($detail_salary->allowance)</td>
                        <td>@currency($detail_salary->bonus)</td>
                        <td>@currency($detail_salary->deducation)</td>
                        <td>@currency($detail_salary->net_salary)</td>
                        <td>{!! $detail_salary->payment_status() !!}</td>
                        <td>{{ $detail_salary->note }}</td>
                        <td width="1%">
                            <div class="d-flex gap-1">
                                {{-- <a href="{{ route('admin.salary.edit', compact('salary')) }}" class="btn btn-outline-secondary btn-sm">Edit</a> --}}
                                {{-- @livewire('admin.salary.delete', ['salary' => $salary], ['key' => 'delete-'.$salary->id]) --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </x-slot:body>
        </x-table>
    </div>
    <div class="mt-5">
        <x-table id="salary">
            <x-slot:head>
                <th>Employee ID</th>
                <th>Employee Name</th>
                <th>Basic Salary</th>
                <th></th>
            </x-slot:head>
            <x-slot:body>
                @foreach ($salaries as $salary)
                    <tr>
                        <td>{{ $salary->employee->code }}</td>
                        <td>{{ $salary->employee->name }}</td>
                        <td>@currency($salary->basic_salary)</td>
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
    </div>
</x-layout.admin>