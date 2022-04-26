<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function ajoutermessage(Request $request){

        $flight = Message::create([
            'text' => $request['text'],
            'user_id' => $request['user_id'],
            'offer_id' => $request['offer_id'],
        ]);
        return 'message send';

    }
    public function deletemessage($id){

        Message::where('id', $id)

            ->delete();
        return 'remove message seccessfully';


    }
    public function getmessage($id){


        return $favorite = Message::where('offer_id',$id )->orderby('created_at','asc')->get();

    }
}
