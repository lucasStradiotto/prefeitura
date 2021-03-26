<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cadastrar Vértices</title>
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
            overflow-y: hidden;
        }
    </style>

    <style>
        a {
            text-decoration: none;
            color: #999999;
            transition: color 0.3s ease;
        }

        #right-menuToggle {
            display: block;
            position: absolute;
            top: 50px;
            left: 95%;

            z-index: 1;

            -webkit-user-select: none;
            user-select: none;
            height: 100%;
        }

        #right-menuToggle input[type='checkbox'] {
            display: block;
            width: 40px;
            height: 32px;
            position: absolute;
            top: -7px;
            left: -5px;

            cursor: pointer;

            opacity: 0; /* hide this */
            z-index: 50; /* and place it over the hamburger */

            -webkit-touch-callout: none;
        }

        /*
         * Hamburger
         */
        #right-span {
            display: block;
            width: 20px;
            height: 2px;
            margin-bottom: 5px;
            position: relative;

            background: #555;
            border-radius: 3px;

            z-index: 1;

            transform-origin: 4px 0px;

            transition: transform 0.5s cubic-bezier(0.77, 0.2, 0.05, 1.0),
            background 0.5s cubic-bezier(0.77, 0.2, 0.05, 1.0),
            opacity 0.55s ease;
        }

        #right-span:first-child {
            transform-origin: 0% 100%;
        }

        #right-span:nth-last-child(2) {
            transform-origin: 0% 0%;
        }

        /*
         * Transform all the slices of hamburger
         */
        #right-menuToggle input:checked ~ span {
            opacity: 1;
            transform: rotate(-45deg) scale(0.7, 1) translate(-261.5px, -161.5px);
            background: #ccc;
        }

        #right-menuToggle input:checked ~ span:nth-last-child(3) {
            opacity: 1;
            transform: rotate(0deg) translate(-250px, 0px);
        }

        #right-menuToggle input:checked ~ span:nth-last-child(2) {
            opacity: 1;
            transform: rotate(45deg) scale(0.7, 1) translate(-260px, 158px);
        }

        #right-menuToggle input[type='checkbox']:checked {
            transform: translate(-250px, 0px);
        }

        #right-menuToggle input:hover ~ #right-span{
            background: #49cc5f;
        }

        #right-menu {
            position: absolute;
            width: 265px;
            height: 100%;
            margin: -77px 0 0 60px;
            /*padding-left: 30px;*/
            padding-top: 5px;
            box-shadow: 2px 1px 19px #000;

            background: #fff;
            list-style-type: none;
            -webkit-font-smoothing: antialiased;
            /* to stop flickering of text in safari */

            transform-origin: 0% 0%;
            transform: translate(100%, 0);

            transition: transform 0.5s cubic-bezier(0.77, 0.2, 0.05, 1.0);
        }

        #right-menu li {
            margin-left: -30px;
            padding: 5px 0;
            font-size: 15px;
            margin-bottom: 5px;
        }

        #right-menu a :hover{
            background: #EEEEEE;
            color: #333;
        }

        #right-menu svg{
            margin-left: 20px;
        }

        /*
         * And let's fade it in from the left
         */
        #right-menuToggle input:checked ~ ul {
            transform: scale(1, 1);
            opacity: 1;
        }

        #right-menuToggle input[type='checkbox']:checked ~ #right-menu {
            transform: translate(-105%, 0);
            opacity: 1;
        }

        #right-menu li hr {
            width: 220px;
        }
    </style>
</head>
<body>

<div id="right-menuToggle">

    <!--
    A fake / hidden checkbox is used as click reciever,
    so you can use the :checked selector on it.
    -->
    <input id="open-right-menu" type="checkbox"/>

    <!--
    Some spans to act as a hamburger.

    They are acting like a real hamburger,
    not that McDonalds stuff.
    -->
    <span id="right-span"></span>
    <span id="right-span"></span>
    <span id="right-span"></span>

    <!--
    Too bad the menu has to be inside of the button
    but hey, it's pure CSS magic.
    -->
    <ul id="right-menu" style="overflow-y: auto;">
        <div id="lista">
            <li>
                <p style="margin-top: 100px;">Poligono: {{$poligono->nome}}</p>
            </li>
            @section('')
        </div>
        <div>
            <form action="{{route('storeVerticeCerca')}}" method="get" id="form-vertices">
                <input type="hidden" name="latitudes[]" id="latitude">
                <input type="hidden" name="longitudes[]" id="longitude">
                <input type="hidden" name="poligono_id" value="{{$poligono->id}}">
                <button id="add-vertices">Adicionar Vértices</button>
            </form>
        </div>
    </ul>
</div>

<div id="map"></div>

<script src="{{ URL::asset('js/app.js') }}"></script>
<script>
    var map;
    var pointsToAdd = [];
    var marcadoresMapa = [];
    var markerIndex = 0;
    function initMap()
    {
        map = new google.maps.Map(document.getElementById('map'),
        {
            zoom: 15,
            center: {lat: -21.674787, lng: -49.753732},
            mapTypeId: 'terrain'
        });
        // In the following example, markers appear when the user clicks on the map.
        // Each marker is labeled with a single alphabetical character.
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var labelIndex = 0;

        // This event listener calls addMarker() when the map is clicked.
        google.maps.event.addListener(map, 'click', function(event) {
            addMarker(event.latLng, map);
            if (!$("#open-right-menu").is(":checked"))
            {
                $("#open-right-menu").prop('checked', true);
            }
        });


        // Adds a marker to the map.
        function addMarker(location, map)
        {
            // Add the marker at the clicked location, and add the next-available label
            // from the array of alphabetical characters.
            var marker = new google.maps.Marker({
                position: location,
                label: labels[labelIndex++ % labels.length],
                map: map
            });
            marcadoresMapa.push(marker);
            var point = {lat: location.lat(), lng: location.lng()};

            var label = marker.label;

            pointsToAdd.push(point);
            var geocoder = new google.maps.Geocoder;
            convert(geocoder, point, label, markerIndex);
            markerIndex++;
        }
        google.maps.event.addDomListener(window, 'load', initMap);

        function convert(geocoder, latLng, label, markerIndex)
        {
            geocoder.geocode({'location': latLng}, function (results, status) {
                if (status === 'OK') {
                    if (results[0]) {
                        $('#lista').append("<li><p>" +label + "<br>" + results[0].formatted_address + "</p> " +
                            "<button onclick='deletaBotao(this)' class='markers' id="+markerIndex+" style='float: right'>X</button> <hr/> </li>");
                    } else {
                        console.log('No results found');
                    }
                } else {
                    console.log('Geocoder failed due to: ' + status);
                }
            });
        }

    }
    function deletaBotao(botao) {
        var id = $(botao)[0].id;
        $(botao).parent().remove();

        var marcadores = document.getElementsByClassName('markers');
        for (var i=0; i < marcadores.length; i++)
        {
            if (marcadores[i].id > id)
            {
                marcadores[i].id -= 1;
            }
        }
        clearSpecificMarker(marcadoresMapa[id]);
        marcadoresMapa.splice(id, 1);
        markerIndex--;
    }

    function setMapOnSpecifc(marker, map) {
        marker.setMap(map);
    }

    function clearSpecificMarker(marker) {
        setMapOnSpecifc(marker, null);
    }

    $("#add-vertices").click(function(e){
        e.preventDefault();
        var latitudes = [];
        var longitudes = [];
        for (var i=0; i<pointsToAdd.length; i++)
        {
            latitudes.push(pointsToAdd[i].lat);
            longitudes.push(pointsToAdd[i].lng);
        }
//        console.log();
        $("#latitude").val(latitudes);
        $("#longitude").val(longitudes);
//        console.log($("#latitude").val());
        $("#form-vertices").submit();
    });


</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqXROl0SuW2elT5kjVZM1sSLgBtz8eB5U&callback=initMap"></script>
</body>
</html>