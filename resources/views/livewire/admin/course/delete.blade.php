<x-modal class="btn-outline-danger px-1 py-0">
    <x-slot:label><i class="bi bi-trash3-fill"></i></x-slot:label>
    <h4 class="fs-5 fw-bold">Delete Course</h4>
    <p>Are you sure to delete this course?</p>
    <div class="d-flex justify-content-end gap-2 mt-3">
        <x-button type="button" wire="close" class="btn-outline-primary" width="80px">Close</x-button>
        <x-button type="button" wire="destroy" class="btn-primary" width="80px">Delete</x-button>
    </div>
</x-modal>