<?php

namespace App\Http\Livewire;

use App\Http\Requests\UpdateProjectRequest;
use App\Project;
use Livewire\Component;

class EditProject extends Component
{
    public $project;
    public $surveyId;

    public $programmer;
    public $project_manager;
    public $survey_number;
    public $detail;
    public $feldstart;
    public $status;

    public $showEditProject = false;

    protected $listeners = ['sendSurveyId', 'showEditProject', 'updateProject'];
    protected $rules = [
        'survey_number'     => 'required',
        'programmer'        => 'required',
        'project_manager'   => 'required',
        'detail'            => 'required',
        'feldstart'         => 'required',
        'status'            => 'required',

    ];

    public function sendSurveyId($surveyId){
        $this->surveyId = $surveyId;

        #set programmmer, project_manager, etc.
        $this->project = Project::find($this->surveyId);

        $this->programmer = $this->project->programmer;
        $this->project_manager = $this->project->project_manager;
        $this->survey_number = $this->project->survey_number;
        $this->detail = $this->project->detail;
        $this->feldstart = $this->project->feldstart;
        $this->status = $this->project->status;


    }


    public function updateProject(){

        $this->validate();

        $all = $request->all();
        $all['programmer'] = implode(',', $all['programmer']);
        $all['project_manager'] = implode(',', $all['project_manager']);

        $this->project->update($all);

        #$this->emitUp('render');

    }

    public function showEditProject(){
        $this->showEditProject = true;
    }

    public function render()
    {
        return view('livewire.edit-project');
    }
}
