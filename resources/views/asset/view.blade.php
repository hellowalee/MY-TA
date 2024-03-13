@extends('template-user')
@section('navbar_asset','active')
@section('main')


  <div class="row">
    <div class="col-md-6">
      <!-- Map Section -->
      <div class="card">
          <div class="card-body">
              <h5 class="card-title">PETA LOKASI ASET</h5>
              <div class="embed-responsive embed-responsive-16by9">
                  <!-- Replace 'YOUR_GOOGLE_MAPS_API_KEY' with your actual Google Maps API key -->
                  <!-- <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed/v1/view?key=YOUR_GOOGLE_MAPS_API_KEY&center=latitude,longitude&zoom=15" allowfullscreen></iframe> -->
                  <iframe id="assetMap" class="embed-responsive-item" src="/asset/geoapify/{{$asset->id}}/osm-bright" allowfullscreen></iframe>
              </div>
              <div class="mt-3">
                  <label for="mapTheme">Pilih Tema Peta:</label>
                  <select id="mapTheme" class="form-select">
                      <option value="osm-bright">OSM Bright</option>
                      <option value="osm-carto">OSM Carto</option>
                      <option value="dark-matter-purple-roads">Dark Matter Purple Roads</option>
                      <!-- Add more theme options as needed -->
                  </select>
              </div>
              <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
              <script>
                  $(document).ready(function() {
                      $('#mapTheme').change(function() {
                          var selectedTheme = $(this).val();
                          $('#assetMap').attr('src', '/asset/geoapify/{{$asset->id}}/' + selectedTheme);
                          alert('Tema peta telah diubah. Silakan tunggu beberapa saat untuk memuat ulang peta.');
                      });
                  });
              </script>
          </div>
      </div>
  </div>
  

    <div class="col-md-6">
      <!-- Photo Section -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">FOTO BANGUNAN ASET</h5>
          <img src="{{$asset->picture}}" class="img-fluid" alt="Foto Bangunan Aset">
        </div>
      </div>

      <!-- Information Section -->
      <div class="card mt-3">
        <div class="card-body">
          <h5 class="card-title">INFORMASI ASET</h5>
          <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>No Sertifikat:</strong> {{$asset->certificate_number}}</li>
            <li class="list-group-item"><strong>No Registrasi:</strong> {{$asset->registration_number}}</li>
            <li class="list-group-item"><strong>Tahun Perolehan:</strong> {{$asset->year_of_acquisition}}</li>
            <li class="list-group-item"><strong>Nilai Perolehan:</strong> {{$asset->acquisition_value}}</li>
            <li class="list-group-item"><strong>Luas Aset:</strong> {{$asset->asset_area}} m<sup>2</sup></li>
            <li class="list-group-item"><strong>Lokasi:</strong> {{$asset->location_latitude}}, {{$asset->location_longitude}}</li>
            <li class="list-group-item"><strong>Alokasi:</strong> {{$asset->allotment}}</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  
@endsection