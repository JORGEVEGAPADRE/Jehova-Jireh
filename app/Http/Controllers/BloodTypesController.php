<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\BloodType;
//use Illuminate\Database\Eloquent\SoftDeletes;


class BloodTypesController extends Controller
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
        $bloodtypeoptions=BloodType::all();
        return response()->json(['data' => $bloodtypeoptions]);
        
    } 
    
   
}
