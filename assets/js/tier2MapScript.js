//aniamting input with Tween MAX
(function(){
TweenLite.fromTo($('.mapboxgl-ctrl-geocoder'),3,{x:10,y:-200, rotationX: "-=230"}, {x:0,y:0, rotationX: "+=230",opacity: 1});
mapboxgl.accessToken = 'pk.eyJ1IjoiYWxpa2l5YW55IiwiYSI6ImNqZW43Mm9wYzBmOW8yd3BiZHMzcm9kcG4ifQ.dOhD9h204eeqVa-dLMqRxQ';
var bounds = [
    [-163.21778,-73.16939], // Southwest coordinates
    [ 164.43847,82.14553]  // Northeast coordinates
];
var map = new mapboxgl.Map({
container: 'map',
style: 'mapbox://styles/mapbox/dark-v9',
center: [-1, 35], // starting position
zoom: 1, // starting zoom
bearing: 30,
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
        // These options control the ending camera position: centered at [-2, 53]
        // the target, at zoom level 6.5, and north up.
        style: 'mapbox://styles/mapbox/basic-v9',
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

      //CREATING GEOJASON file
      var arrangeData = function(data){
        var obj = {
          type:"FeatureCollection",
          features:[]
        };
        data.forEach(function(element){
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
   //AJAX CALL To Inside API
   $.getJSON("./Web_Service/mapData.php", function(data){
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
                'rgba(87, 247, 0, 0.43)',
                20,
                'rgba(94, 247, 0, 0.53)',
                30,
                'rgba(0, 246, 69, 0.88)',
                40,
                'rgba(132, 242, 212, 0.63)',
                50,
                'rgba(73, 245, 224, 0.75)',
                60,
                'rgba(82, 150, 241, 0.76)',
                70,
                'rgba(7, 19, 103, 0.53)',
                80,
                'rgba(23, 94, 232, 0.87)',
                90,
                'rgba(18, 5, 42, 0.67)',
                100,
                'rgba(177, 24, 231, 0.48)',
                300,
                'rgba(197, 4, 255, 0.69)',
                500,
                'rgba(238, 14, 176, 0.79)',
                700,
                'rgba(232, 106, 26, 0.5)',
                800,
                'rgba(232, 156, 26, 0.77)',
                1000,
                'rgba(244, 227, 119, 0.74)',
                5000,
                'rgba(255, 245, 0, 0.77)',
                10000,
                'rgba(254, 5, 0, 0.66)',
                15000,
                'rgba(255, 5, 0, 1)'
              ]
          }

    });
    // CONTROLLING POINTS ANIMATION
    setTimeout(function() {
      map.setPaintProperty('points', 'circle-opacity', 1);
    }, 7400);
    });


});
})();
