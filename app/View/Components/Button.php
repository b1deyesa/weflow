<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $type = 'button',
        public $form = false,
        public $wire = null,
        public $class = false,
        public $width = false,
        public $style = false,
    )
    {
        $this->type = $type;
        $this->form = $form;
        $this->wire = $wire;
        $this->class = $class;
        $this->width = $width;
        $this->style = $style;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button');
    }
}
