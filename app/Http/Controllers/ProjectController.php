<?php

namespace App\Http\Controllers;

use App\Models\project;
use App\Http\Requests\StoreprojectRequest;
use App\Http\Requests\UpdateprojectRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects= Project::all();

        return view('admin.project.index',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(project $project)
    {
        return view('admin.project.create',compact('project'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreprojectRequest $request)
    {
        $formData = $request->validated();

        $slug = project::getSlug($formData['name']);
        $formData['slug'] = $slug;
        $formData['user_id'] = Auth::id();
        if($request->hasFile('image')){
            $path = Storage::put('uploads',$formData['image']);
            $formData['image'] = $path;


        }
        $newProject = Project::create($formData);
        return to_route('admin.projects.show',$newProject->id);

    }

    /**
     * Display the specified resource.
     */
    public function show(project $project)
    {
        return view('admin.project.show',compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(project $project)
    {
        return view('admin.project.edit',compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateprojectRequest $request, project $project)
    {
        $formData = $request->validated();
        $project->fill($formData);
        $project->update();
        return to_route('admin.projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(project $project)
    {
        $project->delete();
        return to_route('admin.projects.index')->with('message', "Il progetto $project->name è stato eliminato");
    }
}
