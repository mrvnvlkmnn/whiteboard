<?php

namespace App\Http\Livewire;

use App\Project;
use Livewire\Component;

class AddProject extends Component
{
    public $showAddProject = false;
    public $survey_number;
    public $programmer;
    public $project_manager;
    public $detail;
    public $feldstart;
    public $status = 'Kick-Off';

    protected $listeners = ['showAddProject'];
    protected $rules = [
        'survey_number' => 'required|unique:projects',
        'programmer' => 'required',
        'project_manager' => 'required',
        'detail' => 'required',
        'feldstart' => 'required',
        'status' => 'required',

    ];
    protected $messages = [
        'survey_number.unique' => 'Die Studien-Nummer ist bereits vergeben',
        'detail.required' => 'Die Details dürfen nicht leer sein',

    ];

    public function showAddProject()
    {
        $this->showAddProject = true;
        $this->survey_number = "Q" . substr(date("Y"), 0, 2) . "0XXde";
        $this->feldstart = date("Y-n-j", strtotime('+1 day'));
        $this->dispatchBrowserEvent('checkSelect2');
    }

    public function closeAddProject()
    {
        $this->showAddProject = false;
    }

    public function addProject()
    {
        if ($this->validate()) {
            if ($this->feldstart >= now()) {

                Project::create(['survey_number' => $this->survey_number,
                    'programmer' => $this->programmer,
                    'project_manager' => $this->project_manager,
                    'detail' => $this->detail,
                    'feldstart' => $this->feldstart,
                    'status' => $this->status]);

                $this->showAddProject = false;
                $this->emit('render');

            } else{
                $this->addError('feldstart', 'Der Feldstart muss in der Zukunft liegen');
            }
        }
    }

    public function render()
    {
        return view('livewire.add-project');
    }
}
