<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $label = false,
        public $type = 'text',
        public $id = null,
        public $name = null,
        public $wire = null,
        public $value = false,
        public $placeholder = false,
        public $class = false,
        public $required = false,
        public $disabled = false,
        public $checked = false,
        public $options = null
    )
    {
        $this->type = $type;
        
        if ($wire) {
            $this->wire = $wire;
            $this->name = $wire;
        } else {
            $this->name = $name ?? $this->type;
        }
        
        $this->id = $id ?? $this->name;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->class = $class;
        $this->required = $required;
        $this->disabled = $disabled;
        $this->checked = $checked;
        $this->options = json_decode($options, true);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
