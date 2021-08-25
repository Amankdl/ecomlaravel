<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        return view('admin/size') -> with('sizes', Size::all());
    }

    
    public function manage_size(Request $request)
    {
        if($request -> id){
            return view('admin/manage_size') -> with('size',Size::find($request -> id));
        }
        return view('admin/manage_size');
    }

    public function manage_size_process(Request $request)
    {
        $size = $request -> size;
        $id = $request -> id_for_edit; //if add mode than id will be -1.

        $request -> validate([
            'size' => 'required|unique:sizes,size,'.$id,
        ]);

        if($id > 0){ //edit mode
            $res = Size::find($id);
            $request -> session() -> flash('msg','Size updated sucessfully.');
        }else{ //add mode
            $res = new Size;
            $res -> status = 1;
            $request -> session() -> flash('msg','Size added sucessfully.');
        }
        
        $res -> size = $size;
        $res -> save();        
        return redirect('admin/size');
    }
    
    public function delete(Request $request){
        $id = $request -> id;
        Size::destroy([$id]);
        $request -> session() -> flash('msg','Size deleted sucessfully.');
        return redirect('admin/size');
    }

    public function update_status(Request $request, $status, $id){        
        $res = Size::find($id);
        $res -> status = $status ==  "active" ? 1 : 0 ;
        $res -> save();
        $request -> session() -> flash('msg','Status updated sucessfully.');
        return redirect('admin/size');
    }
}
