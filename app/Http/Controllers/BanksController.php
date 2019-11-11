<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
   /* original 
    public function index()
    {
       $user = \JWTAuth::parseToken()->authenticate();       
        $banks=Bank::all();
        return response()->json(['data' => $banks]);
        
    } original fin*/
/* ultima actualizacion de original
    public function index(Request $request)
{
    $banks = Bank::orderBy('id', 'ASC')->paginate(10);
    return [
        'pagination' => [
            'total'        => $banks->total(),
            'current_page' => $banks->currentPage(),
            'per_page'     => $banks->perPage(),
            'last_page'    => $banks->lastPage(),
            'from'         => $banks->firstItem(),
            'to'           => $banks->lastItem(),
        ],
        'banks' => $banks
    ];
}
  fin de ultima actualizacion de original */    
  public function index(Request $request)
  {
      $user = \JWTAuth::parseToken()->authenticate();
      if ( $request->input('client') ) {
          return Bank::select('id', 'namebank')->get();
      } 

      $columns = ['id', 'namebank'];

      $length = $request->input('length');
      $column = $request->input('column'); //Index
      $dir = $request->input('dir');
      $searchValue = $request->input('search');

      $query = Bank::select('id', 'namebank')->orderBy($columns[$column], $dir);

      if ($searchValue) {
          $query->where(function($query) use ($searchValue) {
              $query->where('namebank', 'like', '%' . $searchValue . '%');
             // ->orWhere('status', 'like', '%' . $searchValue . '%');
          });
      }

      $banks = $query->paginate($length);
      return ['data' => $banks, 'draw' => $request->input('draw')];
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
        $data = $request->all();
        $namebank=$data['namebank'];        
        $validator = Validator::make(
            $data,
            [
                'namebank' => 'required'                
            ]
        );        
        $validator->validate(); 
        $bank = Bank::create([
          'namebank' =>$namebank     
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
