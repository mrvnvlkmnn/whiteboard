<?php

namespace App\Http\Livewire;

use App\Project;
use Livewire\Component;

class Modal extends Component
{
    public $surveyId;
    public $updateList;
    public $status;
    public $showModal = false;

    protected $listeners = ['sendSurveyId', 'showModal'];


    //deletes the project
    public function deleteProject(){

        $this->updateList[time()] = ['type' => 'project_deleted'];

        Project::find($this->surveyId)->update(['update_list' => $this->updateList]);

        Project::find($this->surveyId)->delete();

        $this->showModal = false;
        $this->emitUp('render');
        $this->emitTo('count-projects', 'render');
    }

    //
    public function sendSurveyId($surveyId, $updateList){
        $this->surveyId = $surveyId;
        $this->updateList = $updateList;
    }

    //sets the variable to show the modal
    public function showModal(){
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.modal');
    }
}
