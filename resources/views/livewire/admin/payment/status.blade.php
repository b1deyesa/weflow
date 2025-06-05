<x-modal label="Manual Pay">
    <h4 class="fs-5 fw-bold">Manual Payment</h4>
    <div class="mt-4">
        <x-input type="number" wire="ammount" placeholder="Amount" />
    </div>
    <div class="d-flex justify-content-end gap-2 mt-3">
        <x-button type="button" wire="close" class="btn-outline-primary" width="80px">Close</x-button>
        <x-button type="button" wire="destroy" class="btn-primary" width="80px">Delete</x-button>
    </div>
</x-modal>