<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Gender;
//use Illuminate\Database\Eloquent\SoftDeletes;


class GendersController extends Controller
{
    //use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $user = \JWTAuth::parseToken()->authenticate();       
        $sexoptions=Gender::all();
        return response()->json(['data' => $sexoptions]);
        
    } 
    
   
}
