<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cadastrar Vértices</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">

    {{--Style do right menu--}}
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
            margin-top: 5px;
            margin-left: 5px;
            display: block;
            width: 20px;
            height: 2px;
            margin-bottom: 5px;
            position: relative;

            background: #ffffff;
            border-radius: 3px;

            z-index: 1;

            transform-origin: 4px 0px;

            transition: transform 0.5s cubic-bezier(0.77, 0.2, 0.05, 1.0),
            background 0.5s cubic-bezier(0.77, 0.2, 0.05, 1.0),
            opacity 0.55s ease;
        }
        .circle-to-right-menu{
            width: 30px;
            height: 30px;
            border: 6px solid #0a2eff;
            border-radius: 50%;
            box-shadow: rgba(0, 0, 0, 0.3) 2px 3px 3px;
            cursor: pointer;
            background: #0a2eff;
            z-index: 1;
            top: 43px;
            left: 94.5%;
            position: absolute;
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
            margin: -77px 0 0 65px;
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

        .div-marker{
            border: transparent;
            background-color: transparent;
        }
    </style>

</head>
<body style="overflow: hidden; margin: 0; font-family: 'Raleway', sans-serif;">

<div id="right-menuToggle">
    <input id="open-right-menu" type="checkbox"/>

    <span id="right-span"></span>
    <span id="right-span"></span>
    <span id="right-span"></span>

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
				<input type="hidden" name="indexes[]" id="index">
                <input type="hidden" name="poligono_id" value="{{$poligono->id}}">
                <button id="add-vertices">Adicionar Vértices</button>
            </form>
        </div>
    </ul>
</div>

<div id="map" style="width: 100%; height: 100%; position: absolute; z-index: -1;"></div>

<script src="{{ URL::asset('js/app.js') }}"></script>
<script>
    var map;
    var pointsToAdd = [];
    var marcadoresMapa = [];
    var markerIndex = 0;
    var polygon;
    function initMap()
    {
        /*
       Create OSM Map
       */
        var mtAttr = '<a href="https://www.maptiler.com/license/maps/" target="_blank">© MapTiler</a> <a href="https://www.openstreetmap.org/copyright" target="_blank">© OpenStreetMap contributors</a>';

        var basic = L.tileLayer('https://api.maptiler.com/maps/basic/{z}/{x}/{y}.png?key=erA416TAU7wPCFfWlgq1', {attribution: mtAttr}),
            hybrid = L.tileLayer('https://maps.tilehosting.com/styles/hybrid/{z}/{x}/{y}.jpg?key=erA416TAU7wPCFfWlgq1', {attribution: mtAttr});

        map = new L.Map('map', {zoomControl: false, layers: [basic]});

        var baseLayers = {
            "Mapa": basic,
            "Satélite": hybrid
        };
        L.control.layers(baseLayers).setPosition('bottomleft').addTo(map);

        $.getJSON("{{route('getPrefeitura')}}", {}, function(data){
            let latLng = [-21.674787, -49.753732];
            if (data.lat && data.lng) {
                latLng = [data.lat, data.lng];
            }
            map.setView(latLng, 13);
        });


        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        var labelIndex = 0;

        L.DomEvent.addListener(map, 'click', function (event) {
            addMarker(event.latlng, map);
            if (!$("#open-right-menu").is(":checked"))
                $("#open-right-menu").prop('checked', true);
        });

        // Adds a marker to the map.
        function addMarker(location, map)
        {
            let myLatLng = [location.lat, location.lng];
            let label = labels[labelIndex++ % labels.length];

            let myIcon = L.divIcon({
                html: '<div style="width: 4.4vw; height: 4.4vw;">' +
                        '<img style="width: 2.2vw; height: 2.2vw; float: left; z-index: 0;" src="img/redMarker.png"/>'+
                        '<span style="position: absolute; top: 0; left: 0.8vw; z-index: 1; color: white; font-weight: bold;">'+label+'</span>' +
                      '</div>',
                iconAnchor: [15,30],
                className: 'div-marker'
            });
            let marker = L.marker(myLatLng, {
                icon: myIcon
            }).addTo(map);
             marcadoresMapa.push(marker);
            let point = {lat: location.lat, lng: location.lng, index: markerIndex};

            pointsToAdd.push(point);
            list(point, label, markerIndex);
            if (pointsToAdd.length == 1)
                drawPolygon(pointsToAdd);
            else if (pointsToAdd.length >= 2)
                updatePolygon(pointsToAdd);
            markerIndex++;
        }
    }

    L.DomEvent.addListener(window, 'load', initMap);
    
    function list(point, label, markerIndex)
    {
        $('#lista').append("<li><p>" +label + "</p> " +
                            "<button onclick='deletaBotao(this)' class='markers' id="+markerIndex+" style='float: right'>X</button> <hr/> </li>");
    }


    function deletaBotao(botao) {
        let id = $(botao)[0].id;
        $(botao).parent().remove();
    
        let marcadores = document.getElementsByClassName('markers');
        for (var i=0; i < marcadores.length; i++)
        {
            if (marcadores[i].id > id)
                marcadores[i].id -= 1;
        }
        clearSpecificMarker(id);
        marcadoresMapa.splice(id, 1);
        //markerIndex--;
    }

    function clearSpecificMarker(marker) {
        marcadoresMapa[marker].remove();
        pointsToAdd.splice(marker, 1);
        updatePolygon(pointsToAdd);
    }

    function drawPolygon(points){
        polygon = L.polygon(points, {
            color: 'green'
        }).addTo(map);
    }

    function updatePolygon(points){
        polygon.setLatLngs(points);
        polygon.redraw();
    }

    $("#add-vertices").click(function(e){
        e.preventDefault();
        let latitudes = [];
        let longitudes = [];
		let indexes = [];
        for (let i=0; i<pointsToAdd.length; i++)
        {
            latitudes.push(pointsToAdd[i].lat);
            longitudes.push(pointsToAdd[i].lng);
			indexes.push(pointsToAdd[i].index);
        }
		console.log(pointsToAdd);
        $("#latitude").val(latitudes);
        $("#longitude").val(longitudes);
		$("#index").val(indexes);
        $("#form-vertices").submit();
    });


</script>
</body>
</html>