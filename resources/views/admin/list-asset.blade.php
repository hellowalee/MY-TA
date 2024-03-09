@extends('template-wpadmin')
@section('navbar_asset','active')
@section('main')
    <h1>Daftar Aset</h1>
    <a href="/admin/asset/create" class="btn btn-primary">Tambah Aset Baru</a>
    @if (session('status'))
        <div class="alert alert-success mt-5">
            {{ session('status') }}
        </div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>No Sertifikat</th>
                <th>No Registrasi</th>
                <th>Tahun Perolehan</th>
                <th>Nilai Perolehan</th>
                <th>Luas Aset</th>
                <th>Lokasi</th>
                <th>Alokasi</th>
                <th>Gambar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($assets as $asset)
                <tr>
                    <td>{{ $asset->certificate_number }}</td>
                    <td>{{ $asset->registration_number }}</td>
                    <td>{{ $asset->year_of_acquisition }}</td>
                    <td>{{ $asset->acquisition_value }}</td>
                    <td>{{ $asset->asset_area }}</td>
                    <td>{{ $asset->location_latitude }}, {{ $asset->location_longitude }}</td>
                    <td>{{ $asset->allotment }}</td>
                    <td><img src="{{ $asset->picture }}" alt="Asset Picture" style="max-width: 100px;"></td>
                    <td>
                        <a href="/asset/view/{{$asset->id}}" class="btn btn-primary">View</a>
                        <a href="/admin/asset/edit/{{$asset->id}}" class="btn btn-success">Edit</a>
                        <a href="/admin/asset/delete/{{$asset->id}}" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
