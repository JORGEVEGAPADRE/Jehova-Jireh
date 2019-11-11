<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ChurchJob;
//use Illuminate\Database\Eloquent\SoftDeletes;


class ChurchesController extends Controller
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
        $churchjobs=ChurchJob::all();
        return response()->json(['data' => $churchjobs]);
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
        $user = \JWTAuth::parseToken()->authenticate();
        $this->validate($request, [
          'churchjob' => 'required'          
        ]);
        $churchjob = ChurchJob::create([
          'churchjob' => $request->churchjob
          //'hierarchy_id'=>$request->hierarchy_id
         
        ]);
        return response()->json(['data' => $churchjob, 'msg' => 'Cargo Eclesiastico Creado Correctamente!']);
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
   /* public function edit(Bank $bank)
    {
      
     /* Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     
    } */
    
    public function update(Request $request, ChurchJob $churchjob)
    {
        $user = \JWTAuth::parseToken()->authenticate(); 
        
        $id=$request->id;
        $churchjob=$request->churchjob;  
        $churchjob2= ChurchJob::find($id);
        $churchjob2->churchjob= $churchjob;  
               
        $churchjob2->save();
        
        return response()->json(['data' => $churchjob2, 'msg' => 'Cargo Eclesiastico Modificado Correctamente!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id) {
        $user = \JWTAuth::parseToken()->authenticate();       
        $churchjob= ChurchJob::find($id);
        $churchjob->delete();
        return response()->json(['msg' => 'Cargo Eclesiastico Eliminado Correctamente!']);
      }
}
