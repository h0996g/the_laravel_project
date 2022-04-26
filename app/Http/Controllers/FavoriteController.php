<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Offer;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function getfavorite($id){

        return $favorite = Favorite::where('client_id',$id )->get();

    }
    public function ajouterfavorit(Request $request){

        $flight = Favorite::create([
            'client_id' => $request['client_id'],
            'offer_id' => $request['offer_id'],
        ]);
        return 'ok';
    }
    public function deletefavorite($idclient,$idoffer){

        Favorite::where('client_id', $idclient)->where('offer_id',$idoffer)

            ->delete();
        return 'remove offer seccessfully';

    }
}
