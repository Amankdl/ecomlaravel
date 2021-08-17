<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        return view('admin/coupon') -> with('coupons', Coupon::all());
    }

    
    public function manage_coupon(Request $request)
    {
        if($request -> id){//for edit mode
            return view('admin/manage_coupon') -> with('coupon',Coupon::find($request -> id));
        }
        return view('admin/manage_coupon'); //for add mode
    }

    public function manage_coupon_process(Request $request)
    {
        $title = $request -> title;
        $code = $request -> code;
        $value = $request -> value;
        $id = $request -> id_for_edit; //if add mode than id will be -1.

        $request -> validate([
            'title' => 'required',
            'code' => 'required|unique:coupons,code,'.$id,
            'value' => 'required',
        ]);

        if($id > 0){ //edit mode
            $res = Coupon::find($id);
            $request -> session() -> flash('msg','Coupon updated sucessfully.');
        }else{ //add mode
            $res = new Coupon;
            $request -> session() -> flash('msg','Coupon added sucessfully.');
        }
        
        $res -> title = $title;
        $res -> code = $code;
        $res -> title = $title;
        $res -> value = $value;
        $res -> save();        
        return redirect('admin/coupon');
    }
    
    public function delete(Request $request){
        $id = $request -> id;
        Coupon::destroy([$id]);
        $request -> session() -> flash('msg','Coupon deleted sucessfully.');
        return redirect('admin/coupon');
    }
}
