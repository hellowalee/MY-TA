@extends('template-user')
@section('navbar_asset','active')
@section('main')

<h1 class="text-center mt-5">Daftar Aset</h1>
@if (session('status'))
    <div class="alert alert-success mt-5">
        {{ session('status') }}
    </div>
@endif
<!-- Search Section -->
<div class="row my-3">
    <div class="col-md-6 offset-md-3">
      <form enctype="multipart/form-data" class="ps-checkout__form" action="/asset/search" method="post">
        @csrf
        <div class="input-group w-100">
          <input id="search" name="search" type="text" class="form-control" placeholder="NUP">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Cari Asset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
<!-- End Search Section -->

<!-- ======= Featured Services Section ======= -->
<section id="featured-services" class="featured-services">
    <div class="container" data-aos="fade-up">

      <div class="row">

        @foreach ($assets as $asset)
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mt-2 mb-5 mb-lg-0">
          <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
            <div class="icon"><i class="bx bx-file"></i></div>
            <h4 class="title"><a href="/asset/view/{{ $asset->id }}">Nama Aset: {{ $asset->asset_name }}</a></h4>
            <p class="description">Luas Aset: {{ $asset->asset_area }}</p>
          </div>
        </div>
        @endforeach

      </div>

    </div>
  </section><!-- End Featured Services Section -->

  
@endsection