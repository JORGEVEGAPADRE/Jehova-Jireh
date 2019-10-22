<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\CivilState;
//use Illuminate\Database\Eloquent\SoftDeletes;


class CivilStatesController extends Controller
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
       //$civilstates = $user->civilstates()->get();
      $civilstates=CivilState::all();
       
     return response()->json(['data' => $civilstates]);   
     
        
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
     */

     
     public function store(Request $request) {
        
        $this->validate($request, [
          'civilstate' => 'required'
        ]);
  
        $user = \JWTAuth::parseToken()->authenticate();
  
        
        $civilstate = CivilState::create([
          'statedescription' => $request->civilstate
          
          
        ]);
        return response()->json(['data' => $civilstate, 'msg' => 'Estado Civil Creado Correctamente!']);
      }
   

    /**
     * Display the specified resource.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function show(CivilState $civilstate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    public function edit(CivilState $civilstate)
    {
      
     /* Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    }

    public function update(Request $request, CivilState $civilstate)
    {
        $user = \JWTAuth::parseToken()->authenticate();
        $id=$request->id;
        $statedescription=$request->statedescription;  
        $civilstate = CivilState::find($id);
        $civilstate->statedescription= $statedescription;  
               
        $civilstate->save();
        
        return response()->json(['data' => $civilstate, 'msg' => 'Estado Civil Modificado Correctamente!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */    

    public function destroy(Request $request, CivilState $civilstate) {
        $user = \JWTAuth::parseToken()->authenticate();
        $civilstate->delete();
        return response()->json(['msg' => 'Estado Civil Eliminado Correctamente!']);
      }
}
