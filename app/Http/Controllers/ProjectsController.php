<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->admin==1){
            return view('admin.projects.index')->with('projects',Project::withTrashed()->get());
        }
        else{
            return view('admin.projects.index')->with('projects',Project::all());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project=new Project();
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $project->translateOrNew($locale)->name = $request->$name;
        }
        $project->save();

        Session::flash('success','Project created successfully.');
        return redirect()->back();
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project=Project::find($id);
        return view('admin.projects.edit')->with('project', $project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project=Project::find($id);
        foreach (array_keys(config('translatable.locales')) as $locale) {
            $name='name_'.$locale;
            $project->getTranslation($locale)->name=$request->$name;
            $project->save();
        }
        $project->save();
        Session::flash('success', 'Project updated successfully');
        return redirect()->route('projects');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project=Project::find($id);
        $project->delete();
        Session::flash('success','The Project was just trashed.');
        return redirect()->back();
    }
}
