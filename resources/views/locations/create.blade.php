@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Create Location</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::open(['route' => 'locations.store']) !!}

            <div class="card-body">
                <div class="row">
                    @include('locations.fields')
                </div>
            </div>

            <div class="card-footer">
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('locations.index') }}" class="btn btn-default">Cancel</a>
            </div>

            {!! Form::close() !!}

        </div>

        {{-- Map DITARUH DI BAWAH FORM --}}
        <div class="card mt-4">
            <div class="card-header">
                <strong>Pilih Lokasi di Peta</strong>
            </div>
            <div class="card-body">
                {{-- <div id="map" style="height: 400px;"></div> --}}
                <div id="map" style="height: 500px; margin-top: 50px"></div>
            </div>
        </div>
    </div>

    {{-- Leaflet CSS & JS --}}
     <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script> 
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
{{-- 
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var defaultLat = -0.5021;
            var defaultLng = 117.1537;

            var map = L.map('map').setView([defaultLat, defaultLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var marker;

            map.on('click', function (e) {
                var lat = e.latlng.lat.toFixed(6);
                var lng = e.latlng.lng.toFixed(6);

                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                if (marker) {
                    marker.setLatLng(e.latlng);
                } else {
                    marker = L.marker(e.latlng).addTo(map);
                }
            });
        });
    </script> --}}
<script>
    var curLocation = [0, 0];

    if (curLocation[0] === 0 && curLocation[1] === 0) {
        curLocation = [-0.5021, 117.1537];
    }

    var osmUrl = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        osmAttrib = '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        osm = L.tileLayer(osmUrl, { maxZoom: 18, attribution: osmAttrib });

    var map = L.map('map').setView(curLocation, 13).addLayer(osm);
    map.attributionControl.setPrefix(false);

    var marker = new L.marker(curLocation, {
        draggable: true
    });

    // Update input saat marker digeser
    marker.on('dragend', function (event) {
        var position = marker.getLatLng();
        marker.setLatLng(position, { draggable: true }).bindPopup(position).update();
        document.getElementById("latitude").value = position.lat.toFixed(10);
        document.getElementById("longitude").value = position.lng.toFixed(10);
    });

    // Update marker saat input berubah
    document.getElementById("latitude").addEventListener("change", updateMarkerPosition);
    document.getElementById("longitude").addEventListener("change", updateMarkerPosition);

    function updateMarkerPosition() {
        var lat = parseFloat(document.getElementById("latitude").value);
        var lng = parseFloat(document.getElementById("longitude").value);
        if (!isNaN(lat) && !isNaN(lng)) {
            var position = [lat, lng];
            marker.setLatLng(position, { draggable: true }).bindPopup(position).update();
            map.panTo(position);
        }
    }

    // Update marker dan input saat peta diklik
    map.on('click', function (e) {
        var lat = e.latlng.lat.toFixed(10);
        var lng = e.latlng.lng.toFixed(10);

        document.getElementById("latitude").value = lat;
        document.getElementById("longitude").value = lng;

        marker.setLatLng(e.latlng).bindPopup(e.latlng).update();
    });

    map.addLayer(marker);
</script>




    
@endsection
