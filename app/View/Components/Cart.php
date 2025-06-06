<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Cart extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public $type = 'bar',
        public $id = 'cart',
        public $class = null,
        public $title = null,
        public $label = null,
        public $datas = null,
    )
    {   
        $this->type = $type;
        $this->id = $id;
        $this->class = $class;
        $this->title = $title;
        $this->label = $label;
        $this->datas = json_decode($datas, true);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cart');
    }
}
