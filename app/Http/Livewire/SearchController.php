<?php

namespace App\Http\Livewire;

use App\Project;
use Illuminate\Http\Request;
use Livewire\Component;

class SearchController extends Component
{
    public $search;
    public $surveys;
    public $filterQuery;
    public $columnName;
    public $order;

    protected $listeners = ['setParameterForSorting'];

    public function mount(){
        $this->filterQuery = "Alle";

    }


    public function setParameterForSorting($name, $order){
        $this->columnName = $name;
        $this->order = $order;
    }

    public function countProgrammierung(Request $request){

        $collection = Project::groupBy('status')
            ->selectRaw('count(*)')
            ->get();
        return $collection;
    }

    public function delete($project)
    {
        Project::where('id', $project)->update(["status" => "Gelöscht"]);

        return Project::where('id', $project)->delete();


    }

    public function render()
    {
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

        return view('livewire.search-controller');
    }
}
