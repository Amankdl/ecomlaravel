<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin/category') -> with('categories', Category::all());
    }

    
    public function manage_category(Request $request)
    {
        if($request -> id){
            return view('admin/manage_category') -> with('category',Category::find($request -> id));
        }
        return view('admin/manage_category');
    }

    public function manage_category_process(Request $request)
    {
        $category_name = $request -> category_name;
        $slug = $request -> slug;
        $id = $request -> id_for_edit; //if add mode than id will be -1.

        $request -> validate([
            'category_name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$id,
        ]);

        if($id > 0){ //edit mode
            $res = Category::find($id);
            $request -> session() -> flash('msg','Category updated sucessfully.');
        }else{ //add mode
            $res = new Category;
            $res -> status = 1;
            $request -> session() -> flash('msg','Category added sucessfully.');
        }
        
        $res -> category_name = $category_name;
        $res -> slug = $slug;
        $res -> save();        
        return redirect('admin/category');
    }
    
    public function delete(Request $request){
        $id = $request -> id;
        Category::destroy([$id]);
        $request -> session() -> flash('msg','Category deleted sucessfully.');
        return redirect('admin/category');
    }

    public function update_status(Request $request, $status, $id){        
        $res = Category::find($id);
        $res -> status = $status ==  "active" ? 1 : 0 ;
        $res -> save();
        $request -> session() -> flash('msg','Status updated sucessfully.');
        return redirect('admin/category');
    }
}
