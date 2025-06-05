<div class="mb-3 w-100">
    @if ($label)
        <label for="{{ $name }}" class="form-label text-secondary" style="font-size: .8em">{{ $label }}</label>
    @endif
    @if ($type == 'select')
        
    @elseif ($type == 'select-search')
        <div wire:ignore>
            <select class="form-select select2-{{ $id }}" 
                id="{{ $id }}" 
                name="{{ $name }}"
                >
                <option></option>
                @foreach ($options as $key => $option)
                    <option value="{{ $key }}" @selected($key == old($name, $value))>{{ $option }}</option>
                @endforeach
            </select>
        </div>
        <script>
            $(document).ready(function () {
                $('.select2-{{ $id }}').select2({
                    theme: 'bootstrap-5',
                    placeholder: '{{ $placeholder }}',
                    allowClear: true
                });
            });
        </script>
        @if ($wire)
            <script>
                $(document).ready(function () {
                    $('.select2-{{ $id }}').on('change', function (e) {
                        var data = $('.select2-{{ $id }}').select2("val");
                        @this.set('{{ $wire }}', data);
                    });
                });
            </script>
        @endif
    @elseif ($type == 'select-search-multiple')
        <div wire:ignore>
            <select class="form-select select2-{{ $id }}" 
                id="{{ $id }}" 
                name="{{ $name }}[]"
                multiple="multiple"
                >
                @foreach ($options as $key => $value)
                    <option value="{{ $key }}" @if (is_array(old($name)) && in_array($key, old($name))) selected @endif>{{ $value }}</option>
                @endforeach
            </select>
        </div>
        <script>
            $(document).ready(function () {
                $('.select2-{{ $id }}').select2({
                    theme: 'bootstrap-5',
                    placeholder: '{{ $placeholder }}',
                    allowClear: true
                });
            });
        </script>
        @if ($wire)
            <script>
                $(document).ready(function () {
                    $('.select2-{{ $id }}').on('change', function (e) {
                        var data = $('.select2-{{ $id }}').select2("val");
                        @this.set('{{ $wire }}', data);
                    });
                });
            </script>
        @endif
    @elseif ($type == 'select-multiple')
        <div 
            x-data="{
                o: @js($options),
                q: '',
                k: @js(old($name, $value ?: [])),
                f() {
                    return Object.entries(this.o).filter(
                        ([key, val]) => val.toLowerCase().includes(this.q.toLowerCase()) && !this.k.includes(Number(key))
                    );
                },
                c() {
                    let match = Object.entries(this.o).find(
                        ([key, val]) => val.toLowerCase() === this.q.toLowerCase()
                    );
                    if (match && !this.k.includes(Number(match[0]))) {
                        this.k.push(Number(match[0]));
                        this.q = '';
                        this.syncToLivewire();
                    }
                },
                remove(index) {
                    this.k.splice(index, 1);
                    this.syncToLivewire();
                },
                syncToLivewire() {
                    @if ($wire)
                        $wire.set('{{ $wire }}', this.k);
                    @endif
                }
            }"
            class="position-relative"
        >
            <template x-for="(item, i) in k" :key="i">
                <input type="hidden" name="{{ $name }}[]" :value="item">
            </template>

            <input type="text"
                x-model="q"
                @input="$refs.l.classList.remove('d-none')"
                @focus="$refs.l.classList.remove('d-none')"
                @blur="c();$refs.l.classList.add('d-none');$refs.input.blur()"
                placeholder="{{ $placeholder }}"
                class="form-control {{ $class }} @error($name) is-invalid @enderror"
                x-ref="input">

            <ul x-ref="l" class="list-group position-absolute mt-1 w-100 z-3 d-none" style="max-height: 160px; overflow-y: auto;">
                <template x-for="[key,val] in f()" :key="key">
                    <li @mousedown.prevent="q=val;c();$refs.l.classList.add('d-none');$refs.input.blur()"
                        class="list-group-item list-group-item-action">
                        <span x-text="val"></span>
                    </li>
                </template>
            </ul>

            <div x-show="k.length>0" class="mt-2 d-flex flex-wrap gap-1">
                <template x-for="(item,index) in k" :key="index">
                    <span class="badge bg-secondary">
                        <span x-text="o[item]"></span>
                        <button type="button" @click="remove(index)" class="btn-close btn-close-white btn-sm ms-2" aria-label="Remove"></button>
                    </span>
                </template>
            </div>
        </div>
    @elseif ($type == 'switch')
        <div class="form-check form-switch">
            <input class="form-check-input" 
                type="checkbox" 
                role="switch" 
                id="{{ $id }}" 
                name="{{ $name }}" 
                wire:model.live="{{ $wire }}"
                @disabled($disabled)
                @checked(old($name, $value))
                >
            <label class="form-check-label" for="{{ $id }}">{{ $placeholder }}</label>
        </div>
    @elseif ($type == 'file')
        <input 
            type="file" 
            id="{{ $id }}" 
            name="{{ $name }}" 
            wire:model.live="{{ $wire }}" 
            value="{{ old($name, $value) }}" 
            autocomplete="off" 
            placeholder="{{ $placeholder }}"
            @disabled($disabled)
            autofocus
            class="form-control @error($name) is-invalid @enderror {{ $class }}" 
            style="font-size: .9em !important"
            >
    @elseif ($type == 'checkbox')
        <div class="d-flex gap-2">
            @foreach ($options as $key => $option)
                <input
                    type="checkbox" 
                    id="{{ $id }}-{{ $key }}" 
                    name="{{ $name }}[{{ $key }}]"
                    wire:model.live="{{ $wire }}.{{ $key }}"
                    class="btn-check"
                    autocomplete="off"
                    @checked(in_array($key, array_keys(old($name, json_decode($value, true)) ?? [])))
                    >
                <label class="btn btn-outline-secondary w-100 @error($name) border-danger @enderror" style="font-size: .85em" for="{{ $id }}-{{ $key }}">{{ $option }}</label>
            @endforeach
        </div>
    @elseif ($type == 'textarea')
        <textarea  
            id="{{ $id }}" 
            name="{{ $name }}" 
            wire:model.live="{{ $wire }}" 
            autocomplete="off" 
            @disabled($disabled)
            style="font-size: .9em !important"
            autofocus
            class="form-control @error($name) is-invalid @enderror {{ $class }}" 
            {{ $attributes }}
            >{{ old($name, $value) }}</textarea>
    @else
        <input 
            type="{{ $type }}" 
            id="{{ $id }}" 
            name="{{ $name }}" 
            wire:model.live="{{ $wire }}" 
            value="{{ old($name, $value) }}" 
            autocomplete="off" 
            placeholder="{{ $placeholder }}"
            @disabled($disabled)
            autofocus
            class="form-control @error($name) is-invalid @enderror {{ $class }}" 
            style="font-size: .9em !important"
            >
    @endif
    @error($name)
        <div class="text-danger" style="font-size: .9em">{{ $message }}</div>
    @enderror
</div>

