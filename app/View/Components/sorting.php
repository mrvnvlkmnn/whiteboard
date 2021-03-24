<?php

namespace App\View\Components;

use Illuminate\View\Component;

class sorting extends Component
{

    public $nameForSorting;
    public $margin;
    public $sortingOrder;

    /**
     * Create a new component instance.
     *
     * @param $nameForSorting
     * @param $sortingOrder
     * @param string $margin
     */
    public function __construct($nameForSorting, $sortingOrder, $margin = 'ml-0')
    {
        $this->nameForSorting = $nameForSorting;
        $this->sortingOrder = $sortingOrder;
        $this->margin = $margin;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.sorting');
    }
}
