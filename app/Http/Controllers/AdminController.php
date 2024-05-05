<?php

namespace App\Http\Controllers;
use App\Models\Theme;
use App\Models\Confirmation;
use App\Models\Page;
use App\Models\Song;
use App\Models\Code;
use App\Models\Pendingpayment;
use App\Models\Catalog;
use App\Models\Asset;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function wpadmin(){
        if(Auth::check()){
           return redirect('/admin/dashboard');
        }
        else{
           return redirect('/wpadmin-login');
        }
    }

     public function AdminDashboard(){
         return view('admin.dashboard');
     }

     public function AdminCreate(){
        return view('admin.create-asset');
     }

     public function AdminStore(Request $request){
        $validatedData = $request->validate([
            'right_type' => 'required|string',
            'certificate_number' => 'nullable|string',
            'registration_number' => 'required|string',
            'asset_type' => 'required|string',
            
            'NUP' => 'required|string',
            'asset_area' => 'required|string',
            'year_of_acquisition' => 'required|integer',
            'acquisition_value' => 'required|string',
            'current_asset_value' => 'required|string',
            'location_latitude' => 'required|string',
            'location_longitude' => 'required|string',
            'allocation' => 'required|string',
            'picture' => 'required|string',
        ]);

        $asset = Asset::create($validatedData);

        return redirect('/admin/asset/list/all')->with('success', 'Aset berhasil ditambahkan.');
     }

     public function AdminSearch($data){
        return redirect("/admin/resume/list/$data");
    }

    public function AdminList($data)
    {
        if ($data === 'all') {
            $asset = Asset::query();
            $asset = $asset->paginate(10);
        } else {
            $asset = Asset::where('id', 'like', '%' . $data . '%')
                ->orWhere('nickname', 'like', '%' . $data . '%')
                ->orWhere('fullname', 'like', '%' . $data . '%');
            $asset = $asset->paginate(10);
        }
    
        return view('admin.list-asset', ['assets' => $asset]);
        // return $asset;
    }
    
     public function AdminEdit($id){
        $asset = Asset::find($id);
        return view('admin.edit-asset',['asset'=>$asset]);
     }

    public function AdminUpdate(Request $request, $id){
        Asset::where('id', $id)->update($request->except('_token', '_method'));
        return redirect('/admin/asset/list/all')->with('success', 'Aset berhasil diubah.');
    }

     public function AdminDelete($id){
         $asset = Cache::remember('asset_' . $id, 60, function () use ($id) {
            return Asset::find($id);
         });
         if(Auth::check()&& Auth::user()->isAdmin=='1'){
            $asset->delete();
            return redirect()->back()->with('status', 'Data Sukses Dihapus');
         }
         else{
            return redirect()->back()->with('status', 'Data Gagal Dihapus');
         }
      }

      public function UserEdit($id, $nickname, $fullname){
        $name1 = ucwords($nickname);
        $resume = Resume::all()->where('id', $id)->where('nickname', $name1);
        if(count($resume)>0){
         // nanti diganti ya,buatin sendiri
            $resume = Resume::all()->where('id', $id)->first();
            return view('admin-resume.edit-resume-user',['resume'=>$resume]);
        }
        else{
            return "Data Tidak Ditemukan";
        }
    }

}
