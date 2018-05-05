$(document).ready(function(){
TweenLite.fromTo($('.mapboxgl-ctrl-geocoder'),3,{x:500}, {x:0,y:0,opacity: 1});
TweenLite.fromTo($('.map-overlay-inner'),3,{x:-500}, {x:0,y:0,opacity: 1});
});

mapboxgl.accessToken = 'pk.eyJ1IjoiYWxpa2l5YW55IiwiYSI6ImNqZW43Mm9wYzBmOW8yd3BiZHMzcm9kcG4ifQ.dOhD9h204eeqVa-dLMqRxQ';
var bounds = [
    [-24.27974 , 42.29207], // Southwest coordinates
    [40.18315, 62.10294]  // Northeast coordinates
];
var map = new mapboxgl.Map({
container: 'map',
style: 'mapbox://styles/mapbox/dark-v9',
center: [-1, 60], // starting position
zoom: 1, // starting zoom
bearing: 250,
pitch: 0,
maxBounds: bounds
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

   var bounds = [
       [-74.04728500751165, 40.68392799015035], // Southwest coordinates
       [-73.91058699000139, 40.87764500765852]  // Northeast coordinates
   ];

  var arrangeData = function(data){
    var obj = {
      type:"FeatureCollection",
      features:[]
    };
    data.forEach(function(element){
      // console.log(element);
           obj.features.push({
             "type": "Feature",
             "geometry": {
                 "type": "Point",
                 "coordinates": [element['Longitude'], element['Latitude']]
             },
             "properties": {
                 "title": element['Location'],
                 "icon": "monument",
                 "numOfCompany": Number(element['numOfCompany'])
             }
           })

    })
    return obj;
  }
  var apiURL;
  $('#industry').on('change', function(event){
    //prevent from submiting
    event.preventDefault();
    map.flyTo({
        // These options control the ending camera position: centered at
        // the target, at zoom level 9, and north up.
        center: [-2, 53],
        zoom: 5.4,
        // These options control the flight curve, making it move
        // slowly and zoom out almost completely before starting
        // to pan.
        speed: 0.4, // make the flying slow
        curve: 0.4, // change the speed at which it zooms out
        pitch: 0,
        bearing: 0,
    });

    var apiURL = "./Web_Service/stableCompaniesCoordinates.php?Industry=" + this.value ;

    $.getJSON(apiURL, function(data){

      if(map.getLayer('points')){
        map.removeLayer('points');
      }
      if(map.getSource('points')){
        map.removeSource('points');
      }
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
               duration: 6000
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
