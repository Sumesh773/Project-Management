<?php

namespace App\Http\Controllers;

use App\Models\Designation;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class DesignationController extends Controller
{
    // public function create(){
    //     return view('admin.project.categories.create');
    // }


    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'image' => 'file|mimes:jpg,jpeg,png,gif',
        ]);
        $category = new Designation();
        $category->name = $request->name;
        $image = $request->file('image');
        $input['file'] = time() . '.' . $image->getClientOriginalExtension();
    
        $destinationPath = public_path('/images');
        $imgFile = Image::make($image->getRealPath());
        $imgFile->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath . '/' . $input['file']);
        $image->move($destinationPath, $input['file']);
        $category->image = $input['file'];
 
        if ($category->save()) {
            return response()->json(['success' => true, 'message' => 'Category Create successfully']);
        } else {
            return response()->json(['success' => false, 'message' => 'Project not found'], 404);
        }
    }
    

    public function index(){
        $category = Designation::get();
        return view('admin.project.categories.list')->with('category', $category);
    }
}
