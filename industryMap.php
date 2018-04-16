<?php
require_once "header.phtml";
require_once "adminSideNav.phtml";
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <title>Display a map</title>
    <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
    <script type="text/javascript" src="./assets/js/jquery-3.2.1.min.js"></script>
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.44.1/mapbox-gl.js'></script>
     <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.44.1/mapbox-gl.css' rel='stylesheet' />
     <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.1.1/mapbox-gl-geocoder.min.js'></script>
     <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.1.1/mapbox-gl-geocoder.css' type='text/css' />
     <link rel="stylesheet" href="./assets/css/adminStyle.css"/>
     <link rel="stylesheet" href="z.css">
    <div id='map' class="bluredSection"></div>
    <div class='map-overlay top'>
    <div class='map-overlay-inner bluredSection'>
            <fieldset>
                <label>Select Industry</label>
                <select id='industry' name='layer' >
                    <option value='water'>Water</option>
                    <option value='building'>Buildings</option>
                    <option value='building'>Buildings</option>
                    <option value='building'>Buildings</option>
                    <option value='building'>Buildings</option>
                </select>
            </fieldset>
        </div>
    </div>

    <style>
        body { margin:0; padding:0; background: #191a1a}
        #map { width:100vw; height: 100%; margin: 0 auto;}
        .mapboxgl-ctrl-geocoder {
            width: 100vw;
            border-radius: 0px;
            top: -10;
        }
.hamburger{
  margin: 1rem;
}
        .hamburger .line {
           background-color: #ececec;
        }
        .map-overlay {
            font: 12px/20px 'Dosis', Arial, Helvetica, sans-serif;
            position: absolute;
            bottom: 0;
            left: 0;
            padding: 10px;
        }

        .map-overlay .map-overlay-inner {
            background-color: #fff;
            box-shadow:0 1px 2px rgba(0, 0, 0, 0.10);
            border-radius: 0px;
            padding: 10px;
            margin-bottom: 10px;
            opacity: 0;

        }

        .map-overlay-inner fieldset {
            border: none;
            padding: 0;
            margin: 0 0 10px;
        }




    </style>
    <script>
    mapboxgl.accessToken = 'pk.eyJ1IjoiYWxpa2l5YW55IiwiYSI6ImNqZW43Mm9wYzBmOW8yd3BiZHMzcm9kcG4ifQ.dOhD9h204eeqVa-dLMqRxQ';
    var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/dark-v9',
    center: [-1, 35], // starting position
    zoom: 3, // starting zoom
    bearing: 30,
    pitch: 0
    });
    var geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken
    });

    map.addControl(geocoder);

    // After the map style has loaded on the page, add a source layer and default
    // styling for a single point.
    map.on('load', function() {


        map.addSource('single-point', {
            "type": "geojson",
            "data": {
                "type": "FeatureCollection",
                "features": []
            }
        });

        map.addLayer({
            "id": "point",
            "source": "single-point",
            "type": "circle",
            "paint": {
                "circle-radius": 5,
                "circle-color": "#007cbf"
            }
        });


        // Listen for the `geocoder.input` event that is triggered when a user
        // makes a selection and add a symbol that matches the result.
        geocoder.on('result', function(ev) {
            map.getSource('single-point').setData(ev.result.geometry);
        });

        map.flyTo({
            // These options control the ending camera position: centered at
            // the target, at zoom level 9, and north up.
            center: [-2, 53],
            zoom: 6.5,
            bearing: 0,
            // These options control the flight curve, making it move
            // slowly and zoom out almost completely before starting
            // to pan.
            speed: 0.4, // make the flying slow
            curve: 0.4, // change the speed at which it zooms out
            pitch: 90,
            bearing: -10,
        });


        map.addLayer({
           'id': 'population',
           'type': 'circle',
           'source': {
               type: 'vector',
               url: 'mapbox://examples.8fgz4egr'
           },
           'source-layer': 'sf2010',
           'paint': {
               // make circles larger as the user zooms from z12 to z22
               'circle-radius': {
                   'base': 1.75,
                   'stops': [[12, 2], [22, 180]]
               },
               // color circles by ethnicity, using a match expression
               // https://www.mapbox.com/mapbox-gl-js/style-spec/#expressions-match
               'circle-color': [
                   'match',
                   ['get', 'ethnicity'],
                   'White', '#fbb03b',
                   'Black', '#223b53',
                   'Hispanic', '#e55e5e',
                   'Asian', '#3bb2d0',
                   /* other */ '#ccc'
               ]
           }
       });


      var arrangeData = function(data){
        var obj = {
          type:"FeatureCollection",
          features:[]
        };
        data.forEach(function(element){
          console.log(element);
               obj.features.push({
                 "type": "Feature",
                 "geometry": {
                     "type": "Point",
                     "coordinates": [element['longitude'], element['latitude']]
                 },
                 "properties": {
                     "title": element['location'],
                     "icon": "monument",
                     "numOfCompany": Number(element['numOfCompany'])
                 }
               })

        })
        return obj;
      }
      $('#industry').on('change', function(event){
        //prevent from submiting
        event.preventDefault();
        map.flyTo({
            // These options control the ending camera position: centered at
            // the target, at zoom level 9, and north up.
            center: [-2, 53],
            zoom: 5.5,
            bearing: 0,
            // These options control the flight curve, making it move
            // slowly and zoom out almost completely before starting
            // to pan.
            speed: 0.4, // make the flying slow
            curve: 0.4, // change the speed at which it zooms out
            pitch: 0,
            bearing: -10,
        });
        $.getJSON("./itApi.php", function(data){
             map.addLayer({
                 "id": "points",
                 "source": {
                     "type": "geojson",
                     "data": arrangeData(data)
                 },
                 "type": "circle",
                 "paint": {
                 "circle-radius":
                       ["*",4, ["ln", ["get", "numOfCompany"]] ],

                 "circle-opacity": 0,
                 "circle-opacity-transition": {
                   duration: 4000
                 },
                 "circle-color":
                   ["interpolate",
                     ["linear"], ['get', 'numOfCompany'], 10,
                   'rgba(0, 247, 151, 0.43)',
                   20,
                   'rgba(0, 247, 151, 0.73)',
                   30,
                   'rgba(180, 250, 250, 0.67)',
                   40,
                   'rgba(159, 99, 255, 0.30)',
                   50,
                   'rgba(159, 99, 255, 0.40)',
                   60,
                   'rgba(159, 99, 255, 0.50)',
                   70,
                   'rgba(159, 99, 255, 0.67)',
                   80,
                   'rgba(221, 72, 201, 0.40)',
                   90,
                   'rgba(221, 72, 201, 0.67)',
                   100,
                   'rgba(240,255,0,0.5)',
                   300,
                   'rgba(238, 154, 11, 0.5)',
                   500,
                   'rgba(31, 228, 199, 0.5)',
                   700,
                   'rgba(26, 121, 232, 0.5)',
                   800,
                   'rgba(61, 26, 232, 0.5)',
                   1000,
                   'rgba(255, 25, 25, 0.74)',
                   5000,
                   'rgba(255, 0, 0, 0.77)',
                   10000,
                   'rgba(254, 5, 0, 0.91)',
                   15000,
                   'rgba(255, 5, 0, 1)'
                   ]
               }
         });
         setTimeout(function() {
           map.flyTo({
                       // These options control the ending camera position: centered at
                       // the target, at zoom level 9, and north up.
                       center: [-2, 53],
                       zoom: 6.5,
                       bearing: 0,
                       // These options control the flight curve, making it move
                       // slowly and zoom out almost completely before starting
                       // to pan.
                       speed: 0.4, // make the flying slow
                       curve: 0.4, // change the speed at which it zooms out
                       pitch: 90,
                       bearing: -10,
                   });
           map.setPaintProperty('points', 'circle-opacity', 1);
         }, 7400);

         });
         });
      });





    </script>
</body>
</html>
<?php
require_once "footer.phtml";
?>
<script>
$(document).ready(function(){
TweenLite.fromTo($('.mapboxgl-ctrl-geocoder'),3,{x:500}, {x:0,y:0,opacity: 1});
TweenLite.fromTo($('.map-overlay-inner'),3,{x:-500}, {x:0,y:0,opacity: 1});
});
</script>
