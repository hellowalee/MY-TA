<?php

namespace App\Http\Controllers;
use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class IzinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function pirt(){
         $userjson = User::all()->where('attendance',1);
        $users = array();
        foreach($userjson as $user) {
            if(strpos($user, "pirt"))array_push($users, $user);   
        }
        $count = DB::table('pages')->where('id', 1)->first();
        return view('izin.pirt',['count' =>$users[$count->count%sizeof($users)]->password]);
     }
     public function mypirt(){
        return view('izin.mypirt',['count' =>'6281573632114']);
     }
     public function nib(){
         $userjson = User::all()->where('attendance',1);
        $users = array();
        foreach($userjson as $user) {
            if(strpos($user, "nib"))array_push($users, $user);   
        }
        $count = DB::table('pages')->where('id', 2)->first();
        return view('izin.nib',['count' =>$users[$count->count%sizeof($users)]->password]);
     }
     public function siup(){
         $userjson = User::all()->where('attendance',1);
        $users = array();
        foreach($userjson as $user) {
            if(strpos($user, "siup"))array_push($users, $user);   
        }
        $count = DB::table('pages')->where('id', 6)->first();
        return view('izin.siup',['count' =>$users[$count->count%sizeof($users)]->password]);
     }
     public function halal(){
         return view('izin.halal');
     }
     public function haki(){
         return view('izin.haki');
     }
     


    // public function index()
    // {
    //     $agent = new Agent();
    //     $images = Image::all();
    //     $videos = Video::all();
    //     $photos = Photo::all();

    //     date_default_timezone_set('Asia/Jakarta');
    //     $tanggal = mktime(date("m"), date("d"), date("Y"));

    //     $check = DB::table('pageviews')->where('dates', date("d-M-Y", $tanggal))->exists();
    //     if ($check == true) {
    //         Pageview::where('dates', date("d-M-Y", $tanggal))
    //         ->update([
    //             'views'=> DB::raw('views+1'), 
    //           ]);
    //     } else {
    //         Pageview::create([
    //             'name' => "Home",
    //             'views' => 1,
    //             'dates' => date("d-M-Y", $tanggal),
    //         ]);
    //     }
    //     $pageview = 0;

    //     $schedules = Schedule::all()->sortBy([
    //         ['date', 'desc'],
    //     ])->take(3);
    //     return view('index', ['pageview' => $pageview, 'images' => $images, 'videos' => $videos, 'photos' => $photos, 'schedules' => $schedules, 'agent' => $agent]);
    // }

    // public function moto()
    // {
    //     $agent = new Agent();
    //     return view('moto', ['agent' => $agent, 'title' => "Moto & Visi Misi"]);
    // }

    // public function profil()
    // {
    //     $agent = new Agent();
    //     return view('profil', ['agent' => $agent, 'title' => "Profil"]);
    // }

    // public function instansi()
    // {
    //     $agent = new Agent();
    //     return view('instansi', ['agent' => $agent, 'title' => "Instansi"]);
    // }

    // public function asalusul()
    // {
    //     $agent = new Agent();
    //     return view('asal-usul', ['agent' => $agent, 'title' => "Asal Usul"]);
    // }

    // public function pelayanan()
    // {
    //     $agent = new Agent();
    //     return view('pelayanan', ['agent' => $agent, 'title' => "Pelayanan"]);
    // }

    // public function petawilayah()
    // {
    //     $agent = new Agent();
    //     return view('petawilayah', ['agent' => $agent, 'title' => "Peta Wilayah"]);
    // }

    // public function bataswilayah()
    // {
    //     $agent = new Agent();
    //     return view('bataswilayah', ['agent' => $agent, 'title' => "Batas Wilayah"]);
    // }

    // public function datapenduduk()
    // {
    //     $agent = new Agent();
    //     return view('datapenduduk', ['agent' => $agent, 'title' => "Data Penduduk"]);
    // }

    // public function datalpmk(){
    //     $agent = new Agent();
    //     return view('datalpmk', ['agent' => $agent, 'title' => "Data Lpmk"]);
    // }

    // public function datapkk(){
    //     $agent = new Agent();
    //     return view('datapkk', ['agent' => $agent, 'title' => "Data PKK"]);
    // }

    // public function datapaud(){
    //     $agent = new Agent();
    //     return view('datapaud', ['agent' => $agent, 'title' => "Data PAUD"]);
    // }

    // public function kontak()
    // {
    //     $agent = new Agent();
    //     return view('kontak', ['agent' => $agent, 'title' => "Kotak Saran"]);
    // }

    // public function video_full()
    // {
    //     $agent = new Agent();
    //     $videos = DB::table('videos')->paginate(10);
    //     return view('video-full', ['videos' => $videos, 'agent' => $agent, 'title' => "Detail"]);
    // }

    // public function photo_full()
    // {
    //     $agent = new Agent();
    //     $photos = DB::table('photos')->paginate(9);
    //     return view('photo-full', ['photos' => $photos, 'agent' => $agent, 'title' => "Detail"]);
    // }

    // public function schedule_full()
    // {
    //     $agent = new Agent();
    //     $schedules = DB::table('schedules')->paginate(9);
    //     return view('schedule-full', ['schedules' => $schedules, 'agent' => $agent, 'title' => "Detail"]);
    // }

    // public function card_1()
    // {
    //     $images = Image::all();
    //     $videos = Video::all();
    //     $photos = Photo::all();
    //     $type = "video";
    //     return view('card', ['type' => $type, 'images' => $images, 'videos' => $videos, 'photos' => $photos]);
    // }
    // public function card_2()
    // {
    //     $images = Image::all();
    //     $videos = Video::all();
    //     $photos = Photo::all();
    //     $type = "photo";
    //     return view('card', ['type' => $type, 'images' => $images, 'videos' => $videos, 'photos' => $photos]);
    // }
}
