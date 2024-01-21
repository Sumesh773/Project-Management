<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DesignationCategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DesignationController;
Use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Middleware\Employee;
use App\Models\TaskComment;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {

           
                      //  ------------ Employees CRUD   --------------
  Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin.dasboard');  
  Route::get('/employees/list',[EmployeeController::class,'viewEmployee'])->name('list.employee');
  Route::get('/employees',[EmployeeController::class,'list'])->name('employees');
  Route::get('/employee/edit/{id}',[EmployeeController::class,'edit'])->name('edit.employee');
  Route::put('/employee/{id}',[EmployeeController::class,'update'])->name('update.employee');
  Route::post('/employees/list/delete/{id}',[EmployeeController::class,'delete'])->name('delete.employee');
            
                    // --------Project CRUD ------

  Route::get('/create/project',[ProjectController::class,'create'])->name('create.project');
  Route::post('/create/project',[ProjectController::class,'store'])->name('store.project');
  Route::get('/edit/project/{id}',[ProjectController::class,'edit'])->name('edit.project');
  Route::put('/update/project/{id}',[ProjectController::class,'update'])->name('update.project');
  Route::delete('dashboard/{id}',[ProjectController::class,'delete'])->name('delete.project');
   

                 // --------Task CRUD ------
   Route::get('/create/task/{id}',[TaskController::class,'create'])->name('create.task');              
   Route::post('/dashboard',[TaskController::class,'store'])->name('store.task');              
   Route::get('/task/list/{id}', [TaskController::class, 'index'])->name('list.task');         
  //  Route::get('/edit/task/{id}',[TaskController::class,'edit'])->name('edit.task');              
   Route::put('/task/list{id}',[TaskController::class,'update'])->name('update.task');              
   Route::delete('/task/list{id}',[TaskController::class,'delete'])->name('delete.task');              
   Route::get('/task/comment/{id}',[CommentController::class,'viewComment'])->name('view.comment'); 
   Route::post ('/task',[CommentController::class,'adminComment'])->name('admin.comment');             
   Route::get('/projects',[ProjectController::class,'project'])->name('project');

            // --------Categoires CRUD-----------
  Route::get('/catrgories',[DesignationController ::class,'index'])->name('view.categories');
  // Route::get('/create/catrgory',[DesignationController ::class,'create'])->name('create.categories');
  Route::post('/create/catrgory',[DesignationController ::class,'store'])->name('store.categories');


                    // --------------Designation-----------
  // Route::get('/create/designation',[DesignationController::class,'create'])->name('create.destignation');
  // Route::post('/create/designation',[DesignationController::class,'store'])->name('store.destignation');
  // Route::get('/designation/list',[DesignationController::class,'showDesignations'])->name('view.destignation');

});


Route::prefix('employee')->middleware(['auth', 'employee'])->group(function () {
    Route::get('/dashboard',[EmployeeController::class,'dashboard'])->name('employee.dasboard');
    Route::get ('/task/{id}',[EmployeeController::class,'viewTask'])->name('view.task');
    Route::post ('/task',[CommentController::class,'addComment'])->name('add.comment');
    Route::post('/task/{id}',[TaskController::class,'updateStatus'])->name('update.status');
    Route::delete('/task/{id}',[TaskController::class,'deleteComment'])->name('delete.comment');
  });

  // Route::post ('/task',[CommentController::class,'addComment'])->name('add.comment');
  Route::get('/phpinfo', function() {

    phpinfo();
    if (extension_loaded('gd') && function_exists('gd_info')) {
        echo "GD Library is enabled on this PHP installation.";
    } else {
        echo "GD Library is not enabled or installed.";
    }
});