(function(){
TweenLite.fromTo($('.mapboxgl-ctrl-geocoder'),3,{x:500}, {x:0,y:0,opacity: 1});
TweenLite.fromTo($('.map-overlay-inner'),3,{x:-500}, {x:0,y:0,opacity: 1});

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
        zoom: 5.3,
        // These options control the flight curve, making it move
        // slowly and zoom out almost completely before starting
        // to pan.
        speed: 0.3, // make the flying slow
        curve: 0.4, // change the speed at which it zooms out
        pitch: 20,
        bearing: 0,
    });

    var apiURL = "./Web_Service/startUpCompaniesCoordinates.php?Industry=" + this.value ;

    $.getJSON(apiURL, function(data){
      // if(map.getLayer('point')){
      //   map.removeLayer('point');
      // }
      if(map.getLayer('points')){
        map.removeLayer('points');
      }
      if(map.getSource('points')){
        map.removeSource('points');
      }
      // map.removeLayer('point');
      // map.removeSource('point');
      console.log(map.getSource('points'));
      // console.log(map.getStyle().layers);
      // console.log(map.getStyle().sources);

      console.log(map.getLayer('point'));
      console.log(map.getLayer('points'));

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
                 'rgba(232, 106, 26, 0.71)',
                 800,
                 'rgba(232, 156, 26, 0.77)',
                 1000,
                 'rgba(232, 245, 88, 0.99)',
                 5000,
                 'rgba(255, 245, 0, 0.91)',
                 10000,
                 'rgba(254, 5, 0, 0.66)',
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
})();
