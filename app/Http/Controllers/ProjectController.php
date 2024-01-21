<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Designation;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    //     public function create()
    // {
    //     $category = Designation::get();

    //     // Load the view and pass the categories to it
    //     $view = view('admin.project.create-project')->with('category', $category)->render();

    //     return response()->json(['html' => $view]);
    // }



    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'started_at' => 'required',
            'completed_at' => 'required',
            'designation_id' => 'required',
        ]);
        // dd();

        $project = new Project();
        $project->name = $request->name;
        $project->description = $request->description;
        $project->status = 'Started';
        $project->started_at = $request->started_at;
        $project->completed_at = $request->completed_at;
        $project->designation_id = $request->designation_id;

        if (auth()->check()) {
            $userName = auth()->user()->id;
            $project->creator_id = $userName;
        }

        if ($project->save()) {

            return response()->json(['success' => true, 'message' => 'Project has been created successfully']);
        } else {

            return response()->json(['success' => false, 'message' => 'An error occurred while creating the project.']);
        }
    }

    public function edit(Request $request, string $id)
    {
        $project = Project::findOrFail($id);
        $categories = Designation::get();

        // Check if it's an AJAX request
        if ($request->ajax()) {
            // Render the view to a string
            $html = view('admin.project.edit', compact('project', 'categories'))->render();
            return response()->json(['html' => $html]);
        }

        // If not an AJAX request, return the view as usual
        return view('admin.project.edit', compact('project', 'categories'));
    }



    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'status' => 'required',
            'started_at' => 'required',
            'completed_at' => 'required',
            'designation_id' => 'required',
        ]);

        $project = Project::findorFail($id);
        $project->name = $request->input('name');
        $project->description = $request->input('description');
        $project->status = $request->input('status');
        $project->started_at = $request->input('started_at');
        $project->completed_at = $request->input('completed_at');
        // $project->designation_id = $request->input('designation_id'). $id;

        if (auth()->check()) {
            $userName = auth()->user()->id;
            $project->creator_id = $userName;
        }

        if ($project->save()) {
            return response()->json(['success' => true, 'message' => 'Project deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Project not found'], 404);
        }
    }

    public function delete(Request $request)
    {
        if ($request->ajax()) {
            $project = Project::findorFail($request->id);
            // dd($project);
            if ($project->delete()) {
                return response()->json(['success' => true, 'message' => 'Project deleted successfully']);
            } else {
                return response()->json(['success' => false, 'message' => 'Project not found'], 404);
            }
        }

        // If the request is not AJAX, you can redirect back with a success message
        return back()->with('success', 'Project deleted successfully.');
    }



    public function project()
    {
        return view('admin.project.project');
    }
}
