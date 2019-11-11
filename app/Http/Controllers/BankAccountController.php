<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\bankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       /* $user = \JWTAuth::parseToken()->authenticate();
        //$banks = $user->banks()->get();
       */   
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
    public function store(Request $request,bankAccount $bankAccount) {
        $user = \JWTAuth::parseToken()->authenticate();
        $data = $request->all();
        $bank_id=$data['bank_id'];
        $accountnumber=$data['accountnumber'];
        $openamount=$data['openamount'];
        $created_at=$data['created_at'];        
        $validator = Validator::make(
            $data,
            [
                'bank_id' => 'required',
                'accountnumber' => 'required',                
            ]
        );        
        $validator->validate(); 
        $bankAccount = bankAccount::create([          
            'bank_id' =>$bank_id,
            'accountnumber'=>$accountnumber,
            'openamount'=>$openamount,
            'created_at'=>date("Y-m-d",strtotime($created_at))
          ]); 
        return response()->json(['data' => $bankAccount, 'msg' => 'Cuenta Creada Correctamente!']);
      }


/* original
    public function store(Request $request) {
        
        $user = \JWTAuth::parseToken()->authenticate();
        $this->validate($request, [
          'bank_id' => 'required',
          'accountnumber'=>'required',
          'created_at'=>'required'
        ]);
        $account = bankAccount::create([          
          'bank_id' => $request->bank_id,
          'accountnumber'=>$request->accountnumber,
          'openamount'=>$request->openamount,
          'created_at'=>date("Y-m-d",strtotime($request->created_at))
        ]); 
        return response()->json(['data' => $account, 'msg' => 'Cuenta Creada Correctamente!']);
       
      }

*/

    

    /**
     * Display the specified resource.
     *
     * @param  \App\bankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \JWTAuth::parseToken()->authenticate();
        //$id=$request->id;        
        $accounts=bankAccount::where('bank_id','=',$id)->get();       
         return response()->json(['data' => $accounts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\bankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(bankAccount $bankAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\bankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */

  
    public function update(Request $request,$id) 
    {
        $user = \JWTAuth::parseToken()->authenticate();
        $data = $request->all();
        //$id=$data['id'];
        $validator = Validator::make(
            $data, 
            [
                'bank_id' => 'required',
                'accountnumber' => 'required|unique|min:5'                
            ]
        );
        $validator->validate();
        $account = bankAccount::find($id);
        $account->bank_id= $data['bank_id'];
        $account->accountnumber= $data['accountnumber'];
        $account->openamount= $data['openamount'];
        $account->created_at=date("Y-m-d",strtotime($data['created_at']));
        $account->save();
   
        return response()->json(['data' => $account, 'msg' => 'Datos de la Cuenta Actualizados Correctamente!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\bankAccount  $bankAccount
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        $user = \JWTAuth::parseToken()->authenticate();
        $account = bankAccount::find($id);
        $account->delete();
        return response()->json(['data' => $account,'msg' => 'Cuenta dada de Baja Correctamente!']);
    }
}
