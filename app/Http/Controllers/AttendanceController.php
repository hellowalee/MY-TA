<?php

namespace App\Http\Controllers;
use App\Models\Page;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index(){
        $users = User::all();
        return view('attendance.myattendance',['users'=>$users]);
     }
     public function createMyattendance(){
         return view('attendance.create-myattendance');
     }
     public function addMyattendance(Request $request){
        $request->validate([
            "name" => 'required',
            "password" => 'required',
            "attendance" => 'required',
            "division" => 'required',
        ]);
        User::create([
                 'name' => $request->name,
                 'password' => $request->password,
                 'attendance' => $request->attendance,
                 'division' => $request->division,
        ]);
        return redirect('myattendance')->with('status', 'Data Sukses Ditambah');
     }
     public function editMyattendance($id){
         $user = User::all()->where('id', $id)->first();
        return view('attendance.edit-myattendance',['user'=>$user]);
     }
     public function updateMyattendance(Request $request, User $user){
         $request->validate([
            "name" => 'required',
            "password" => 'required',
            "attendance" => 'required',
            "division" => 'required',
        ]);
        User::where('id', $user->id)
                 ->update([
                     'name' => $request->name,
                     'password' => $request->password,
                     'attendance' => $request->attendance,
                     'division' => $request->division,
        ]);
        return redirect('myattendance')->with('status', 'Data Sukses Diedit');
     }
     public function deleteMyattendance(User $user){
        $user->delete();
        return redirect('myattendance')->with('status', 'Data Sukses Dihapus');
     }

     

}
