@extends('template-wpadmin')
@section('navbar_asset','active')
@section('main')
{{-- 'certificate_number' => 'required|string',
            'registration_number' => 'required|string',
            'soil_type' => 'required|string',
            'product_number' => 'required|string',
            'NUP' => 'required|string',
            'asset_area' => 'required|string',
            'year_of_acquisition' => 'required|integer',
            'proof_of_ownership' => 'required|string',
            'acquisition_value' => 'required|string',
            'current_asset_value' => 'required|string',
            'location_latitude' => 'required|string',
            'location_longitude' => 'required|string',
            'allotment' => 'required|string',
            'picture' => 'required|string', --}}
    <h1>Edit Aset</h1>
    <form action="/admin/asset/edit/{{$asset->id}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="certificate_number">No Sertifikat</label>
            <input type="text" name="certificate_number" value="{{ $asset->certificate_number }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="registration_number">No Registrasi</label>
            <input type="text" name="registration_number" value="{{ $asset->registration_number }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="soil_type">Jenis Tanah</label>
            <input type="text" name="soil_type" value="{{ $asset->soil_type }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="product_number">No Produk</label>
            <input type="text" name="product_number" value="{{ $asset->product_number }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="NUP">NUP</label>
            <input type="text" name="NUP" value="{{ $asset->NUP }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="asset_area">Luas Aset</label>
            <input type="text" name="asset_area" value="{{ $asset->asset_area }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="year_of_acquisition">Tahun Perolehan</label>
            <input type="number" name="year_of_acquisition" value="{{ $asset->year_of_acquisition }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="proof_of_ownership">Bukti Kepemilikan</label>
            <input type="text" name="proof_of_ownership" value="{{ $asset->proof_of_ownership }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="acquisition_value">Nilai Perolehan</label>
            <input type="text" name="acquisition_value" value="{{ $asset->acquisition_value }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="current_asset_value">Nilai Aset Saat Ini</label>
            <input type="text" name="current_asset_value" value="{{ $asset->current_asset_value }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="location_latitude">Latitude Lokasi</label>
            <input type="text" name="location_latitude" value="{{ $asset->location_latitude }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="location_longitude">Longitude Lokasi</label>
            <input type="text" name="location_longitude" value="{{ $asset->location_longitude }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="allotment">Pemberian</label>
            <input type="text" name="allotment" value="{{ $asset->allotment }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="picture">Foto</label>
            <input type="text" name="picture" value="{{ $asset->picture }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
