<?php

use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Models\Page;
use App\Models\User;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Http\Controllers\ContructionsController;
Route::get('/contructions/home', [ContructionsController::class, 'home']);
Route::get('/contructions/home2', [ContructionsController::class, 'home2']);
Route::get('/contructions/equipments', [ContructionsController::class, 'equipments']);
Route::get('/contructions/equipments2', [ContructionsController::class, 'equipments2']);
Route::get('/contructions/allequipments', [ContructionsController::class, 'allequipments']);


use App\Http\Controllers\IzinController;
Route::get('/pirt', [IzinController::class, 'pirt']);
Route::get('/mypirt', [IzinController::class, 'mypirt']);
Route::get('/nib', [IzinController::class, 'nib']);
Route::get('/siup', [IzinController::class, 'siup']);
Route::get('/halal', [IzinController::class, 'halal']);
Route::get('/haki', [IzinController::class, 'haki']);

use App\Http\Controllers\PerusahaanController;
Route::get('/ud', [PerusahaanController::class, 'ud']);
Route::get('/cv', [PerusahaanController::class, 'cv']);
Route::get('/pt', [PerusahaanController::class, 'pt']);

use App\Http\Controllers\AttendanceController;
Route::get('/myattendance', [AttendanceController::class, 'index']);
Route::get('/create-myattendance', [AttendanceController::class, 'createMyattendance']);
Route::post('/add-myattendance', [AttendanceController::class, 'addMyattendance']);
Route::get('/edit-myattendance/{id}', [AttendanceController::class, 'editMyattendance']);
Route::post('/update-myattendance/{user}', [AttendanceController::class, 'updateMyattendance']);
Route::get('/delete-myattendance/{user}', [AttendanceController::class, 'deleteMyattendance']);

use App\Http\Controllers\WebController;
Route::get('/website', [WebController::class, 'web']);
Route::get('/follower', [WebController::class, 'follower']);
Route::get('/aplikasi', [WebController::class, 'aplikasi']);
Route::get('/website/wedding', [WebController::class, 'wedding']);
Route::get('/website/herbal', [WebController::class, 'herbal']);
Route::get('/website/birthday', [WebController::class, 'birthday']);
Route::get('/contoh1', [WebController::class, 'contoh1']);
Route::get('/food', [WebController::class, 'food']);
Route::get('/categories', [WebController::class, 'categories']);
Route::get('/jasa-plavon-pvc', [WebController::class, 'jasaplavonpvc']);
Route::get('/koperasi-sekolah', [WebController::class, 'koperasisekolah']);
Route::get('/rosmelia-florist-bunga-papan-ucapan', [WebController::class, 'rosmelia_florist_bunga_papan_ucapan']);
Route::get('/kembangbunga', [WebController::class, 'kembangbunga']);
Route::get('/kembangbunga/produk/{id}', [WebController::class, 'kembangbunga_produk']);
Route::get('/kembangbunga/admin', [WebController::class, 'kembangbunga_admin']);
Route::get('/kembangbunga/admin/produk', [WebController::class, 'kembangbunga_admin_produk']);
Route::get('/kembangbunga/admin/produk/create', [WebController::class, 'kembangbunga_admin_produk_create']);
Route::get('/kembangbunga/admin/produk/{id}/delete', [WebController::class, 'kembangbunga_admin_produk_delete']);
Route::get('/kembangbunga/admin/produk/{id}/edit', [WebController::class, 'kembangbunga_admin_produk_edit']);
Route::post('/kembangbunga/admin/produk/{id}/edit', [WebController::class, 'kembangbunga_admin_produk_update']);
Route::post('/kembangbunga/admin/produk/create', [WebController::class, 'kembangbunga_admin_produk_store']);

use App\Http\Controllers\WeddingController;
Route::get('/wedding', [WeddingController::class, 'wedding']);
Route::get('/register-wedding', [WeddingController::class, 'registerWedding']);
Route::get('/contoh-wedding', [WeddingController::class, 'contohWedding']);
Route::post('/add-wedding', [WeddingController::class, 'addWedding']);
Route::get('/list-wedding/{wedding}', [WeddingController::class, 'listWedding']);
Route::get('/invitation-wedding/{wedding}', [WeddingController::class, 'invitationWedding']);

use App\Http\Controllers\PdfController;
Route::get('/upload-pdf', [PdfController::class, 'index']);
Route::post('/output-pdf', [PdfController::class, 'output']);

// user
Route::get('/', function () {
    $userjson = User::all()->where('attendance',1);
    $users = array();
    foreach($userjson as $user) {
        if(strpos($user, "pirt"))array_push($users, $user);   
    }
    $count = DB::table('pages')->where('id', 1)->first();
    return view('home',['count' =>$users[$count->count%sizeof($users)]->password]);
});

Route::get('/privasi', function () {
    return view('privasi.index');
});


Route::get('/dashboard', function () {
    $agent = new Agent();
    return view('dashboard', ['agent' => $agent]);
})->middleware(['auth'])->name('dashboard');

Route::get('/myizinadmin', function () {
    return view('admin.home');
});

Route::get('/myabsent', function () {
    $users = User::all();
    return view('admin.absent',['users'=>$users]);
});

Route::get('/scan', function () {
    return view('scan');
});

Route::get('/changestatus/{id}', function ($id) {
    $count = User::all()->where('attendance', 1)->count();
    $user = User::all()->where('id', $id)->first();
    if($count>1||$user['attendance']==0){
        if($user['attendance']==0){
            $attendance=1;
        }
        
        if($user['attendance']==1){
            $attendance=0;
        }
        
        User::where('id', $user->id)
         ->update([
             'attendance' => $attendance,
        ]);
        return redirect('myabsent')->with('status', 'Data Sukses Diubah');
    }
    else return redirect('myabsent')->with('status', 'Data Gagal Diubah');
});



function checkToken($id){
    $url='https://databasepython-18128-default-rtdb.asia-southeast1.firebasedatabase.app/Transaction_trifianherbal.json';
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1
    ));
    $response = curl_exec($curl);
    curl_close($curl);

    $response = json_decode($response, true);
    foreach($response as $key => $value){
        if($value['order_id'] == $id){
            if (isset($value['token'])) {
                return array('key' => $key, 'token' => $value['token']);
            } else {
                return array('key' => $key, 'token' => "kosong");
            }
        }
    }
    return null;
}

function postToken($key, $token) {
    $url = 'https://databasepython-18128-default-rtdb.asia-southeast1.firebasedatabase.app/Transaction_trifianherbal/'.$key.'.json';

    $data = array(
        'token' => $token
    );

    $payload = json_encode($data);

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH"); // Mengubah CURLOPT_CUSTOMREQUEST menjadi PATCH untuk update data
    curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload)
    ));

    $response = curl_exec($curl);

    if ($response === false) {
        return 'Error: ' . curl_error($curl);
    }

    curl_close($curl);

    return $response;
}

Route::get('/midtrans/{idtransaction}/{nilai}', function ($idtransaction,$nilai) {
    $curl = curl_init();
    $timestamp = time();
    $result = checkToken($idtransaction);
    $key = $result['key'];
    $cektoken = $result['token'];
    if($cektoken == "kosong"){
        $transaction_data = array(
            "transaction_details" => array(
                "order_id" => $idtransaction,
                "gross_amount" => $nilai
            ),
            "credit_card" => array(
                "secure" => true
            )
        );

        $payload = json_encode($transaction_data);

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://app.midtrans.com/snap/v1/transactions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $payload,
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json',
                'Authorization: Basic TWlkLXNlcnZlci1CaENaVFBfeXBLWVJ6cHFhM01qb1piaDM6'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        // Mengonversi string JSON menjadi objek JSON menggunakan json_decode
        $midtransResponse = json_decode($response);

        // Post token ke database
        postToken($key, $midtransResponse->token);

        return view('midtrans', ['token' => $midtransResponse->token]);
    } else {
        // Return the response as JSON "Token already exists: " . 
        return view('midtrans', ['token' => $cektoken]);
    }
});

function postStatus($key, $status) {
    $url = 'https://databasepython-18128-default-rtdb.asia-southeast1.firebasedatabase.app/Transaction_trifianherbal/'.$key.'.json';

    $data = array(
        'status' => $status
    );

    $payload = json_encode($data);

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PATCH"); // Mengubah CURLOPT_CUSTOMREQUEST menjadi PATCH untuk update data
    curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload)
    ));

    $response = curl_exec($curl);

    if ($response === false) {
        return 'Error: ' . curl_error($curl);
    }

    curl_close($curl);

    return $response;
}

Route::get('/midtransstatus/{idtransaction}', function ($idtransaction) {
    $result = checkToken($idtransaction);
    $key = $result['key'];
    $cektoken = $result['token'];
    if($cektoken != "kosong"){
        $headers = array(
            "accept" => "application/json",
            "authorization" => "Basic TWlkLXNlcnZlci1CaENaVFBfeXBLWVJ6cHFhM01qb1piaDM6"
        );
        
        $opts = array(
            "http" => array(
                "header" => implode("\r\n", array_map(function ($key, $value) {
                    return "$key: $value";
                }, array_keys($headers), $headers))
            )
        );
        
        $context = stream_context_create($opts);
        $url='https://api.midtrans.com/v2/'.$idtransaction.'/status';
        $response = file_get_contents($url, false, $context);
        
        $responseData = json_decode($response); // Parse the JSON response
        if(isset($responseData->transaction_status)){
            $midtransstatus= $responseData->transaction_status; // Return the transaction_status
            if($midtransstatus == "settlement"){
                $midtransstatus = "Pembayaran Berhasil";
            }else if($midtransstatus == "pending"){
                $midtransstatus = "Pembayaran Pending";
            }else if($midtransstatus == "cancel"){
                $midtransstatus = "Pembayaran Dibatalkan";
            }else if($midtransstatus == "deny"){
                $midtransstatus = "Pembayaran Ditolak";
            }else if($midtransstatus == "expire"){
                $midtransstatus = "Pembayaran Expired";
            }else if($midtransstatus == "refund"){
                $midtransstatus = "Pembayaran Refund";
            }else if($midtransstatus == "capture"){
                $midtransstatus = "Pembayaran Capture";
            }else{
                $midtransstatus = "Pembayaran Gagal";
            }
            postStatus($key, $midtransstatus);
            return $midtransstatus;
        }else{
            $midtransstatus= 'Menunggu Pembayaran'; // Return the transaction_status
            postStatus($key, $midtransstatus);
            return $midtransstatus;
        }
        

    }else{
        return "Belum Buat Transaksi";
    }
});


require __DIR__.'/auth.php';
