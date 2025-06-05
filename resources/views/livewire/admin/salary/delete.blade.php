<x-modal label="Delete">
    <h4 class="fs-5 fw-bold">Delete Employee Salary</h4>
    <p>Are you sure to delete this employee salary?</p>
    <div class="d-flex justify-content-end gap-2 mt-3">
        <x-button type="button" wire="close" class="btn-outline-primary" width="80px">Close</x-button>
        <x-button type="button" wire="destroy" class="btn-primary" width="80px">Delete</x-button>
    </div>
</x-modal>