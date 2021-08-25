<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        return view('admin/color') -> with('colors', Color::all());
    }

    
    public function manage_color(Request $request)
    {
        if($request -> id){
            return view('admin/manage_color') -> with('color',Color::find($request -> id));
        }
        return view('admin/manage_color');
    }

    public function manage_color_process(Request $request)
    {
        $color = $request -> color;
        $id = $request -> id_for_edit; //if add mode than id will be -1.

        $request -> validate([
            'color' => 'required|unique:colors,color,'.$id,
        ]);

        if($id > 0){ //edit mode
            $res = Color::find($id);
            $request -> session() -> flash('msg','Color updated sucessfully.');
        }else{ //add mode
            $res = new Color;
            $res -> status = 1;
            $request -> session() -> flash('msg','Color added sucessfully.');
        }
        
        $res -> color = $color;
        $res -> save();        
        return redirect('admin/color');
    }
    
    public function delete(Request $request){
        $id = $request -> id;
        Color::destroy([$id]);
        $request -> session() -> flash('msg','Color deleted sucessfully.');
        return redirect('admin/color');
    }

    public function update_status(Request $request, $status, $id){        
        $res = Color::find($id);
        $res -> status = $status ==  "active" ? 1 : 0 ;
        $res -> save();
        $request -> session() -> flash('msg','Status updated sucessfully.');
        return redirect('admin/color');
    }
}
