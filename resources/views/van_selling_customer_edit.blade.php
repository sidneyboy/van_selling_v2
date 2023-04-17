@extends('layouts.master')

@section('title', 'VS CUSTOMER EDIT')

@section('navbar')


@section('sidebar')


@section('content')

    <br />
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">{{ $customer->store_name }}</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <form action="{{ route('van_selling_customer_edit_process') }}" method="post">
                @csrf
                <div class="card-body">
                    <label for="">CONTACT PERSON</label>
                    <input type="text" name="contact_person" required class="form-control">

                    <label for="">CONTACT NUMBER</label>
                    <input type="text" name="contact_number" required class="form-control">


                    <input type="hidden" id="marker_image" value="{{ asset('images/marker.png') }}">

                    
                    <input type="hidden" name="longitude" id="longitude" required class="form-control">
                    <input type="hidden" name="latitude" id="latitude" required class="form-control">

                    <input type="hidden" value="{{ $customer->id }}" name="id">

                    
                </div>

                <div class="card-body">
                    <div id="map"></div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <button type="submit" class="btn btn-block btn-success">Save Changes</button>
                </div>
            </form>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection


@section('footer')
    @parent
    <script>
        var marker_image = $('#marker_image').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            // function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
            // }

            function showPosition(position) {
                // x.innerHTML = "Latitude: " + position.coords.latitude +
                //     "<br>Longitude: " + position.coords.longitude;

          //       $('#latitude').val(position.coords.latitude);
          //       $('#longitude').val(position.coords.longitude);

                var view = new ol.View({
                    projection: 'EPSG:4326',
                    center: [position.coords.longitude, position.coords.latitude],
                    zoom: 17,
                    maxZoom: 23,
                })

                var OSM = new ol.layer.Tile({
                    title: 'OSM',
                    type: 'base',
                    visible: true,
                    source: new ol.source.OSM()
                });

                var satellite = new ol.layer.Tile({
                    title: 'satellite',
                    type: 'base',
                    visible: true,
                    source: new ol.source.XYZ({
                        attributions: ['Powered by Esri',
                            'Source: Esri, DigitalGlobe, GeoEye, Earthstar Geographics, CNES/Airbus DS, USDA, USGS, AeroGRID, IGN, and the GIS User Community'
                        ],
                        attributionsCollapsible: true,
                        url: 'http://mt0.google.com/vt/lyrs=y&hl=en&x={x}&y={y}&z={z}',
                        maxZoom: 23,
                        crossOrigin: "Anonymous"
                    })
                });


                var base_maps = new ol.layer.Group({
                    title: 'Base Maps',
                    layers: [satellite]
                })

                var map = new ol.Map({
                    target: 'map',
                    view: view
                })

                map.addLayer(base_maps);


                var marker_image = $('#marker_image').val();

                var Style = new ol.style.Style({
                    image: new ol.style.Icon({
                        anchor: [0.5, 46],
                        anchorXUnits: 'fraction',
                        anchorYUnits: 'pixels',
                        src: marker_image,
                    }),
                })

                var checker = checker;

                map.on('click', function(e) {
                    if (checker > 0) {
                        console.log('cannot');
                    } else {
                        var point = map.getCoordinateFromPixel(e.pixel)
                        console.log(e.coordinate);
                        $('#latitude').val(e.coordinate[0]);
                        $('#longitude').val(e.coordinate[1]);


                        var marker = new ol.Feature({
                            geometry: new ol.geom.Point([e.coordinate[0], e.coordinate[1]]),
                            type: 'hospital',
                            name: 'test',
                        });

                        var vectorLayer = new ol.layer.Vector({
                            title: 'REPORT',
                            source: new ol.source.Vector({
                                features: [marker]
                            }),
                            style: Style
                        });
                        map.addLayer(vectorLayer);

                        checker = 1;
                    }
                });
            }
        });
    </script>
    </body>

    </html>
@endsection
