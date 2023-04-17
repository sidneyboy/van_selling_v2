@extends('layouts.master')

@section('title', 'VS BARANGAY GEOTAG')

@section('navbar')


@section('sidebar')


@section('content')

    <br />
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">VS BARANGAY GEOTAG</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                    <input type="hidden" id="marker_image" value="{{ asset('images/marker.png') }}">
                    <div id="map"></div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection


@section('footer')
    @parent
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        var marker_image = $('#marker_image').val();
        var arrayPos = <?php echo json_encode($isteAttributes); ?>;

        /* open street map newest version */
        var map = new ol.Map({
            target: 'map', // the div id
            layers: [
                new ol.layer.Tile({
                    // source: new ol.source.XYZ()
                    source: new ol.source.XYZ({
                        url: 'http://mt0.google.com/vt/lyrs=s&hl=en&x={x}&y={y}&z={z}'
                    })
                }),
            ],
            view: new ol.View({
                center: ol.proj.fromLonLat([124.64970709949716, 8.483466116291813]),
                zoom: 13,
                minZoom: 3
            })
        });


        for (var i = 0; i < arrayPos.length; i++) {

            var ticket_number = arrayPos[i]['id'];
            var long = arrayPos[i]['latitude'];
            var lat = arrayPos[i]['longitude'];

            console.log(arrayPos[i]['id']);
            // add a marker to the map
            var layer = new ol.layer.Vector({
                source: new ol.source.Vector({
                    features: [
                        new ol.Feature({
                            geometry: new ol.geom.Point(ol.proj.fromLonLat([long, lat]))
                        })
                    ]
                })
            });
            layer.setStyle(new ol.style.Style({
                // text: new ol.style.Text({
                //     text: 'asdasd',
                //     scale: 1.3,
                //     fill: new ol.style.Fill({
                //         color: '#000000'
                //     }),
                //     stroke: new ol.style.Stroke({
                //         color: '#FFFF99',
                //         width: 3.5
                //     })
                // }),
                image: new ol.style.Icon({
                    src: marker_image, //
                    scale: 0.4 // set the size of the vehicle on the map
                })
            }));


            map.addLayer(layer);

            //initialize the popup
            var container = document.getElementById('popup');
            var content = document.getElementById('popup-content');

            var overlay = new ol.Overlay({
                element: container,
                autoPan: true,
                autoPanAnimation: {
                    duration: 250
                }
            });
            map.addOverlay(overlay);

            //display the pop with on mouse over event
            map.on('pointermove', function(event) {
                if (map.hasFeatureAtPixel(event.pixel) === true) {
                    var coordinate = event.coordinate;
                    //simple text written in the popup
                    content.innerHTML = '<b>My latitude is: </b>' + lat + '<br><b>My Longitude is: </b>' + long;
                    overlay.setPosition(coordinate);
                } else {
                    overlay.setPosition(undefined);
                    //closer.blur();
                }
            });

        }
    </script>
    </body>

    </html>
@endsection
