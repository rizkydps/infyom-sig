@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Locations</h1>
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-primary float-right"
   href="{{ route('locations.create') }}">
   Add New
</a>

                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        @include('flash::message')

        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-0">
                @include('locations.table')

                <div class="card-footer clearfix">
                    <div class="float-right">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<div id="map" style="height: 500px;"></div>

<script>
    var map = L.map('map').setView([ -0.502106, 117.153709 ], 12); // Samarinda


    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    // Ambil data dari database
    fetch("{{ route('api.locations') }}")
    .then(response => response.json())
    .then(data => {
        data.forEach(location => {
            L.marker([location.latitude, location.longitude])
                .addTo(map)
                .bindPopup(`<b>${location.name}</b>`);
        });
    })
    .catch(error => console.error("Error fetching data:", error));



</script>


@endsection

