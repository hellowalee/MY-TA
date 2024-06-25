@extends('template-wpadmin')
@section('navbar_asset','active')
@section('main')
    <h1>Daftar Aset</h1>
    <div class="d-flex mb-3">
        <a href="/admin/asset/create" class="btn btn-primary mx-2">Tambah Aset Baru</a>
        <a href="/download-excel" class="btn btn-success">Download Excel</a>
    </div>
    @if (session('status'))
        <div class="alert alert-success mt-5">
            {{ session('status') }}
        </div>
    @endif
    <div class="table-responsive mt-5">
        <table id="assetTable" class="table">
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
                    <th>Status Penggunaan</th>
                    <th>Penggunaan</th>
                    <th>Tersedia Untuk Disewakan</th>
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
                        <?php
                            // ubah format angka menjadi format rupiah
                            $asset->acquisition_value = "Rp " . number_format($asset->acquisition_value,2,',','.');
                            $asset->current_asset_value = "Rp " . number_format($asset->current_asset_value,2,',','.');
                        ?>
                        <td>{{ $asset->acquisition_value }}</td>
                        <td>{{ $asset->current_asset_value }}</td>
                        <td>{{ $asset->location_latitude }}</td>
                        <td>{{ $asset->location_longitude }}</td>
                        <td>{{ $asset->allocation }}</td>
                        <td>{{ $asset->application }}</td>
                        <td>{{ $asset->available_rent }}</td>
                        <td>
                            <?php
                            if (strpos($asset->picture, 'http') === false) {
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
                            <a href="" onclick="deleteConfirmation('/admin/asset/delete/{{$asset->id}}')" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- tombol next --}}
        <div class="d-flex justify-content-center">
            {{ $assets->links() }}
        </div>
    </div>

    {{-- Tambahkan pustaka SheetJS (xlsx) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.2/xlsx.full.min.js"></script>
    <script>
        function downloadExcel() {
            // Ambil data dari tabel
            var table = document.getElementById('assetTable');
            // kurangi 1 kolom terakhir dan beri warna hijau untuk heder
            for (var i = 0; i < table.rows.length; i++) {
                table.rows[i].deleteCell(-1);
            }
            var workbook = XLSX.utils.table_to_book(table, {sheet: "Sheet JS"});
            
            // Buat file excel
            var wbout = XLSX.write(workbook, {bookType: 'xlsx', type: 'binary'});
            
            // Fungsi untuk mengonversi string ke array buffer
            function s2ab(s) {
                var buf = new ArrayBuffer(s.length);
                var view = new Uint8Array(buf);
                for (var i = 0; i < s.length; i++) {
                    view[i] = s.charCodeAt(i) & 0xFF;
                }
                return buf;
            }
            
            // Simpan file
            saveAs(new Blob([s2ab(wbout)], {type: "application/octet-stream"}), 'assets.xlsx');
        }
    </script>
    {{-- Tambahkan pustaka FileSaver.js --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

@endsection
