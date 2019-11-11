<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Hierarchy;

//use Illuminate\Database\Eloquent\SoftDeletes;

class HierarchiesController extends Controller
{
    //use SoftDeletes;    
    public function index()
    {
        $user = \JWTAuth::parseToken()->authenticate();       
        $hierarchies=Hierarchy::all();
        return response()->json(['data' => $hierarchies]);     
                
    } 
}
