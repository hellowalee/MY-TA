@extends('template-wpadmin')
@section('navbar_asset','active')
@section('main')
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
            <label for="year_of_acquisition">Tahun Perolehan</label>
            <input type="number" name="year_of_acquisition" value="{{ $asset->year_of_acquisition }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="acquisition_value">Nilai Perolehan</label>
            <input type="text" name="acquisition_value" value="{{ $asset->acquisition_value }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="asset_area">Luas Aset</label>
            <input type="text" name="asset_area" value="{{ $asset->asset_area }}" class="form-control" required>
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
            <label for="allotment">Alokasi</label>
            <input type="text" name="allotment" value="{{ $asset->allotment }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="picture">Link Gambar</label>
            <input type="text" name="picture" value="{{ $asset->picture }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
