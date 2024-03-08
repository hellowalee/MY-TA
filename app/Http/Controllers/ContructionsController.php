<?php

namespace App\Http\Controllers;
use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ContructionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function home(){
        return view('contructions.01_home',[]);
     }

     public function home2(){
      return view('contructions.02_home',[]);
   }

   public function equipments(){
      return view('contructions.03_equipment-categories',[]);
   }

   public function equipments2(){
      return view('contructions.04_equipment-categories',[]);
   }

   public function allequipments(){
      return view('contructions.05_all-equipments-list',[]);
   }

}