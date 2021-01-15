<?php

namespace App\Http\Livewire;

use App\Project;
use Livewire\Component;

class CountProjects extends Component
{
    public $programming;
    public $kickOff;
    public $feld;

    protected $listeners = ['render'];

    public function render()
    {
        //gets all projects where status is like programming, kick-of or im feld
        $this->programming = Project::where('status', 'LIKE', 'Programmierung')->get();
        $this->kickOff = Project::where('status', 'LIKE', 'Kick-Off')->get();
        $this->feld = Project::where('status', 'LIKE', 'Im Feld')->get();
        return view('livewire.count-projects');
    }
}
