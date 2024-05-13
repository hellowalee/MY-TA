@extends('template-wpadmin')
@section('navbar_asset','active')
@section('main')
        {{--        
            'right_type' => 'required|string',
            'certificate_number' => 'nullable|string',
            'registration_number' => 'required|string',
            'asset_name' => 'required|string',
            'NUP' => 'required|string',
            'asset_area' => 'required|string',
            'year_of_acquisition' => 'required|integer',
            'acquisition_value' => 'required|string',
            'current_asset_value' => 'required|string',
            'location_latitude' => 'required|string',
            'location_longitude' => 'required|string',
            'allocation' => 'required|string',
            'picture' => 'required|string', --}}
    <h1>Daftar Aset</h1>
    <a href="/admin/asset/create" class="btn btn-primary">Tambah Aset Baru</a>
    @if (session('status'))
        <div class="alert alert-success mt-5">
            {{ session('status') }}
        </div>
    @endif
    <div class="table-responsive mt-5">
        <table class="table">
            <thead>
                <tr>
                    <th>Jenis Hak Tanah</th>
                    <th>No Sertipikat</th>
                    <th>No Registrasi</th>
                    <th>Jenis Aset</th>
                    <th>Nama Aset</th>
                    <th>NUP</th>
                    <th>Luas Aset</th>
                    <th>Tahun Perolehan</th>
                    <th>Nilai Perolehan</th>
                    <th>Nilai Aset Saat Ini</th>
                    <th>Latitude Lokasi</th>
                    <th>Longitude Lokasi</th>
                    <th>Alokasi</th>
                    <th>Gambar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($assets as $asset)
                    <tr>
                        <td>{{ $asset->right_type }}</td>
                        <td>{{ $asset->certificate_number }}</td>
                        <td>{{ $asset->registration_number }}</td>
                        <td>{{ $asset->asset_type }}</td>
                        <td>{{ $asset->asset_name }}</td>
                        <td>{{ $asset->NUP }}</td>
                        <td>{{ $asset->asset_area }}</td>
                        <td>{{ $asset->year_of_acquisition }}</td>
                        <td>{{ $asset->acquisition_value }}</td>
                        <td>{{ $asset->current_asset_value }}</td>
                        <td>{{ $asset->location_latitude }}</td>
                        <td>{{ $asset->location_longitude }}</td>
                        <td>{{ $asset->allocation }}</td>
                        <td>
                            <?php
                            // jika gambar tida ada http
                            if (strpos($asset->picture, 'http') === false) {
                                // replace /storage/asset/ menjadi /storage/public/asset/
                                // tidak berlaku jika storage di public dihapus
                                // $asset->picture = str_replace('/storage/asset/', '/storage/public/asset/', $asset->picture);
                            }
                            ?>
                            <img src="
                            @if ($asset->picture)
                                {{ asset($asset->picture) }}
                            @else
                                {{ asset('storage/assets/no-image.png') }}
                            @endif
                            " alt="Asset Picture" style="max-width: 100px;"></td>
                        <td>
                            <a href="/asset/view/{{$asset->id}}" class="btn btn-primary">View</a>
                            <a href="/admin/asset/edit/{{$asset->id}}" class="btn btn-success">Edit</a>
                            <a href="/admin/asset/delete/{{$asset->id}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
