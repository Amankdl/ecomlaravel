<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    
    public function index()
    {
        if(!session() -> has("ADMIN_LOGGED_IN")){
            return view("admin.login");
        }else{
            return redirect('admin/dashboard');
        }
    }

    public function auth(Request $request)
    {
        $email = $request -> email;
        $password =  $request -> password;
        $result = Admin::where(['email' => $email]) -> get();
        if(count($result) == 1){
            if(Hash::check($password, $result[0] -> password)){
                $request -> session() -> put('ADMIN_LOGGED_IN', true);
                $request -> session() -> put('ADMIN_ID', $result[0] -> id);
                return redirect('admin/dashboard');
            }else{
                $request -> session() -> flash('error','Invalid Password');
                return redirect('admin');
            }
        }else{
            $request -> session() -> flash('error','Invalid Email');
            return redirect('admin');
        }
    }

    public function dashboard()
    {
        return view("admin.dashboard");
    }

    // public function update_password(){
    //     $res = Admin::find(2);
    //     $res -> password = Hash::make("yash");
    //     $res -> save();
    // }
}
