<?php

namespace App\Http\Controllers;

use App\Project;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchController extends Controller
{
    /**
     *Display  a listing of the resource
     *
     * @return Response
     */

    public function index(Request $request)
    {
        $searchQuery = "%" . $request->searchQuery . "%";


        $sql = Project::where(function ($query) use ($searchQuery) {
            $query->where('survey_number', 'LIKE', $searchQuery)
                ->orWhere('programmer', 'LIKE', $searchQuery)
                ->orWhere('project_manager', 'LIKE', $searchQuery)
                ->orWhere('detail', 'LIKE', $searchQuery)
                ->orWhere('deleted_at', '=', 'NULL');
        });

        //$sql = $sql->orderBy('survey_number', 'asc');

        if ($request->filterQuery !== "Alle") {
            $sql = $sql->where('status', '=', $request->filterQuery);
        }

        if(!empty($request->columnName)){
            $sql = $sql->orderBy($request->columnName, $request->order);
        }

        return $sql->get();

    }

    public function getDataForCases(){
        return Project::all();
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
}
