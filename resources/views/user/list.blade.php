@extends('template-wpadmin')
@section('navbar_asset','active')
@section('main')
    <h1>Daftar Aset</h1>
    @if (session('status'))
        <div class="alert alert-success mt-5">
            {{ session('status') }}
        </div>
    @endif
    <div class="table-responsive mt-5">
        <table id="assetTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>   
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="/admin/user/edit/{{$user->id}}" class="btn btn-warning">Edit</a>
                            <a href="#" onclick="deleteConfirmation('/admin/user/delete/{{$user->id}}')" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- tombol next --}}
        <div class="d-flex justify-content-center">
            {{ $users->links() }}
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
