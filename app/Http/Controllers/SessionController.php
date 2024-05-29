<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Add this import statement
use App\Models\User;
use App\Models\Page;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    function index()
    {
        if (Auth::check()) {
            return redirect('/admin/dashboard');
        }
        return view('session.index');
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ],[
            'email.required' => 'Email tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)&& $user->isAdmin == true) {
            Auth::login($user); // Use Auth::login() to perform the login
            return redirect('/admin/dashboard')->with('success', 'Login berhasil');
        } else {
            return redirect('/wpadmin-login')->withErrors('Email atau password salah');
        }
    }

    function logout()
    {
        Auth::logout(); // Use Auth::logout() to perform the logout
        return redirect('/wpadmin-login');
    }

    function register()
    {
        return view('session.register');
    }

    function createUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->isAdmin = '0';
        $user->email = $request->email;
        $user->password = bcrypt($request->password); // Use Hash::make() to hash the password
        $user->save();

        return redirect('/wpadmin-login')->with('status', 'Registrasi berhasil');
    }

    public function contact($product){
        return view('customermanagement.contact',compact('product'));
    }

    public function redirectwa($product,Request $request){
        // $product='undangan';
        // cari yang hadir
        $userjson = User::all()->where('attendance',1);
        $users = array();
        // cek colom colom apakah menganduh nama produk
        foreach($userjson as $user) {
           if(strpos($user, $product))array_push($users, $user);   
        }
        // dapatkan nomor telepon
        $page = Page::all()->where('page_name', $product)->first();

        $index=$page->count%sizeof($users);
        $user=$users[$index];
        // update count
        $page->update(['count'=> DB::raw('count+1'),]);
        
        Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'product' => $product,
            'name_admin' => $user->name,
            'phone_admin' => $user->phone,
        ]);

        // redirect link
        $link = 'https://api.whatsapp.com/send?phone='.$user->phone;
        return redirect($link);

    }

    public function order($status,$user){
        if($status=='pending'){
            $orders=Order::all()->where('rating',null);
        }else{
            $orders=Order::all()->where('rating','!=',null);
        }
        if($user!='all'){
            $orders=$orders->where('name_admin',$user);
        }
        return view('customermanagement.order',['orders'=>$orders,'status'=>$status,'user'=>$user]);
    }

    public function admin_rating() {
        $order = Order::all();
        $list_top_admin = array();
    
        foreach ($order as $o) {
            if ($o->rating != null) {
                if (!isset($list_top_admin[$o->name_admin])) {
                    $list_top_admin[$o->name_admin] = [
                        'count' => 0,
                        'rating' => 0,
                        'unrated' => 0,
                    ];
                }
    
                $list_top_admin[$o->name_admin]['count'] += 1;
                $list_top_admin[$o->name_admin]['rating'] += $o->rating;
            } else {
                if (!isset($list_top_admin[$o->name_admin])) {
                    $list_top_admin[$o->name_admin] = [
                        'count' => 0,
                        'rating' => 0,
                        'unrated' => 0,
                    ];
                }
    
                $list_top_admin[$o->name_admin]['unrated'] += 1;
            }
        }
    
        foreach ($list_top_admin as $key => $value) {
            if ($value['count'] > 0) {
                $list_top_admin[$key]['rating'] = ($value['rating'] / $value['count'])-($value['unrated']*0.25);
            }
        }
    
        // assort berdasarkan rating
        arsort($list_top_admin);
        // Sorting the array based on 'rating' in descending order tanpa mengubah nama key
        // uasort($list_top_admin, function ($a, $b) {
        //     return $b['rating'] <=> $a['rating'];
        // });
        return view('customermanagement.admin_rating', ['list_top_admin' => $list_top_admin]);
    }
    


    public function rating($id){
        $order=Order::find($id);
        return view('customermanagement.rating',['order'=>$order,'id'=>$id]);
    }


    public function postrating($id,Request $request){
        $order=Order::find($id);
        $order->update(['rating'=>$request->rating,'comment'=>$request->comment]);
        return redirect('/')->with('success', 'Rating berhasil ditambahkan');
    }
}

