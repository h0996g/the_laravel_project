<?php

namespace App\Http\Controllers;

use App\Models\Agence;
use App\Models\Client;
use Illuminate\Http\Request;
//  -----------
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    public function registerclient(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'phone'=>'required',
            'name'=>'required',
            'prenom'=>'required',
        ]);
        $user = User::where('email', $request->email)->first();

        if ($user) {
//            throw ValidationException::withMessages([
//                'email' => ['This email is alredy used'],
//            ]);
            return response()->json(['email'=>'This email is alredy used'],422);


        }
        $input=$request->except('prenom');
        $input['password']=Hash::make($input['password']);
        // $inputclient['user_id']=user()->id;
        $user=User::create($input);
        $inputclient=$request->only('prenom');
        $inputclient['user_id']=$user['id'];
        $userclient=Client::create($inputclient);
        $response['token']=$user->createToken($request->email)->plainTextToken;
//         na7itha 3la khater mdyro yro7 l Login wra my ymrki mch yodkhol tol lel App
        $response['user']=$user;
        $response['client']=$userclient;

        return response(json_encode($response),201);
    }



    public function registeragence(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'phone'=>'required',
            'name'=>'required',
            'address'=>'required',
        ]);
        $user = User::where('email', $request->email)->first();

        if ($user) {
//            throw ValidationException::withMessages([
//                'email' => ['This email is alredy used'],
//            ]);
            return response()->json(['email'=>'This email is alredy used'],422);

        }
        $input=$request->except('address');
        $input['password']=Hash::make($input['password']);
        // $inputclient['user_id']=user()->id;
        $user=User::create($input);
        $inputagence=$request->only('address');
        $inputagence['user_id']=$user['id'];
        $useragence=Agence::create($inputagence);
        $response['token']=$user->createToken($request->email)->plainTextToken;
//         na7itha 3la khater mdyro yro7 l Login wra my ymrki mch yodkhol tol lel App
        $response['user']=$user;
        $response['agence']=$useragence;

        return response(json_encode($response),201);
    }
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user ) {
//            throw ValidationException::withMessages([
//                'email' => ['Email is incorrect.'],
//
//            ]);
            return response()->json(['email'=>'Email is incorrect.'],422);

        }

        else if(! Hash::check($request->password, $user->password)){
//            throw ValidationException::withMessages([
//                'password' => ['password is incorrect.'],
//
//            ]);
            return response()->json(['password'=>'Email is incorrect.'],422);

        }
        $response=$user;
        $response['token']= $user->createToken($request->email)->plainTextToken;
        return $response;
    }
}
