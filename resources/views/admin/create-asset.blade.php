@extends('template-wpadmin')
@section('navbar_asset','active')
@section('main')
    <h1>Tambah Aset Baru</h1>
    <form action="/admin/asset/create" method="POST">
        @csrf
        <div class="form-group">
            <label for="certificate_number">No Sertifikat</label>
            <input type="text" name="certificate_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="registration_number">No Registrasi</label>
            <input type="text" name="registration_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="year_of_acquisition">Tahun Perolehan</label>
            <input type="text" name="year_of_acquisition" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="acquisition_value">Nilai Perolehan</label>
            <input type="text" name="acquisition_value" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="asset_area">Luas Aset (m2)</label>
            <input type="text" name="asset_area" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="location_latitude">Latitude Lokasi</label>
            <input type="text" name="location_latitude" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="location_longitude">Longitude Lokasi</label>
            <input type="text" name="location_longitude" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="allotment">Alokasi</label>
            <input type="text" name="allotment" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="picture">Gambar</label>
            <input type="text" name="picture" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
@endsection
