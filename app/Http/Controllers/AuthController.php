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

            // 'device_name' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();

        if ($user) {
//            throw ValidationException::withMessages([
//                'email' => ['This email is alredy used']
//            ]);
            return response()->json(['email' => 'This email is alredy used'], 422);
        }

//        $ala['prenom']=$request['prenom'];
        $input=$request->except('prenom');

        $ala['prenom']=$request['prenom'];


        $input['password']=Hash::make($input['password']);
        $user=User::create($input);
        $ala['user_id']=$user['id'];
        $client=Client::create($ala);





         $response['token']=$user->createToken($request->email)->plainTextToken;
        $response['user']=$user;
        $response['client']=$client;

        return response(json_encode($response),201);
    }



    public function registeragence(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            // 'device_name' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();

        if ($user) {

            return response()->json(['email' => 'This email is alredy used'], 422);

        }
        $input=$request->except('address');
        $input['password']=Hash::make($input['password']);
        $ala['address']=$request['address'];
        $user=User::create($input);
        $ala['user_id']=$user['id'];
        $client=Agence::create($ala);
        $response['token']=$user->createToken($request->email)->plainTextToken;
        $response['user']=$user;
        $response['agence']=$client;

        return response(json_encode($response),201);
    }


    public function LoginClient(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'The email or password is incorrect.'], 422);

        }
        $client = Client::where('user_id', $user['id'])->first();
        if (!$client) {

            return response()->json(['message' => 'The email or password is incorrect.'], 422);

        }

        $response = $user;
        $response['token'] = $user->createToken($request->email)->plainTextToken;
        $response['client'] = $client;

        return $response;
    }

    public function LoginAgence(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();



    if (!$user || !Hash::check($request->password, $user->password)) {

        return response()->json(['message' => 'The email or password is incorrect.'], 422);

    }
    $agence = Agence::where('user_id', $user['id'])->first();
    if (!$agence) {

        return response()->json(['message' => 'The email or password is incorrect.'], 422);

    }

    $response = $user;
    $response['token'] = $user->createToken($request->email)->plainTextToken;
    $response['agence'] = $agence;

    return $response;
}
}
