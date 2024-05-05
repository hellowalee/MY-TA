@extends('template-wpadmin')
@section('navbar_asset','active')
@section('main')
{{--        
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
            'picture' => 'required|string', --}}
    <h1>Edit Aset</h1>
    <form action="/admin/asset/edit/{{$asset->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="right_type">Jenis Hak Tanah</label>
            <select name="right_type" class="form-control" required>
                <option value="Hak Milik" {{ $asset->right_type == 'Hak Milik' ? 'selected' : '' }}>Hak Milik</option>
                <option value="Hak Guna Bangunan" {{ $asset->right_type == 'Hak Guna Bangunan' ? 'selected' : '' }}>Hak Guna Bangunan</option>
                <option value="Hak Pakai" {{ $asset->right_type == 'Hak Pakai' ? 'selected' : '' }}>Hak Pakai</option>
                <option value="Hak Guna Usaha" {{ $asset->right_type == 'Hak Guna Usaha' ? 'selected' : '' }}>Hak Guna Usaha</option>
                <option value="Hak Pengelolaan" {{ $asset->right_type == 'Hak Pengelolaan' ? 'selected' : '' }}>Hak Pengelolaan</option>
                <option value="Hak Wakaf" {{ $asset->right_type == 'Hak Wakaf' ? 'selected' : '' }}>Hak Wakaf</option>
                <option value="Letter C" {{ $asset->right_type == 'Letter C' ? 'selected' : '' }}>Letter C</option>
                <option value="Lainnya" {{ $asset->right_type == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
        </div>
        <div class="form-group">
            <label for="certificate_number">No Sertipikat</label>
            <input type="text" name="certificate_number" value="{{ $asset->certificate_number }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="registration_number">No Registrasi</label>
            <input type="text" name="registration_number" value="{{ $asset->registration_number }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="asset_type">Jenis Aset</label>
            <input type="text" name="asset_type" value="{{ $asset->asset_type }}" class="form-control" required>
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
            <label for="allocation">Peruntukan</label>
            <select name="allocation" class="form-control" required>
                <option value="Sedang Digunakan" {{ $asset->allocation == 'Sedang Digunakan' ? 'selected' : '' }}>Sedang Digunakan</option>
                <option value="Tidak Sedang Digunakan" {{ $asset->allocation == 'Tidak Sedang Digunakan' ? 'selected' : '' }}>Tidak Sedang Digunakan</option>
                <option value="Disewakan" {{ $asset->allocation == 'Disewakan' ? 'selected' : '' }}>Disewakan</option>
                <option value="Lainnya" {{ $asset->allocation == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
        </div>
        <div class="form-group">
            <label for="picture">Foto</label>
            <input type="file" name="picture" value="{{ $asset->picture }}" class="form-control">
            @if($asset->picture != null && Auth::check() && Auth::user()->isAdmin == 1)
                <a class="btn btn-primary" href="{{ $asset->picture }}" target="_blank">Lihat Foto</a>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
