<?php

namespace App\Http\Livewire;

use App\Events\projectCreated;
use App\Project;
use Livewire\Component;

class ReactivateProject extends Component
{
    public $surveyId;
    public $updateList;
    public $showReactivateProject = false;

    protected $listeners = ['sendSurveyId', 'showReactivateProject'];


    public function sendSurveyId($surveyId, $updateList){
        $this->surveyId = $surveyId;
        $this->updateList = $updateList;
    }

    public function showReactivateProject(){
        $this->showReactivateProject = true;
    }

    public function reactivateProject(){
        $this->updateList[time()] = ['type' => 'project_reactivated'];

        Project::withTrashed()->where('id', $this->surveyId)->update(['update_list' => $this->updateList]);

        Project::withTrashed()->where('id', $this->surveyId)->restore();

        $this->showReactivateProject = false;

        $this->emitUp('render');
        event(new projectCreated);
        $this->emitTo('count-projects', 'render');
    }

    public function render()
    {
        return view('livewire.reactivate-project');
    }
}
