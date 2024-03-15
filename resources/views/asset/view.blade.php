@extends('template-user')
@section('navbar_asset', 'active')
@section('main')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="row">
        <div class="col-md-8">
            <!-- Map Section -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">PETA LOKASI ASET</h5>
                    <div>
                        <!-- Replace 'YOUR_GOOGLE_MAPS_API_KEY' with your actual Google Maps API key -->
                        <!-- <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed/v1/view?key=YOUR_GOOGLE_MAPS_API_KEY&center=latitude,longitude&zoom=15" allowfullscreen></iframe> -->
                        <div id="rawmap" style="display: none">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe id="assetMap" class="embed-responsive-item" src="/asset/geoapify/{{$asset->id}}/osm-bright" allowfullscreen></iframe>         
                            </div>
                            <div id="choosemap">
                                <div class="mt-5">
                                    <label for="mapTheme">Pilih Tema Peta:</label>
                                    <select id="mapTheme" class="form-select">
                                        <option value="osm-bright">OSM Bright</option>
                                        <option value="osm-carto">OSM Carto</option>
                                        <option value="dark-matter-purple-roads">Dark Matter Purple Roads</option>
                                        <!-- Add more theme options as needed -->
                                    </select>
                                </div>
                                
                                <script>
                                    $(document).ready(function() {
                                        $('#mapTheme').change(function() {
                                            var selectedTheme = $(this).val();
                                            $('#assetMap').attr('src', '/asset/geoapify/{{ $asset->id }}/' + selectedTheme);
                                            alert('Tema peta telah diubah. Silakan tunggu beberapa saat untuk memuat ulang peta.');
                                        });
                                    });
                                </script>
                            </div>
                        </div>

                        <!--- Bagian Judul-->
                        <div id="bingmap">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="myMap" style="height:500px"></div>
                                </div>
                            </div>
                        </div>

                        <script type='text/javascript' src='http://www.bing.com/api/maps/mapcontrol?callback=GetMap' async defer></script>

                        <script type='text/javascript'>
                            var map, infobox;

                            function GetMap() {
                                // Seting Map Options
                                map = new Microsoft.Maps.Map('#myMap', {
                                    credentials: "U4VD6Xi1NuVkAaN8KvJF~dereRmfzkm5VdVorK5lmlA~Ar4MuDpGzRmqdUtbXYvjm31t06tAU-400GnsVAY8Zna23hb05WjeiHiszdHOEAXU",
                                    center: new Microsoft.Maps.Location({{$asset->location_latitude}}, {{$asset->location_longitude}}),
                                    mapTypeId: Microsoft.Maps.MapTypeId.aerial,
                                    zoom: 18
                                });

                                //Membuat jendela infobox berada di tengah pin (tidak ditampilkan)
                                infobox = new Microsoft.Maps.Infobox(map.getCenter(), {
                                    visible: false
                                });
                                //Assign infobox pada variabel map
                                infobox.setMap(map);

                                //Create sebuah pin/marker pada kordinat banda aceh
                                var center = map.getCenter();
                                var pin = new Microsoft.Maps.Pushpin(center);

                                //Menyimpan informasi metadata pada pushpin.
                                pin.metadata = {
                                    title: 'Keterangan',
                                    description: '{{$asset->certificate_number}}'
                                };

                                // Menambah penanganan event click pada pushpin
                                Microsoft.Maps.Events.addHandler(pin, 'click', pushpinClicked);

                                //Memasang entitas pushpin pada peta
                                map.entities.push(pin);
                            }

                            // Fungsi yang menampilkan infobox ketika pushpin diklik
                            function pushpinClicked(e) {
                                if (e.target.metadata) {
                                    //Menambah metadata pushpin pada option di infobox
                                    infobox.setOptions({
                                        location: e.target.getLocation(),
                                        title: e.target.metadata.title,
                                        description: e.target.metadata.description,
                                        visible: true
                                    });
                                }
                            }
                        </script>

                    </div>

                    <div class="mt-3">
                        <label for="mapShow">Pilih Jenis Tampilan</label>
                        <select id="mapShow" class="form-select">
                            <option value="bingmap">Bing Map</option>
                            <option value="rawmap">Raw Map</option>
                        </select>
                    </div>

                    <script>
                        $(document).ready(function() {
                            $('#mapShow').change(function() {
                                alert('Tema peta telah diubah. Silakan tunggu beberapa saat untuk memuat ulang peta.');
                                var selectedTheme = $(this).val();
                                if (selectedTheme == 'rawmap') {
                                    $('#rawmap').show();
                                    $('#bingmap').hide();
                                } else if (selectedTheme == 'bingmap') {
                                    $('#rawmap').hide();
                                    $('#bingmap').show();
                                }
                            });
                        });
                    </script>

                    
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <!-- Photo Section -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">FOTO BANGUNAN ASET</h5>
                    <img src="{{ $asset->picture }}" class="img-fluid" alt="Foto Bangunan Aset">
                </div>
            </div>

            <!-- Information Section -->
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">INFORMASI ASET</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>No Sertifikat:</strong> {{ $asset->certificate_number }}</li>
                        <li class="list-group-item"><strong>No Registrasi:</strong> {{ $asset->registration_number }}</li>
                        <li class="list-group-item"><strong>Tahun Perolehan:</strong> {{ $asset->year_of_acquisition }}</li>
                        <li class="list-group-item"><strong>Nilai Perolehan:</strong> {{ $asset->acquisition_value }}</li>
                        <li class="list-group-item"><strong>Luas Aset:</strong> {{ $asset->asset_area }} m<sup>2</sup></li>
                        <li class="list-group-item"><strong>Lokasi:</strong> {{ $asset->location_latitude }},
                            {{ $asset->location_longitude }}</li>
                        <li class="list-group-item"><strong>Alokasi:</strong> {{ $asset->allotment }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection
