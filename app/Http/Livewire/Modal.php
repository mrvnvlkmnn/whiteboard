<?php

namespace App\Http\Livewire;

use App\Project;
use Livewire\Component;

class Modal extends Component
{
    public $surveyId;
    public $showModal = false;

    protected $listeners = ['deleteProject', 'sendSurveyId', 'showModal'];

    public function showModal(){
        $this->showModal = true;
    }

    public function deleteProject(){
            $project = Project::find($this->surveyId);
            $project->delete();
            $this->dispatchBrowserEvent('project-deleted');
            $this->emitUp('render');

    }

    public function sendSurveyId($surveyId){
        $this->surveyId = $surveyId;
    }

    public function render()
    {
        return view('livewire.modal');
    }
}
