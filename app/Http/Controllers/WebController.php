<?php

namespace App\Http\Controllers;
use App\Models\Page;
use App\Models\User;
use App\Models\Kbproduct;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class WebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

      public function follower(){
          return view('web.follower');
      }

      public function aplikasi(){
        $userjson = User::all()->where('attendance',1);
        $users = array();
        foreach($userjson as $user) {
            if(strpos($user, "web"))array_push($users, $user);   
        }
        $count = DB::table('pages')->where('id', 5)->first();
        return view('web.aplikasi',['count' =>$users[$count->count%sizeof($users)]->password]);
      }
     public function web(){
        $userjson = User::all()->where('attendance',1);
        $users = array();
        foreach($userjson as $user) {
            if(strpos($user, "web"))array_push($users, $user);   
        }
        $count = DB::table('pages')->where('id', 5)->first();
        return view('web.web',['count' =>$users[$count->count%sizeof($users)]->password]);
     }
     public function herbal(){
        return view('web.produk.herbal');
     }
     public function wedding(){
        return view('web.produk.wedding');
     }
     public function birthday(){
        return view('web.produk.birthday');
     }
     public function contoh1(){
       return view('web.contoh1.index');
     }
     public function food(){
       return view('web.contoh1.food');
     }
     public function categories(){
       return view('web.contoh1.categories');
     }
     
     public function jasaplavonpvc(){
       return view('web.pembeli.jasaplavonpvc');
     }

     public function rosmelia_florist_bunga_papan_ucapan(){
      return view('web.pembeli.rosmelia_florist_bunga_papan_ucapan');
     }

     public function koperasisekolah(){
      return view('web.pembeli.koperasisekolah');
     }

     public function kembangbunga(){
      $products=Kbproduct::all();
      return view('web.pembeli.kembangbunga.index',compact('products'));
     }

     public function kembangbunga_produk($id){
      $product=Kbproduct::find($id);
      $product_all=Kbproduct::all();
      return view('web.pembeli.kembangbunga.produk',compact('product','id','product_all'));
     }

     public function kembangbunga_admin(){
      return view('web.pembeli.kembangbunga.admin');
     }

     public function kembangbunga_admin_produk(){
      $products=Kbproduct::all();
      return view('web.pembeli.kembangbunga.admin_produk',compact('products'));
     }

     public function kembangbunga_admin_produk_create(){
      return view('web.pembeli.kembangbunga.admin_produk_create');
     }

     public function kembangbunga_admin_produk_store(Request $request){
      $product = new Kbproduct;
      $product->jenis = $request->jenis;
      $product->jenis_detail = $request->jenis_detail;
      $product->kode = $request->kode;
      $product->harga = $request->harga;
      $product->tag = $request->tag;
      $product->kategori = $request->kategori;
      $product->dimensi = $request->dimensi;
      $product->gambar = $request->gambar;
      $product->save();
      return redirect('/kembangbunga/admin/produk');
     }

     public function kembangbunga_admin_produk_delete($id){
      $product=Kbproduct::find($id);
      $product->delete();
      return redirect('/kembangbunga/admin/produk');
     }

     public function kembangbunga_admin_produk_edit($id){
      $product=Kbproduct::find($id);
      return view('web.pembeli.kembangbunga.admin_produk_edit',compact('product','id'));
     }

     public function kembangbunga_admin_produk_update(Request $request, $id){
      $product=Kbproduct::find($id);
      $product->jenis = $request->jenis;
      $product->jenis_detail = $request->jenis_detail;
      $product->kode = $request->kode;
      $product->harga = $request->harga;
      $product->tag = $request->tag;
      $product->kategori = $request->kategori;
      $product->dimensi = $request->dimensi;
      $product->gambar = $request->gambar;
      $product->save();
      return redirect('/kembangbunga/admin/produk');
     }

}
