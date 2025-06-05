<button 
    type="{{ $type }}" 
    @if($form) form="{{ $form }}" @endif
    @if($wire) wire:click="{{ $wire }}" @endif
    class="btn {{ $class }}" 
    style="min-width: {{ $width }}; {{ $style }}"
    {{ $attributes }}>{{ $slot }}</button>