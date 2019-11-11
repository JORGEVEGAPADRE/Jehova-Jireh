<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Ministry;
//use Illuminate\Database\Eloquent\SoftDeletes;


class MinistriesController extends Controller
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
       // $jobstates = $user->jobstates()->get();
        $ministries=Ministry::all();
        return response()->json(['data' => $ministries]);          
                
    } 
    
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * 
     */
    
     public function store(Request $request) {
      $user = \JWTAuth::parseToken()->authenticate();
      $data = $request->all();
      $ministry=$data['ministry'];
      $validator = Validator::make(
        $data,
        [
            'ministry' => 'required'                
        ]
        );        
        $validator->validate();
        $ministry = Ministry::create([
          'ministry' => $ministry         
        ]);
        return response()->json(['data' => $ministry, 'msg' => 'Ministerio Creado Correctamente!']);
      }
   

    /**
     * Display the specified resource.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ministry $ministry)
    {
        $user = \JWTAuth::parseToken()->authenticate();
        $id=$request->id;
        $ministry2=$request->ministry;  
        $ministry = Ministry::find($id);
        $ministry->ministry= $ministry2;  
               
        $ministry->save();
        
        return response()->json(['data' => $ministry, 'msg' => 'La Descripcion del Ministerio Modificada Correctamente!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     */
    
    public function destroy(Request $request, Ministry $ministry) {
        $user = \JWTAuth::parseToken()->authenticate();
        $ministry->delete();
        return response()->json(['msg' => 'La Descripcion del Ministerio Eliminada Correctamente!']);
      }
}
