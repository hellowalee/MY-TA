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
            'asset_name' => 'required|string',
            'NUP' => 'required|string',
            'asset_area' => 'required|string',
            'year_of_acquisition' => 'required|integer',
            'acquisition_value' => 'required|string',
            'current_asset_value' => 'required|string',
            'location_latitude' => 'required|string',
            'location_longitude' => 'required|string',
            'allocation' => 'required|string',
        ]);

        if ($request->hasFile('picture')||$request->file('picture1')||$request->file('picture2')) {
            $request->validate([         
                'picture' => 'image|mimes:jpeg,png,jpg|nullable',
                'picture1' => 'image|mimes:jpeg,png,jpg|nullable',
                'picture2' => 'image|mimes:jpeg,png,jpg|nullable',
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
            $picture = 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png';
        }

        if ($request->hasFile('picture1')) {
            $image1 = $request->file('picture1');
            $imageName1 = 'picture1'.time() . '.' . $image1->getClientOriginalExtension();
            $image1->storeAs('public/asset', $imageName1); // Store the image in the storage/app/public/images directory
            // get original root url
            $picture1 = '/storage/asset/' . $imageName1;
        }
        else{
            $picture1 = 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png';
        }

        if ($request->hasFile('picture2')) {
            $image2 = $request->file('picture2');
            $imageName2 = 'picture2'.time() . '.' . $image2->getClientOriginalExtension();
            $image2->storeAs('public/asset', $imageName2); // Store the image in the storage/app/public/images directory
            // get original root url
            $picture2 = '/storage/asset/' . $imageName2;
        }
        else{
            $picture2 = 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/ac/No_image_available.svg/1024px-No_image_available.svg.png';
        }

        $validatedData['picture'] = $picture;
        // $asset = Asset::create($validatedData);
        $asset = Asset::create([
            'right_type' => $request->right_type,
            'certificate_number' => $request->certificate_number,
            'registration_number' => $request->registration_number,
            'asset_type' => $request->asset_type,
            'asset_name' => $request->asset_name,
            'NUP' => $request->NUP,
            'asset_area' => $request->asset_area,
            'year_of_acquisition' => $request->year_of_acquisition,
            'acquisition_value' => $request->acquisition_value,
            'current_asset_value' => $request->current_asset_value,
            'location_latitude' => $request->location_latitude,
            'location_longitude' => $request->location_longitude,
            'allocation' => $request->allocation,
            'picture' => $picture,
            'picture1' => $picture1,
            'picture2' => $picture2,
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
        } else {
            $asset = Asset::where('id', 'like', '%' . $data . '%')
                ->orWhere('nickname', 'like', '%' . $data . '%')
                ->orWhere('fullname', 'like', '%' . $data . '%');
        }
        $asset = $asset->orderBy('id', 'desc')->paginate(10);
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

        if ($request->hasFile('picture1')) {
            $image1 = $request->file('picture1');
            if (strpos($asset->picture1, '/storage/asset/') !== false) {
                $imageName1 = explode('/storage/asset/', $asset->picture1)[1];
                 // Mengecek apakah file sudah ada
                if (Storage::exists('public/asset/' . $imageName1)) {
                    // Menghapus file yang sudah ada
                    Storage::delete('public/asset/' . $imageName1);
                }
            }
                
            $imageName1 = 'picture1' . time() . '.' . $image1->getClientOriginalExtension();
            
            $picture1= '/storage/asset/' . $imageName1;
    
            $image1->storeAs('public/asset', $imageName1);
            $assetData['picture1'] = $picture1;
        }

        if ($request->hasFile('picture2')) {
            $image2 = $request->file('picture2');
            if (strpos($asset->picture2, '/storage/asset/') !== false) {
                $imageName2 = explode('/storage/asset/', $asset->picture2)[1];
                 // Mengecek apakah file sudah ada
                if (Storage::exists('public/asset/' . $imageName2)) {
                    // Menghapus file yang sudah ada
                    Storage::delete('public/asset/' . $imageName2);
                }
            }
                
            $imageName2 = 'picture2' . time() . '.' . $image2->getClientOriginalExtension();
            
            $picture2= '/storage/asset/' . $imageName2;
    
            $image2->storeAs('public/asset', $imageName2);
            $assetData['picture2'] = $picture2;
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
