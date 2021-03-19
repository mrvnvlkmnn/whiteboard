<?php

namespace App\View\Components;

use Illuminate\View\Component;

class circle extends Component
{
    public $color;

    /**
     * Create a new component instance.
     *
     * @param string $color
     */
    public function __construct($color = 'grey')
    {
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.circle');
    }
}
