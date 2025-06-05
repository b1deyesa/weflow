<div class="form-check form-switch ms-1">
    <input class="form-check-input {{ $status ? 'bg-success' : '' }}" type="checkbox" role="switch" id="status-{{ $employee->id }}" wire:model.live="status">
</div>