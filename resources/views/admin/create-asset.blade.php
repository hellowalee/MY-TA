@extends('template-wpadmin')
@section('navbar_asset','active')
@section('main')
    <h1>Tambah Aset Baru</h1>
    <form action="/admin/asset/create" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="right_type">Jenis Hak Tanah</label>
            <select name="right_type" class="form-control" required>
                <option value="Hak Milik">Hak Milik</option>
                <option value="Hak Guna Bangunan">Hak Guna Bangunan</option>
                <option value="Hak Pakai">Hak Pakai</option>
                <option value="Hak Guna Usaha">Hak Guna Usaha</option>
                <option value="Hak Pengelolaan">Hak Pengelolaan</option>
                <option value="Hak Wakaf">Hak Wakaf</option>
                <option value="Letter C">Letter C</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div class="form-group">
            <label for="certificate_number">No Sertipikat</label>
            <input type="text" name="certificate_number" class="form-control">
        </div>
        <div class="form-group">
            <label for="registration_number">No Registrasi</label>
            <input type="text" name="registration_number" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="asset_type">Jenis Tanah</label>
            <select name="asset_type" class="form-control" required>
                <option value="Tanah">Tanah</option>
                <option value="Bangunan">Bangunan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="asset_name">Nama Tanah</label>
            <input type="text" name="asset_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="NUP">NUP</label>
            <input type="text" name="NUP" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="asset_area">Luas Aset</label>
            <input type="text" name="asset_area" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="year_of_acquisition">Tahun Perolehan</label>
            <input type="number" name="year_of_acquisition" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="acquisition_value">Nilai Perolehan</label>
            <input type="text" name="acquisition_value" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="current_asset_value">Nilai Aset Saat Ini</label>
            <input type="text" name="current_asset_value" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="rental_value">Nilai Sewa</label>
            <input type="text" name="rental_value" class="form-control" required>
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
            <label for="allocation">Status Penggunaan</label>
            <select name="allocation" class="form-control" required>
                <option value="Sedang Digunakan">Sedang Digunakan</option>
                <option value="Tidak Sedang Digunakan">Tidak Sedang Digunakan</option>
                <option value="Disewakan">Disewakan</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div class="form-group">
            <label for="application">Penggunaan</label>
            <select name="application" class="form-control" required>
                <option value="Pertanian">Pertanian</option>
                <option value="Perdagangan & Jasa">Perdagangan & Jasa</option>
                <option value="Pemukiman">Pemukiman</option>
                <option value="Fasilitas Umum">Fasilitas Umum</option>
                <option value="Pendidikan">Pendidikan</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
        <div class="form-group">
            <label for="description">Deskripsi</label>
            <input type="text" name="description" class="form-control">
        </div>
        <div class="form-group">
            <label for="available_rent">Tersedia Untuk Disewakan</label>
            <select name="available_rent" class="form-control" required>
                <option value="Ya">Ya</option>
                <option value="Tidak">Tidak</option>
            </select>
        </div>
        <div class="form-group">
            <label for="picture">Foto 1</label>
            <input type="file" class="form-control" id="picture" name="picture">
        </div>
        <div class="form-group">
            <label for="picture1">Foto 2</label>
            <input type="file" class="form-control" id="picture1" name="picture1">
        </div>
        <div class="form-group">
            <label for="picture2">Foto 3</label>
            <input type="file" class="form-control" id="picture2" name="picture2">
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
@endsection
