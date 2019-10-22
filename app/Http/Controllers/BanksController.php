<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Bank;
//use Illuminate\Database\Eloquent\SoftDeletes;


class BanksController extends Controller
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
       //$banks = $user->banks()->get();
        $banks=Bank::all();
        return response()->json(['data' => $banks]);
        
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
          'bank' => 'required'
        ]);
  
        $user = \JWTAuth::parseToken()->authenticate();
  
        
        $bank = Bank::create([
          'namebank' => $request->bank         
        ]);
        return response()->json(['data' => $bank, 'msg' => 'Banco Creado Correctamente!']);
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
    public function update(Request $request, Bank $bank)
    {
        $user = \JWTAuth::parseToken()->authenticate();
        $id=$request->id;
        $namebank=$request->namebank;  
        $bank = Bank::find($id);
        $bank->namebank= $namebank;  
               
        $bank->save();
        
        return response()->json(['data' => $bank, 'msg' => 'Banco Modificado Correctamente!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Bank  $bank
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Request $request, Bank $bank) {
        $user = \JWTAuth::parseToken()->authenticate();
        $bank->delete();
        return response()->json(['msg' => 'Banco Eliminado Correctamente!']);
      }
}
