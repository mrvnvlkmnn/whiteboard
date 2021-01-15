<?php

namespace App\Http\Livewire;

use App\Project;
use Livewire\Component;

class Modal extends Component
{
    public $surveyId;
    public $showModal = false;

    protected $listeners = ['sendSurveyId', 'showModal'];

    //sets the variable to show the modal
    public function showModal(){
        $this->showModal = true;
    }

    //deletes the project
    public function deleteProject(){
        Project::find($this->surveyId)->delete();
        $this->showModal = false;
        $this->emitUp('render');
        $this->emitTo('count-projects', 'render');
    }

    //
    public function sendSurveyId($surveyId){
        $this->surveyId = $surveyId;
    }

    public function render()
    {
        return view('livewire.modal');
    }
}
