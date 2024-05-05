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
        ]);

        if ($request->hasFile('picture')) {
            $request->validate([         
                'picture' => 'image|mimes:jpeg,png,jpg|nullable',
            ]);
        }

        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            $imageName = 'picture'.time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/asset', $imageName); // Store the image in the storage/app/public/images directory
            // get original root url
            $picture = '/storage/asset/' . $imageName;
        }
        else{
            $picture = 'https://storage.googleapis.com/fastwork-static/6a19c479-994b-4572-8fb5-95bf378f71e6.jpg';
        }

        $validatedData['picture'] = $picture;
        // $asset = Asset::create($validatedData);
        $asset = Asset::create([
            'right_type' => $request->right_type,
            'certificate_number' => $request->certificate_number,
            'registration_number' => $request->registration_number,
            'asset_type' => $request->asset_type,
            'NUP' => $request->NUP,
            'asset_area' => $request->asset_area,
            'year_of_acquisition' => $request->year_of_acquisition,
            'acquisition_value' => $request->acquisition_value,
            'current_asset_value' => $request->current_asset_value,
            'location_latitude' => $request->location_latitude,
            'location_longitude' => $request->location_longitude,
            'allocation' => $request->allocation,
            'picture' => $picture,
        ]);

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
        if ($request->hasFile('picture')) {
            $request->validate([
                'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable',
            ]);
        }
        
        $assetData = $request->except(['id', '_token']); // Exclude the 'id' and '_token' fields
        $asset = Asset::find($request->id);

        // picture
        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            if (strpos($asset->picture, '/storage/asset/') !== false) {
                $imageName = explode('/storage/asset/', $asset->picture)[1];
                 // Mengecek apakah file sudah ada
                if (Storage::exists('public/asset/' . $imageName)) {
                    // Menghapus file yang sudah ada
                    Storage::delete('public/asset/' . $imageName);
                }
            }
                
            $imageName = 'picture' . time() . '.' . $image->getClientOriginalExtension();
            
            $picture= '/storage/asset/' . $imageName;
    
            $image->storeAs('public/asset', $imageName);
            $assetData['picture'] = $picture;
        }
        Asset::where('id', $request->id)->update($assetData);
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

    public function AdminSymLink(){
        $linkFolder=public_path('storage');
        $targetFolder=storage_path('app/public');
       // Make sure the target folder exists before creating the symlink
        if (!is_dir($targetFolder)) {
            die('Target folder does not exist.');
        }

        // Use shell_exec to execute the ln -s command
        $command = "ln -s $targetFolder $linkFolder";
        $result = shell_exec($command);

        if ($result === null) {
            die('Error creating symlink.');
        }
        // ln -s /home/u971422264/domains/akad.in/public_html/storage/app/public /home/u971422264/domains/akad.in/public_html/public/storage
        echo 'Symlink process successfully completed';
    }

}
