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
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\SessionController;

Route::get('/wpadmin-login', [SessionController::class, 'index'])->name('login');
Route::post('/session/login', [SessionController::class, 'login']);
Route::get('/session/logout', [SessionController::class, 'logout']);
Route::get('/session/register', [SessionController::class, 'register']);
Route::post('/session/register', [SessionController::class, 'createUser']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/wpadmin', [AdminController::class, 'wpadmin']);
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard']);
    Route::get('/admin/asset/list/{data}', [AdminController::class, 'AdminList']);
    Route::get('/admin/asset/create', [AdminController::class, 'AdminCreate']);
    Route::post('/admin/asset/create', [AdminController::class, 'AdminStore']);
    Route::get('/admin/asset/edit/{id}', [AdminController::class, 'AdminEdit']);
    Route::post('/admin/asset/edit/{id}', [AdminController::class, 'AdminUpdate']);
    Route::get('/admin/asset/delete/{id}', [AdminController::class, 'AdminDelete']);
    Route::get('/admin/symlink', [AdminController::class, 'AdminSymLink']);
    Route::get('/linkstorage', function (){
        \Illuminate\Support\Facades\Artisan::call('storage:link');
        echo 'storage linked!';
    });
});

Route::get('/', [AssetController::class, 'index']);
Route::get('/asset/list/{id}', [AssetController::class, 'list']);
Route::get('/asset/view/{id}', [AssetController::class, 'view']);
Route::get('/asset/geoapify/{id}/{theme}', [AssetController::class, 'geoapify']);
Route::post('/asset/search', [AssetController::class, 'search']);

