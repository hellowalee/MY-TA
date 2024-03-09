@extends('template-user')
@section('main')

<div class="container mt-5">
    <div class="row justify-content-center mb-5">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h3 class="text-center">Form Register</h3>
          </div>
          <div class="card-body">
            <form enctype="multipart/form-data" class="ps-checkout__form" action="/session/register" method="post">
                @csrf
                <div class="form-group">
                  <label for="nama">Nama</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama" value="{{Session::get('name')}}" required>
                </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan email" value="{{Session::get('email')}}" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" value="{{Session::get('password')}}" placeholder="Masukkan password" required>
              </div>
              <button type="submit" class="btn btn-primary btn-block mt-2">Daftar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection