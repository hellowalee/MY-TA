<?php

namespace App\Http\Controllers;
use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function ud(){
        $userjson = User::all()->where('attendance',1);
        $users = array();
        foreach($userjson as $user) {
            if(strpos($user, "ud"))array_push($users, $user);   
        }
        $count = DB::table('pages')->where('id', 6)->first();
        return view('perusahaan.ud',['count' =>$users[$count->count%sizeof($users)]->password]);
     }
     public function cv(){
        $userjson = User::all()->where('attendance',1);
        $users = array();
        foreach($userjson as $user) {
            if(strpos($user, "cv"))array_push($users, $user);   
        }
        $count = DB::table('pages')->where('id', 3)->first();
        return view('perusahaan.cv',['count' =>$users[$count->count%sizeof($users)]->password]);
     }
     public function pt(){
         $userjson = User::all()->where('attendance',1);
        $users = array();
        foreach($userjson as $user) {
            if(strpos($user, "pt"))array_push($users, $user);   
        }
        $count = DB::table('pages')->where('id', 4)->first();
        return view('perusahaan.pt',['count' =>$users[$count->count%sizeof($users)]->password]);
     }
     

}
