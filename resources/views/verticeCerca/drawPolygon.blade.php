<!DOCTYPE html>
    <html>
        <head>
            <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
            <meta charset="utf-8">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <title>Visualização de Cerca Eletrônica</title>
            <style>
                /* Always set the map height explicitly to define the size of the div
                 * element that contains the map. */
                #map {
                    height: 100%;
                }
                /* Optional: Makes the sample page fill the window. */
                html, body {
                    height: 100%;
                    margin: 0;
                    padding: 0;
                }
            </style>
        </head>
    <body>
        <div id="map"></div>
        <script src="{{ URL::asset('js/app.js') }}"></script>
        <script>
            // This example creates a simple polygon representing the Bermuda Triangle.
            {{--var centerLat = JSON.parse("{{$latitudes[0]}}");--}}
            {{--var centerLng = JSON.parse("{{$longitudes[0]}}");--}}
            function initMap()
            {
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 15,
                    center: {lat: -21.6779172, lng: -49.7575512},
                    mapTypeId: 'terrain'
                });
                $(document).ready(function(){
                    var cercas;
                    $.getJSON("{{ route('getIdsVertices') }}", { //Busco os ids
                    }, function (data, textStatus, jqXHR) {

                    }).done(function(data) {
                        cercas = data;
                    for (var i=0; i<cercas.length; i++)
                    {
                        var cerca = cercas[i].cerca_id;
                        $.getJSON("{{ route('getVertices') }}", {
                            cerca_id: cerca
                        }, function (data, textStatus, jqXHR) {

                        }).done(function(data){
                            var coordenadas = [];
                            var area_risco = 0;
                            $.each(data, function (indice, vertice) {
                                coordenadas.push({lat: parseFloat(vertice.lat), lng: parseFloat(vertice.lng)});
                                area_risco = vertice.risco;
                            });

                            coordenadas.push({lat: parseFloat(coordenadas[0].lat), lng: parseFloat(coordenadas[0].lng)});

                            var cor="";
                            if (area_risco == 1)
                                cor="red";
                            else
                                cor="green";

                            console.log(coordenadas);
                            var polygonToDraw = new google.maps.Polygon({
                                paths: coordenadas,
                                strokeColor: cor,
                                strokeOpacity: 0.8,
                                strokeWeight: 2,
                                fillColor: cor,
                                fillOpacity: 0.35
                            });
                            polygonToDraw.setMap(map);
                        });
                    }
                });
            });
        }
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqXROl0SuW2elT5kjVZM1sSLgBtz8eB5U&callback=initMap"></script>
    </body>
</html>