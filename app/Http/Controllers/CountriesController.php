<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Country;
//use Illuminate\Database\Eloquent\SoftDeletes;


class CountriesController extends Controller
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
        $countryoptions=Country::all();
        return response()->json(['data' => $countryoptions]);
        
    } 
    
   
}
