<?php

namespace App\Http\Controllers;
use App\Models\Wedding;
use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class WeddingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function wedding(){
        return view('wedding.wedding');
     }
     public function registerWedding(){
        return view('wedding.register-wedding');
     }
     public function contohWedding(){
        return view('wedding.contoh-wedding');
     }
     
     public function addWedding(Request $request){
        //  return $request;
        $request->validate([
            "nicknameMale" => 'required',
            "fullnameMale" => 'required',
            "fathernameMale" => 'required',
            "mothernameMale" => 'required',
            "nicknameFemale" => 'required',
            "fullnameFemale" => 'required',
            "fathernameFemale" => 'required',
            "mothernameFemale" => 'required',
            
            "weddingDate" => 'required',
            "weddingHourStart" => 'required',
            "weddingHourEnd" => 'required',
            "weddingPlaceName" => 'required',
            "weddingPlaceAddress" => 'required',
            
            "solemnizationDate" => 'required',
            "solemnizationHourStart" => 'required',
            "solemnizationHourEnd" => 'required',
            "solemnizationPlaceName" => 'required',
            "solemnizationPlaceAddress" => 'required',
        ]);
        //   return $request;
        $photoMale = $request->photoMale ?: 'https://storage.googleapis.com/fastwork-static/6a19c479-994b-4572-8fb5-95bf378f71e6.jpg';
        $photoFemale = $request->photoFemale ?: 'https://i.pinimg.com/564x/28/2c/99/282c99f6b36c8cef076b9bac48ec335b.jpg';
        Wedding::create([
            "nicknameMale" => $request->nicknameMale,
            "fullnameMale" => $request->fullnameMale,
            "fathernameMale" => $request->fathernameMale,
            "mothernameMale" => $request->mothernameMale,
            "photoMale"=>$photoMale,
            "nicknameFemale" => $request->nicknameFemale,
            "fullnameFemale" => $request->fullnameFemale,
            "fathernameFemale" => $request->fathernameFemale,
            "mothernameFemale" => $request->mothernameFemale,
            "photoFemale"=>$photoFemale,
            
            "weddingDate" => $request->weddingDate,
            "weddingHourStart" => $request->weddingHourStart,
            "weddingHourEnd" => $request->weddingHourEnd,
            "weddingPlaceName" => $request->weddingPlaceName,
            "weddingPlaceAddress" => $request->weddingPlaceAddress,
            
            "solemnizationDate" => $request->solemnizationDate,
            "solemnizationHourStart" => $request->solemnizationHourStart,
            "solemnizationHourEnd" => $request->solemnizationHourEnd,
            "solemnizationPlaceName" => $request->solemnizationPlaceName,
            "solemnizationPlaceAddress" => $request->solemnizationPlaceAddress,
        ]);
        $id = DB::table('weddings')->where('fullnameMale', $request->fullnameMale)->where('fullnameFemale', $request->fullnameFemale)->value('id');
        $redirect="list-wedding/$id";
        return redirect($redirect)->with('status', 'Data Sukses Ditambah');
        
        
     }
     public function listWedding($id){
         $wedding = Wedding::all()->where('id', $id)->first();
        return view('wedding.list-wedding',['wedding'=>$wedding]);
     }
     public function invitationWedding($id){
         $wedding = Wedding::all()->where('id', $id)->first();
        return view('wedding.invitation-wedding',['wedding'=>$wedding]);
     }
    
     
     

}
