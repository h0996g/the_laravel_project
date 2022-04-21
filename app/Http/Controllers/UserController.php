<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getuser( Request $request)
    {
        $a= $request->user();
     $client = Client::where('user_id', $a['id'])->first();
     $agence = Agence::where('user_id', $a['id'])->first();
     if( $client){
$a['client']=$client;
     }
     if($agence){
      $a['agence']=$agence;   
     }
     return $a;
        
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
    public function updateagence(Request $request, $id)
    {
        $user = User::where('email', $request['email'])->first();
        $a=DB::table('users')->select('email')->where('id',$id)->get();

        if ($user&& $a!=$request['email']) {

            return response()->json(['email' => 'This email is already used'], 422);

        }
        user::where('id', $id)
        ->update(['name' => $request['name'],
    'email'=>$request['email'] ,'password'=>$request['password']=Hash::make($request['password']),'phone' => $request['phone']]);
    Agence::where('user_id',$id)
    ->update(['address' => $request['address']]);
        return 'that change happened 10 sec ago';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateclient(Request $request,$id)
    {

         $user = User::where('email', $request['email'])->first();
        
        $a=DB::table('users')->select('email')->where('id',$id)->get();
              
        if ($user && $a!=$request['email']) {
                 print($a);
                 print($request['email']);
            return response()->json(['email' => 'This email is already used'], 422);

        }
        user::where('id', $id)
        ->update(['name' => $request['name'],
    'email'=>$request['email'] ,'password'=>$request['password']=Hash::make($request['password']),'phone' => $request['phone']]);
    Client::where('user_id',$id)
    ->update(['prenom' => $request['prenom']]);
        return 'that change happened 10 sec ago';
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search($search)
    {
        $liste=DB::table('users')->join('clients','users.id','=','clients.user_id')
        ->select('users.name')->where('name' , 'like' ,$search.'%')->get();
        return $liste;
    }
}
