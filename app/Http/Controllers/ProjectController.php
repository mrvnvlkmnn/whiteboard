<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::latest()->paginate(5);

        return view('projects.index',compact('projects'))
        ->with('i', (request()->input('page', 1) - 1) * 5);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $year = "Q" . substr(date("Y"), 0, 2) . "0XXde";

        return view('projects.create')->with('year', $year);
    }


    /**
     * Store a newly created resource in storage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'survey_number'     => 'required|unique:projects|max:10',
            'programmer'        => 'required',
            'project_manager'   => 'required',
            'detail'            => 'required',
            'info'              => 'required',
            'status'            => 'required',
        ]);

        $all = $request->all();
        $all['programmer'] = implode(',', $all['programmer']);
        $all['project_manager'] = implode(',', $all['project_manager']);

        Project::create($all);

        return redirect()->route('projects.index')
                        ->with('sucess','Project created sucessfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        // php artisan make:request StoreBlogPost (auslagerung von Validierung im Controller)
        $request->validate([
            'survey_number'     => 'required|unique:projects,survey_number,' . $project->id . '|max:10',
            'programmer'        => 'required',
            'project_manager'   => 'required',
            'detail'            => 'required',
            'info'              => 'required',
            'status'            => 'required',
        ]);

        $all = $request->all();
        $all['programmer'] = implode(',', $all['programmer']);
        $all['project_manager'] = implode(',', $all['project_manager']);

        $project->update($all);

        return redirect()->route('projects.index')
                        ->with('success','Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')
                        ->with('success','Project deleted successfully');
    }



}
