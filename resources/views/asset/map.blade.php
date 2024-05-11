@extends('template-user')
@section('navbar_asset','active')
@section('main')

<h1 class="text-center mt-5">Peta Lokasi Aset</h1>
@if (session('status'))
    <div class="alert alert-success mt-5">
        {{ session('status') }}
    </div>
@endif
<!-- Search Section -->
<div class="row my-3">
    <div class="col-md-6 offset-md-3">
      <form enctype="multipart/form-data" class="ps-checkout__form" action="/asset/map/search" method="post">
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
<div class="card m-5">
    <div class="card-body">
        <div>
          <div id="bingmap">
              <div class="row">
                  <div class="col-md-12">
                      <div id="myMap" style="height:1000px;"></div>
                  </div>
              </div>
          </div>
          <script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?callback=GetMap' async defer></script>
          
          <script type='text/javascript'>
              var map, infobox, directionsManager;
          
              function GetMap() {
                  // Mengatur peta
                  map = new Microsoft.Maps.Map('#myMap', {
                      credentials: "U4VD6Xi1NuVkAaN8KvJF~dereRmfzkm5VdVorK5lmlA~Ar4MuDpGzRmqdUtbXYvjm31t06tAU-400GnsVAY8Zna23hb05WjeiHiszdHOEAXU",
                      center: new Microsoft.Maps.Location(
                        {{$assets[0]->location_latitude}}, {{$assets[0]->location_longitude}}
                      ),
                      mapTypeId: Microsoft.Maps.MapTypeId.road,
                      zoom: {{$zoom}}
                  });
          
                  // Buat infobox (jendela informasi)
                  infobox = new Microsoft.Maps.Infobox(map.getCenter(), {
                      visible: false
                  });
                  infobox.setMap(map);
          
                  var origin=null;

                @foreach($assets as $asset)
                  origin = new Microsoft.Maps.Location({{$asset->location_latitude}}, {{$asset->location_longitude}});
                  // Tambahkan pin (marker) untuk kedua titik
                  addPushpin(origin, 'NUP', '{{ $asset->asset_type }}');
                @endforeach
    
          
                  // Tampilkan loading
                  $('#loading').show();
          

              }
          
              // Fungsi untuk menambahkan pin (marker) ke peta
              function addPushpin(location, title, description) {
                  var pin = new Microsoft.Maps.Pushpin(location);
          
                  // Simpan metadata pin
                  pin.metadata = {
                      title: title,
                      description: description
                  };
          
                  // Tangani event klik pada pin
                  Microsoft.Maps.Events.addHandler(pin, 'click', function(e) {
                      infobox.setOptions({
                          location: e.target.getLocation(),
                          title: e.target.metadata.title,
                          description: e.target.metadata.description,
                          visible: true
                      });
                  });
          
                  // Tambahkan pin ke entitas peta
                  map.entities.push(pin);
              }
          </script>
          
            
        </div> 
        
    </div>
</div>
  <!-- End Featured Services Section -->

  
@endsection