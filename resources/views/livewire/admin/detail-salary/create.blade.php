<x-form class="mt-4">
    <div class="d-flex gap-3 w-100">
        <x-input label="Employee" type="select-search" wire="employee" :options="$employees" placeholder="Select Employee" />
        <div class="w-100" style="max-width: 300px">
            <div x-data="{ edit: false }" @updated-basic-salary.window="edit = false">
                <div x-show="!edit" x-cloak>
                    <span class="d-flex justify-content-center bg-white rounded-2 border p-3 gap-3">
                        <span class="fs-4">@currency($basic_salary)</span>
                        @if ($basic_salary)
                            <button type="button" x-on:click="edit = true" x-show="!edit" class="btn btn-outline-secondary btn-sm py-0 px-2" style="height: fit-content; font-size: .9em;">Edit</button>
                        @endif
                    </span>
                </div>
                <div x-show="edit" x-cloak>
                    <span class="d-flex gap-2 align-items-start">
                        <x-input label="Basic Salary" type="number" wire="edit_basic_salary" />
                        <x-button type="button" wire:click="updateBasicSalary()" class="btn-secondary h-auto" style="margin-top: 29px">Update</x-button>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <hr class="my-4 border-dashed">
    <x-input label="Payroll Date" type="date" wire="payroll_date" />
    <div class="d-flex gap-3 w-100">
        <x-input label="Period Start" type="date" wire="period_start" />
        <x-input label="Period End" type="date" wire="period_end" />
    </div>
    <hr class="my-4 border-dashed">
    <div class="d-flex gap-3 w-100">
        <x-input label="Allowance" type="number" wire="allowance" />
        <x-input label="Bonus" type="number" wire="bonus" />
        <x-input label="Deducation" type="number" wire="deducation" />
    </div>
    <hr class="my-4 border-dashed">
    <div class="d-flex gap-3 w-100">
        <x-input label="Payment Status" type="switch" wire="payment_status" :checked="true" />
        <span class="d-flex justify-content-center bg-white rounded-2 border p-3 gap-3 w-100" style="max-width: 300px">
            <span class="fs-4">@currency($net_salary)</span>
        </span>
    </div>
    <x-input label="Note" type="textarea" wire="note" />
    <div class="d-flex justify-content-end gap-2 mt-3">
        <a href="{{ route('admin.salary.index') }}" class="btn btn-outline-primary" style="min-width: 80px">Close</a>
        <x-button wire:click="store()" class="btn-primary" width="80px">Submit</x-button>
    </div>
</x-form>