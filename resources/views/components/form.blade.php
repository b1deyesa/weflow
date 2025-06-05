<div class="border p-4 mt-4 rounded" style="background: linear-gradient(20deg, #ffffffEA, #ffffff90, #ffffff90)">
    <form id="{{ $id }}" wire:submit="{{ $wire }}" action="{{ $action }}" method="{{ $method }}" class="d-flex flex-column {{ $class }}" enctype="{{ $enctype }}">
        @csrf
        @method($method_name)
        {{ $slot }}
    </form>
</div>