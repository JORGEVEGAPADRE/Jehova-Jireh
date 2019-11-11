<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\JobState;
//use Illuminate\Database\Eloquent\SoftDeletes;


class JobStatesController extends Controller
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
        $jobstates=JobState::all();
        return response()->json(['data' => $jobstates]);  
        
                
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
      $jobdescription=$data['jobdescription'];
      $validator = Validator::make(
        $data,
        [
            'jobdescription' => 'required'                
        ]
        );        
        $validator->validate();
        $jobstate = JobState::create([
          'jobdescription' => $jobdescription         
        ]);
        return response()->json(['data' => $jobstate, 'msg' => 'Situacion Laboral Creada Correctamente!']);
      }
   

    /**
     * Display the specified resource.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(Bank $bank)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(Bank $bank)
    {
      
     /* Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    }
    public function update(Request $request, JobState $jobstate)
    {
        $user = \JWTAuth::parseToken()->authenticate();
        $id=$request->id;
        $jobdescription=$request->jobdescription;  
        $jobstate = JobState::find($id);
        $jobstate->jobdescription= $jobdescription;  
               
        $jobstate->save();
        
        return response()->json(['data' => $jobstate, 'msg' => 'Situacion Laboral Modificada Correctamente!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Request $request, JobState $jobstate) {
        $user = \JWTAuth::parseToken()->authenticate();
        $jobstate->delete();
        return response()->json(['msg' => 'Situacion Laboral Eliminada Correctamente!']);
      }
}
