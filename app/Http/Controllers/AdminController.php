<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\Designation;

use Illuminate\Http\Request;

class AdminController extends Controller
{
   public function dashboard(){
         $project = Project::with('designation')->get();
         $category = Designation::get();
         // dd($project);
         return view('admin.project')->with('project', $project)->with('category', $category);
     
   }
}
