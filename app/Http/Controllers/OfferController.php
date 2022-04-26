<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function createoffer(Request $request){



        $flight = Offer::create([
            'agence_id' => $request['agence_id'],
            'category_id' => $request['category_id'],
            'address' => $request['address'],
            'description' => $request['description'],
            'price' => $request['price'],
            'space' =>  $request['space'],
            'n_etage' =>  $request['n_etage'],
            'n_chambre' =>  $request['n_chambre'],
            'wilaya' =>  $request['wilaya'],
            'photo'=>  $request['photo'],
            'type_vente' =>  $request['type_vente'],
            'type_offer' =>  $request['type_offer'],
            'condition_de_paiment' =>  $request['condition_de_paiment'],
            'specification' =>  $request['specification'],
            'papiers' =>  $request['papiers'],
        ]);
        return 'offer has been added';
    }

    public function updateoffer(Request $request,$id){
            Offer::where('id', $id)

            ->update([
                'agence_id' => $request['agence_id'],
                'category_id' => $request['category_id'],
                'address' => $request['address'],
                'description' => $request['description'],
                'price' => $request['price'],
                'space' =>  $request['space'],
                'n_etage' =>  $request['n_etage'],
                'n_chambre' =>  $request['n_chambre'],
                'wilaya' =>  $request['wilaya'],
                'photo'=>  $request['photo'],
                'type_vente' =>  $request['type_vente'],
                'type_offer' =>  $request['type_offer'],
                'condition_de_paiment' =>  $request['condition_de_paiment'],
                'specification' =>  $request['specification'],
                'papiers' =>  $request['papiers'],
                     ]);
        return 'the offer has been updated';


    }


    public function getofferall(){

        return $offer = Offer::where('id', '!=', auth()->id())->get();


    }


    public function getofferid($id,$idclient,$idoffer){
        $offers['ala'] = Offer::where('id',$id )->get();
        $a=Favorite::where('client_id',$idclient)->where('offer_id',$idoffer)->get();
        if($a){
            $offers['favorite']=true;
        }
        if(!$a){
            $offers['favorite']=false;
        }


        return $offers ;

    }


    public function getofferagence($id){

        return $offerss = Offer::where('agence_id',$id )->get();
    }


    public function getoffercategorie($id){


            $offersss = Offer::where('category_id',$id )->get();
            return $offersss;
    }



    public function deleteoffer($id){

        Offer::where('id', $id)

            ->delete();
        return 'offer deleted';
    }
}
