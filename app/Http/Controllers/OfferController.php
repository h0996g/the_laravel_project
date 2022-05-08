<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Offer;
use App\Models\User;
use App\Models\Agence;
use Illuminate\Http\Request;
use App\Http\Resources\OfferResource;
use App\Http\Resources\OfferCollection;

class OfferController extends Controller
{
    public function createoffer(Request $request){


        // $flight = Offer::create([
        //     'agence_id' => $request['agence_id'],
        //     'category_id' => $request['category_id'],
        //     'address' => $request['address'],
        //     'description' => $request['description'],
        //     'price' => $request['price'],
        //     'space' =>  $request['space'],
        //     'n_etage' =>  $request['n_etage'],
        //     'n_chambre' =>  $request['n_chambre'],
        //     'wilaya' =>  $request['wilaya'],
        //     'photo'=>  $request['photo'],
        //     'type_vente' =>  $request['type_vente'],
        //     'type_offer' =>  $request['type_offer'],
        //     'condition_de_paiment' =>  $request['condition_de_paiment'],
        //     'specification' =>  $request['specification'],
        //     'papiers' =>  $request['papiers'],
        // ]);
        $user = $request->user();
        $input=$request->except('agence_id');
       $agence = Agence::where('user_id', $user['id'])->first();
       $input['agence_id']=$agence['id'];
        $offer= Offer::create($input);
        return $offer->only(['description', 'price']);
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


    public function getofferagence(Request $request){

        $user = $request->user();
        $agence = Agence::where('user_id', $user['id'])->first();
    //    $input['agence_id']=$agence['id'];


        $offerss = Offer::where('agence_id',$agence['id'] )->get();

        //return response(OfferResource::collection($offerss), 200);
        return response(new OfferCollection($offerss),201);



        // $offerss['photo']=json_decode($offerss['photo']);

        // return $response()->json([
        //     'data'=>[
                // 'id'=>id,
                // 'agence_id'=>agence_id,
                // 'type_vente'=>type_vente,
                // 'address'=>address,
                // 'description'=>description,
                // 'price'=>price,
                // 'space'=>space,
                // 'n_etage'=>n_etage,
                // 'n_chambre'=>n_chambre,
                // 'wilaya'=>wilaya,
                // 'photo'=>[json_decode(photo)],
                // 'type_offer'=>type_offer,
                // 'condition_de_paiment'=>[json_decode(condition_de_paiment)],
                // 'specification'=>[json_decode(specification)],
                // 'papiers'=>[json_decode(papiers)],
                // 'created_at'=>$offerss['created_at'],
                // 'updated_at'=>updated_at,
            // ]
            // ]);
    }


    public function getoffercategorie($id){

        return $offersss = Offer::where('category_id',$id )->get();
    }



    public function deleteoffer($id){

        Offer::where('id', $id)

            ->delete();
        return 'offer deleted';
    }
}
