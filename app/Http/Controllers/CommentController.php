<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Task;

class CommentController extends Controller
{
    public function addComment(Request $request)
    {
        $request->validate([
            'comment' => 'required',
        ]);
    
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->task_id = $request->task_id;
    
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $comment->user_id = $user_id;
        }
    
        if ($comment->save()) {
            return response()->json(['success' => true, 'message' => 'Message send successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Project not found'], 404);
        }
    }


    public function adminComment(Request $request,)
    {

        // dd($request->all()); 
        $request->validate([
            'comment' => 'required',
        ]);
    
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->task_id = $request->task_id;
    
        if (auth()->check()) {
            $user_id = auth()->user()->id;
            $comment->user_id = $user_id;
        }
    
        if ($comment->save()) {
            return response()->json(['success' => true, 'message' => 'Message send successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Project not found'], 404);
        }
    }


    public function viewComment(string $id)
    {

        $task = Task::where('id', $id)->first();
         return view('admin.comment.view')->with('task', $task);

        // if ($task) {
        //     $user = User::where('role_id', 2)->get();
        //     return view('admin.task.create')->with('project', $project)->with('user', $user);
        // } else {
        //     abort(404);
        }

        public function deleteComment(string $id)
        {
            $task = Comment::findOrFail($id);
        
            // Delete associated records (e.g., comments)
            $task->comments()->delete(); // Adjust this based on your relationships
        
            // Delete the task
            $task->delete();
        
            return back();
        }

    }

