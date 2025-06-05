<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public $method_name;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $id = false,
        public $wire = false,
        public $action = false,
        public $method = 'GET',
        public $class = null,
        public $enctype = null
    )
    {
        $this->wire = $wire;
        $this->id = $id;
        $this->action = $action;
        $this->method = $method;
        
        if ($this->method == 'PUT') {
            $this->method_name = 'PUT';
            $this->method = 'POST';
        } elseif ($this->method == 'DELETE') {
            $this->method_name = 'DELTE';
            $this->method = 'POST';
        }
        
        $this->class = $class;
        $this->enctype = $enctype;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form');
    }
}
