<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgenceController extends Controller
{
    public function getnamephon(Request $request){

        $liste=DB::table('agences')->join('offers','agences.id','=','offers.agence_id')
            ->join('users','agences.user_id','=','users.id')
            ->select('name','phone')->where('offers.id',$request['offer_id'])->get();
        return $liste;

    }

}
