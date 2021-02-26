<?php

namespace App\Http\Livewire;

use App\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class SearchController extends Component
{
    public $search;
    public $surveys;
    public $filterQuery;
    public $columnName;
    public $order;
    public $surveyID;
    public $programmerCounts;

    protected $listeners = ['setParameterForSorting', 'render', 'changeFilterQuery', 'showComponent'];

    #set x-data for Modal, addProject and editProject
    public function showComponent($component, $surveyId){
        if($component == "Modal"){
            $this->emitTo('modal', 'showModal');
            $this->emitTo('modal', 'sendSurveyId', $surveyId);
        }
        if($component == "editProject"){
            $this->emitTo('edit-project', 'showEditProject');
            $this->emitTo('edit-project', 'sendSurveyId', $surveyId);
        }
    }

    public function mount(){
        $this->filterQuery = "Alle";

    }

    #getting the columName and the order for sorting
    public function setParameterForSorting($name, $order){
        $this->columnName = $name;
        $this->order = $order;
    }

    public function changeFilterQuery($filterQuery){
        $this->filterQuery = $filterQuery;
}

    public function render()
    {
        $this->programmerCounts = [Project::where('programmer', 'LIKE', '["AG"]')->get(),
            Project::where('programmer', 'LIKE', '["AR"]')->get(),
            Project::where('programmer', 'LIKE', '["DS"]')->get(),
            Project::where('programmer', 'LIKE', '["MV"]')->get(),
            Project::where('programmer', 'LIKE', '["MY"]')->get(),
            Project::where('programmer', 'LIKE', '["NS"]')->get()];

        #dd(count($this->programmerCounts[0]));
        $searchQuery = "%" . $this->search . "%";

        $surveys = Project::where(function ($query) use ($searchQuery) {
            $query->where('survey_number', 'LIKE', $searchQuery)
                ->orWhere('programmer', 'LIKE', $searchQuery)
                ->orWhere('project_manager', 'LIKE', $searchQuery)
                ->orWhere('detail', 'LIKE', $searchQuery)
                ->orWhere('deleted_at', '=', 'NULL');
        });

        if ($this->filterQuery !== "Alle") {
            $surveys = $surveys->where('status', '=', $this->filterQuery);
        }
        if(!empty($this->columnName)){
            $surveys = $surveys->orderBy($this->columnName, $this->order);
        }

        $this->surveys = $surveys->get();

        setlocale(LC_TIME, 'deu_deu');

        return view('livewire.search-controller');
    }
}
