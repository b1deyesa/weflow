<x-layout.admin>
    <h1 class="fs-5 fw-bold text-dark" style="margin: 0">Edit Salary</h1>
    <x-form action="{{ route('admin.salary.update', compact('salary')) }}" method="PUT" class="mt-4">
        <div class="d-flex gap-3 w-100">
            <x-input label="Employee" type="text" value="{{ $salary->employee->code }} - {{ $salary->employee->name }}" disabled />
            <x-input label="Basic Salary" type="number" name="basic_salary" value="{{ $salary->basic_salary }}" />
        </div>
        <div class="d-flex justify-content-end gap-2 mt-3">
            <a href="{{ route('admin.salary.index') }}" class="btn btn-outline-primary" style="min-width: 80px">Close</a>
            <x-button type="submit" class="btn-primary" width="80px">Submit</x-button>
        </div>
    </x-form>
</x-layout.admin>