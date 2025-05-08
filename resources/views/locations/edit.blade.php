@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit Location</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('adminlte-templates::common.errors')

        <div class="card">

            {!! Form::model($location, ['route' => ['locations.update', $location->id], 'method' => 'patch']) !!}

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

        {{-- MAP DI BAWAH FORM --}}
        <div class="card mt-4">
            <div class="card-header">
                <strong>Perbarui Lokasi di Peta</strong>
            </div>
            <div class="card-body">
                <div id="map" style="height: 400px;"></div>
            </div>
        </div>
    </div>

    {{-- Leaflet CSS & JS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Ambil nilai default dari lokasi yang sedang diedit
            var defaultLat = {{ $location->latitude ?? -0.5021 }};
            var defaultLng = {{ $location->longitude ?? 117.1537 }};

            var map = L.map('map').setView([defaultLat, defaultLng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            // Tampilkan marker awal
            var marker = L.marker([defaultLat, defaultLng]).addTo(map);

            map.on('click', function (e) {
                var lat = e.latlng.lat.toFixed(6);
                var lng = e.latlng.lng.toFixed(6);

                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                marker.setLatLng(e.latlng);
            });
        });
    </script>
@endsection
