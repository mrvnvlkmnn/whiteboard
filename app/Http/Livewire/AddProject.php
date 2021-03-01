<?php

namespace App\Http\Livewire;

use App\Project;
use App\User;
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
    public $employeesIT;
    public $employeesMafo;

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

    //calling this function opens the window to add a project
    //it sets the survey number to the current year
    //activates select2
    public function showAddProject()
    {
        $this->showAddProject = true;
        $this->survey_number = "Q" . substr(date("Y"), 2, 2) . "0XXde";
        $this->feldstart = date("Y-n-j", strtotime('+1 day'));
        //dd($this->feldstart);
        $this->dispatchBrowserEvent('checkSelect2');
    }

    //closes the window
    public function closeAddProject()
    {
        $this->showAddProject = false;
    }

    private function getEmployees(){
        $this->employeesIT = User::where('department', 'LIKE', 'IT')->get();
        $this->employeesMafo = User::where('department', 'LIKE', 'Mafo')->get();

        #dd($this->employees);
    }

    //adds a project to the db
    public function addProject()
    {
        //checks if data is valid
        if ($this->validate()) {
            //checks if feldstart is in the future | feldstart need to be in the future!
            if ($this->feldstart >= now()) {

                Project::create(['survey_number' => $this->survey_number,
                    'programmer' => $this->programmer,
                    'project_manager' => $this->project_manager,
                    'detail' => $this->detail,
                    'feldstart' => $this->feldstart,
                    'status' => $this->status]);

                $this->showAddProject = false;
                $this->emit('render');
                $this->emitTo('count-projects', 'render');

            } else{
                $this->addError('feldstart', 'Der Feldstart muss in der Zukunft liegen');
            }
        }
    }

    public function render()
    {
        $this->getEmployees();
        return view('livewire.add-project');
    }
}
