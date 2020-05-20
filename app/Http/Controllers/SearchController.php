<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     *Display  a listing of the resource
     *
     * @return \Illuminate\Http\Response
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

        switch($request->tableNumber){
            case 1:
                $sql = $sql->orderBy('survey_number', 'asc');
            case 2:
                $sql = $sql->orderBy('survey_number', 'desc');
            case 3:
                $sql = $sql->orderBy('programmer', 'asc');
            case 4:
                $sql = $sql->orderBy('programmer', 'desc');
            case 5:
                $sql = $sql->orderBy('project_manager', 'asc');
            case 6:
                $sql = $sql->orderBy('project_manager', 'desc');
            case 7:
                $sql = $sql->orderBy('detail', 'asc');
            case 8:
                $sql = $sql->orderBy('detail', 'desc');
            case 9:
                $sql = $sql->orderBy('feldstart', 'asc');
            case 10:
                $sql = $sql->orderBy('feldstart', 'desc');
        }

        /*
        if ($request->tableNumber == 1) {
            $sql = $sql->orderBy('survey_number', 'asc');
        }elseif($request->tableNumber == 2) {
            $sql = $sql->orderBy('programmer', 'asc');
        }elseif($request->tableNumber == 3) {
            $sql = $sql->orderBy('project_manager', 'asc');
        }elseif($request->tableNumber == 4) {
            $sql = $sql->orderBy('detail', 'asc');
        }elseif($request->tableNumber == 5) {
            $sql = $sql->orderBy('status', 'asc');
        }
        */

        return $sql->get();


        /*
        return Project::where('survey_number', 'LIKE', $searchQuery)
            ->orWhere('programmer', 'LIKE', $searchQuery)
            ->orWhere('project_manager', 'LIKE', $searchQuery)
            ->orWhere('detail', 'LIKE', $searchQuery)
            ->orWhere('info', 'LIKE', $searchQuery)
            ->where('status', '=', $request->filterQuery)
            ->get();
        */
    }

    public function delete($project)
    {
        Project::where('id', $project)->update(["status" => "Gelöscht"]);

        return Project::where('id', $project)->delete();

        // Alternativen
        // Project::where('id', $project)->delete();
        // Project::whereId($project);

    }
}
