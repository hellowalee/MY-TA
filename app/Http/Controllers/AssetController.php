<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asset;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('asset.index');
    }

    public function view($id)
    {
        $asset=Asset::find($id);
        return view('asset.view',compact('asset'));
    }

    public function geoapify($id,$theme)
    {
        $asset=Asset::find($id);
        return view('asset.geoapify',compact('asset','theme'));
    }

    public function search(Request $request)
    {
        $search = $request->search;
        $asset = Asset::where('NUP','like',"%".$search."%")
        // ->orWhere('registration_number','like',"%".$search."%")
        // ->orWhere('year_of_acquisition','like',"%".$search."%")
        // ->orWhere('acquisition_value','like',"%".$search."%")
        // ->orWhere('asset_area','like',"%".$search."%")
        // ->orWhere('location_latitude','like',"%".$search."%")
        // ->orWhere('location_longitude','like',"%".$search."%")
        // ->orWhere('allocation','like',"%".$search."%")
        // ->orWhere('picture','like',"%".$search."%")
        ->get()->first();
        return redirect('/asset/list/'.$asset->id);
    }

    public function map_search(Request $request)
    {
        $search = $request->search;
        $asset = Asset::where('NUP','like',"%".$search."%")
        // ->orWhere('registration_number','like',"%".$search."%")
        // ->orWhere('year_of_acquisition','like',"%".$search."%")
        // ->orWhere('acquisition_value','like',"%".$search."%")
        // ->orWhere('asset_area','like',"%".$search."%")
        // ->orWhere('location_latitude','like',"%".$search."%")
        // ->orWhere('location_longitude','like',"%".$search."%")
        // ->orWhere('allocation','like',"%".$search."%")
        // ->orWhere('picture','like',"%".$search."%")
        ->get()->first();
        return redirect('/asset/map/'.$asset->id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function list($id)
    {
        if($id=='all'){
            $assets=Asset::all();
        }
        else if($id=='rent'){
            $assets=Asset::where('available_rent','Ya')->get();
        }
        else if($id=='notrent'){
            $assets=Asset::where('available_rent','Tidak')->get();
        }
        else{
            $assets=Asset::where('id',$id)->get();
        }
        return view('asset.list',compact('assets'));
    }

    public function map($id){
        if($id=='all'){
            $assets=Asset::all();
            $zoom=13;
        }
        else{
            $assets=Asset::where('id',$id)->get();
            $zoom=16;
        }
        return view('asset.map',['assets'=>$assets,'zoom'=>$zoom]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
