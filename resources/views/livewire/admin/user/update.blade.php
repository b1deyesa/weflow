<x-modal label="Edit">
    <x-form>
        <x-input label="Full Name" type="text" wire="name" />
        <x-input label="User Email" type="email" wire="email" />
        <x-input label="Password" type="password" wire="password" />
        <x-input label="Password Confirmation" type="password" wire="password_confirmation" />
        <div class="d-flex justify-content-end gap-2 mt-3">
            <x-button type="button" wire="close" class="btn-outline-primary" width="80px">Close</x-button>
            <x-button type="button" wire="update" class="btn-primary" width="80px">Update</x-button>
        </div>
    </x-form>                   
</x-modal>
