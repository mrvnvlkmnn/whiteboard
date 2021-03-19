<?php

namespace App\View\Components;

use Illuminate\View\Component;

class tableDivTHeader extends Component
{
    public $textToDisplay;

    /**
     * Create a new component instance.
     *
     * @param $textToDisplay
     */
    public function __construct($textToDisplay)
    {
        $this->textToDisplay = $textToDisplay;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.table-div-theader');
    }
}
