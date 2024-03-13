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
        $asset = Asset::where('certificate_number','like',"%".$search."%")
        ->orWhere('registration_number','like',"%".$search."%")
        ->orWhere('year_of_acquisition','like',"%".$search."%")
        ->orWhere('acquisition_value','like',"%".$search."%")
        ->orWhere('asset_area','like',"%".$search."%")
        ->orWhere('location_latitude','like',"%".$search."%")
        ->orWhere('location_longitude','like',"%".$search."%")
        ->orWhere('allotment','like',"%".$search."%")
        ->orWhere('picture','like',"%".$search."%")
        ->get()->first();
        return redirect('/asset/view/'.$asset->id);
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
    public function show($id)
    {
        //
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
