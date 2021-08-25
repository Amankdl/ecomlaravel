<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Test extends Controller
{
    public function index()
    {
        return DB::table('categories')->where('status',1) -> get();
    }  
    
}
