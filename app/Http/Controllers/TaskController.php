<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Project;
use App\Models\DesignationUser;

class TaskController extends Controller
{

    public function create(Request $request, string $id)
    {
        $project = Project::where('id', $id)->first();

        if ($project) {
            // Assuming 'designation_id' is the foreign key in the DesignationUser model
            $user = DesignationUser::where('designation_id', $project->designation_id)->get();

            // Check if it's an AJAX request
            if ($request->ajax()) {
                // Render the view to a string
                $html = view('admin.task.create', compact('project', 'user'))->render();

                // Return the view HTML as a JSON response
                return response()->json(['html' => $html]);
            }

            // If not an AJAX request, return the view as usual
            return view('admin.task.create', compact('project', 'user'));
        } else {
            abort(404);
        }
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'status' => 'required',
            'started_at' => 'required',
            'end_at' => 'required',
            'user_id' => 'required',
            'project_id' => 'required',
        ]);

        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->status = $request->status;
        $task->started_at = $request->started_at;
        $task->end_at = $request->end_at;
        $task->user_id = $request->user_id;
        $task->project_id = $request->project_id;

        if ($task->save()) {
            // dd($task);
            // Redirect to the "admin.dashboard" route with a success message
            return redirect()->route('list.task', $task->project->id)->with('success', 'Task has been created successfully');
        } else {
            // If there's an error, redirect back with an error message
            return back()->with('error', 'An error occurred while creating the task.');
        }
    }

    // public function edit(Request $request, string $id)
    // {

    //     $task = Task::findOrFail($id); 
    //     $project = $task->project; 
    //     $users = DesignationUser::where('designation_id', $project->designation_id)->get();
    //     $projects = Project::all();
        
    //     if ($request->ajax()) {
    //         // Render the view to a string
    //         $html = view('admin.task.edit', compact('task','users', 'project' ))->render();
    //         return response()->json(['html' => $html]);
    //     }

    //     return view('admin.task.edit', compact('task', 'users', 'projects'));
    // }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'status' => 'required',
            'started_at' => 'required',
            'end_at' => 'required',

        ]);

        $task = Task::findOrFail($id);
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->status = $request->input('status');
        $task->started_at = $request->input('started_at');
        $task->end_at = $request->input('end_at');


        if ($task->save()) {
            return response()->json(['success' => true, 'message' => 'Project deleted successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Project not found'], 404);
        }
    }


    public function index(string $id)
    {
        $project = Project::findOrFail($id);
        $tasks = Task::with(['project', 'user'])
            ->where('project_id', $id)
            ->get();

        return view('admin.task.list', compact('tasks', 'project'));
    }


    public function delete(string $id)
    {
        $task = Task::findOrFail($id);

        // Delete associated records (e.g., comments)
        $task->comments()->delete(); // Adjust this based on your relationships

        // Delete the task
        $task->delete();

        return  redirect()->route('list.task', $task->project->id)->with('success', 'Task is Deleted Successfully');
    }




    public function updateStatus(string $id)
    {
        $task = Task::findOrFail($id);

        // Check if the task is already in 'Review'
        if ($task->status === 'Review') {
            return back()->with('info', 'Task is already in Review!');
        }

        // Check if the task is already 'Completed'
        if ($task->status === 'Completed') {
            return back()->with('info', 'Task is already Completed!');
        }

        // Update task status
        $task->status = 'Review';
        $task->save();

        return redirect()->route('employee.dasboard')->with('success', 'Task status updated to "In Review"');
    }
}
