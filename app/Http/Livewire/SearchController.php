<?php

namespace App\Http\Livewire;

use App\Project;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Boolean;

class SearchController extends Component
{
    public $search;
    public $surveys;
    public $filterQuery;
    public $columnName;
    public $order;

    protected $listeners = ['setParameterForSorting', 'render', 'changeFilterQuery', 'showComponent'];


    public function setUpdateTypeName($inputName) : string{
        switch($inputName){
            case('project_added');
                $output = 'Projekt erstellt';
            break;
            case('project_deleted');
                $output = 'Projekt gelöscht';
            break;
            case('project_reactivated');
                $output = 'Projekt wieder hergestellt';
            break;
            case('project_updated');
                $output = 'Projekt bearbeitet';
            break;
            case('project_mail_sent');
                $output = 'Testlink versendet';
                break;
        }

        return $output;
    }

    public function formatDate($date) : string{
        $date = preg_split('#-#', $date);

        if(strlen($date[count($date) - 1]) > 10){
            $date[count($date) - 1] = str_replace('T00:00:00.000000Z', '', $date[count($date) - 1]);
        }
        krsort($date);
        $date = implode('.', $date);

        return $date;
    }

    public function checkForEloquentWordingForDetail($input) : string{
        switch ($input) {
            case('survey_number'):
                $output = "Studiennummer";
            break;
            case('programmer'):
                $output = "Programmierer";
            break;
            case('project_manager'):
                $output = "Projekt-Leiter";
            break;
            case('detail'):
                $output = "Details";
            break;
            case('fieldstart'):
                $output = "Felsdstart";
            break;
            case('status'):
                $output = "Status";
            break;
            case('mail_sent'):
                $output = "Testlink";
                break;
        }
        return $output;
    }

    #set x-data for Modal, addProject and editProject
    public function showComponent($component, $surveyId, $updateList){
        if($component == "Modal"){
            $this->emitTo('modal', 'showModal');
            $this->emitTo('modal', 'sendSurveyId', $surveyId, $updateList);
        }
        elseif($component == "editProject"){
            $this->emitTo('edit-project', 'showEditProject');
            $this->emitTo('edit-project', 'sendSurveyId', $surveyId);
        }
        elseif($component == 'reactivateProject'){
            $this->emitTo('reactivate-project', 'showReactivateProject');
            $this->emitTo('reactivate-project', 'sendSurveyId', $surveyId, $updateList);
        }
    }

    public function mount(){
        $this->filterQuery = "Aktive";
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

        $searchQuery = "%" . strtoupper($this->search) . "%";

        $searchFunction = function ($query) use ($searchQuery) {
            $query->where('survey_number', 'LIKE', $searchQuery)
                ->orWhere('programmer', 'LIKE', $searchQuery)
                ->orWhere('project_manager', 'LIKE', $searchQuery)
                ->orWhere('detail', 'LIKE', $searchQuery);};

        $surveys = Project::where($searchFunction);

        if ($this->filterQuery == "deleted") {
            $surveys = Project::onlyTrashed()->where($searchFunction);
        }else{
            if($this->filterQuery !== "Aktive"){
                $surveys = $surveys->where('status', '=', $this->filterQuery);
            }
        }
        if(!empty($this->columnName)){
            $surveys = $surveys->orderBy($this->columnName, $this->order);
        }


        $this->surveys = $surveys->get();


        return view('livewire.search-controller');
    }
}
