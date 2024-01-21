<?php

namespace App\Http\Controllers;

use App\Models\DesignationUser;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\TaskComment;
use DataTables;

class EmployeeController extends Controller
{
   public function dashboard()
   {

      if (auth()->check()) {
         $userName = auth()->user()->id;
         $tasks = Task::where('user_id', $userName)->get();
         // dd($tasks);

         if (!$tasks->isEmpty()) {
            // Perform actions related to tasks that match the user ID
            return view('employee.project')->with('task', $tasks);
         } else {
            return view('employee.project')->with('message', 'You Have Not  Assing any Task');
         }
      }
   }

   public function viewTask(Request $request, string $id)
   {
       $task = Task::with(['project', 'user', 'comments'])->find($id);
   
       return view('employee.task.view', ['task' => $task]);
   }
   


   public function list()
   {
      $users = User::where('role_id', 2)->get();
      // $designation = DesignationUser::all();

      return Datatables::of($users)->addIndexColumn()
         ->addColumn('#', function ($row) {
            return $row->id;
         })
         ->addColumn('Name', function ($row) {
            return $row->name;
         })
         ->addColumn('Email', function ($row) {
            return $row->email;
         })

         ->addColumn('Phone Number', function ($row) {
            return $row->phone_no;
         })
         ->addColumn('action', function ($row) {
            return '<a href="/admin/employee/edit/' . $row->id . '" class="btn btn-primary">Edit</a>
      <button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal-' . $row->id . '" data-delete-url="/admin/employees/list/delete/' . $row->id . '" data-modal-id="deleteModal-' . $row->id . '">Delete</button>
      <div class="modal fade" id="deleteModal-' . $row->id . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                              <p>Are you sure you want to delete this user?</p>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-danger confirm-delete-btn">Delete</button>
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          </div>
                      </div>
                  </div>
              </div>';
         })

         ->rawColumns(['action'])
         ->make(true);
   }

   public function viewEmployee()
   {
      return view('admin.employee');
   }


   public function edit(string $id)
   {
      $user = User::findorFail($id);
      return view('admin.empform')->with('user', $user);
   }

   public function update(Request $request, string $id)
   {
      $validated = $request->validate([
         'name' => 'required|max:255',
         'email' => 'required|unique:users,email,' . $id,
         'phone_no' => 'required|unique:users,phone_no,' . $id,
      ]);
      $user = User::findorFail($id);
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->phone_no = $request->input('phone_no');
      if ($user->save()) {
         return back()->with('success', 'Updated Successfully');
      }
   }

   public function delete(string $id)
   {
      $user = User::findorFail($id);
      if ($user) {
         $task = Task::where('user_id', $user->id)->get();
         if(count($task) > 0){
            foreach($task as $item){
               $item->delete();
            }
         }
      }


      $user->delete();
      return back()->with('success', 'Employee deleted successfully.');
   }
}
