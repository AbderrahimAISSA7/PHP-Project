
let map;//with let the variable is scoped to the immediate closing block denoted by {}, will hold the map later
window.addEventListener('DOMContentLoaded', ()=>{// window is the current window; addEventListener to window(target), 
     //the event is DOMContentLoaded fires when the initial HTML document has been completely loaded and parsed
     //without waiting for stylesheets, images and subframes to finish loading
     //()=> arrow function with certain limitations; to be called on Event
  map = L.map('carte').fitBounds([[50.5,2.789],[50.795,3.272]]);//Leaflet library for showing maps in js.
  //'carte' is the ID of the div element
  //fitBounds() takes in an array of two points, each point is an array of two floats 
  //the first point is a upper left and the second is the lower right 
  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {// without a tileLayer the map will be empty, url copied for openstreet maps
       attribution: '©️ Al Ansari and Co'// just giving credit where it's due
  }).addTo(map);// adds the tilelayer used to the map object previously created

});

// function createDetailMap(commune){
//  let div = document.querySelector('#details div.map');
//  if (div == null){
//   div = document.createElement('div');
//   document.getElementById('details').appendChild(div);
//  }
//  div.classList.add('map');
//  let dmap = L.map(div);
//  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
//        attribution: '©️ <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
//   }).addTo(dmap);
//  let group = L.featureGroup().addTo(dmap);
//  let geo = JSON.parse(commune.geo_shape);
//  L.geoJSON([geo]).addTo(group);
//  dmap.fitBounds(group.getBounds());
// }