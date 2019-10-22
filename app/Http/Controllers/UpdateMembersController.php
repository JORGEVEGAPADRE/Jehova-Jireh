<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
//use Illuminate\Validation\Validator;
use App\User;


class UpdateMembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $user = \JWTAuth::parseToken()->authenticate();
       $member=User::all();       
       return response()->json(['data' => $member]);
        
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = \JWTAuth::parseToken()->authenticate();
        $data = $request->all();
        $id=$data['id'];        
        $validator = Validator::make(
            $data,
            [
                'name' => 'required',
                'alternateemail' => 'email|different:email',
                'password' => 'required|min:8',
                'confirmpassword' => 'required|min:8|same:password'
            ]
        );

        $validator->validate();
        $member = User::find($id);
        $member->name= $data['name'];
        $member->lastname= $data['lastname'];
        $member->country_id=$data['country_id'];
        $member->sex_id=$data['sex_id'];
        $member->bloodtype_id= $data['bloodtype_id'];
        $member->birthdate=date("Y-m-d", strtotime($data['birthdate'])); 
        $member->rut= $data['rut'];   
        $member->civilstate_id= $data['civilstate_id'];
        $member->jobstate_id= $data['jobstate_id'];
        $member->occupation= $data['occupation'];
        $member->newbirthdate= date("Y-m-d", strtotime($data['newbirthdate'])); 
        $member->baptizeddate= date("Y-m-d", strtotime($data['baptizeddate']));
        $member->lifetestimony= $data['lifetestimony'];
        $member->email= $data['email'];
        $member->alternateemail= $data['alternateemail'];
        $member->phone=$data['phone'];
        $member->address= $data['address'];
        $member->notes= $data['notes'];       
        $member->password= bcrypt($data['password']);
        $member->confirmpassword=bcrypt($data['confirmpassword']);                      
        $member->save();
         
        return response()->json(['data' => $member, 'msg' => 'Datos del Miembro Actualizados Correctamente!']);
    }

  
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   
    public function destroy($id) {
        $user = \JWTAuth::parseToken()->authenticate();        
        $member = User::find($id);        
        $member->delete();
        return response()->json(['msg' => 'Miembro dado de Baja Correctamente!']);
      }
}
