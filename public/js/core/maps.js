var map;
var geocoder;
var centerChangedLast;
var reverseGeocodedLast;
var currentReverseGeocodeResponse;

function initialize(map_lat, map_lon, map_zoom) {

    map_lat = typeof map_lat !== 'undefined' ? map_lat : '-2.2137852568859406';
    map_lon = typeof map_lon !== 'undefined' ? map_lon : '-79.88756408465575';

    map_zoom = typeof map_zoom !== 'undefined' ? map_zoom : 6;

    var latlng = new google.maps.LatLng(map_lat, map_lon);

    var myOptions = {
        zoom: map_zoom,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    geocoder = new google.maps.Geocoder();
    setupEvents();
    centerChanged();
    var opt = {
        minZoom: 3
    };
    map.setOptions(opt);

}

function setupEvents() {

    reverseGeocodedLast = new Date();
    centerChangedLast = new Date();

    setInterval(function() {
        if ((new Date()).getSeconds() - centerChangedLast.getSeconds() > 1) {
            if (reverseGeocodedLast.getTime() < centerChangedLast.getTime())
                reverseGeocode();
        }
    }, 1000);

    google.maps.event.addListener(map, 'center_changed', centerChanged);
    google.maps.event.addDomListener(document.getElementById('crosshair'), 'dblclick', function() {
        map.setZoom(map.getZoom() + 1);
    });

}

function getCenterLatLngText() {

    return '(' + map.getCenter().lat() + ', ' + map.getCenter().lng() + ')';

}

function centerChanged() {

    centerChangedLast = new Date();
    var latlng = getCenterLatLngText();
    var lat = map.getCenter().lat();
    var lng = map.getCenter().lng();
    document.getElementById('lat').value = lat;
    document.getElementById('lng').value = lng;
    document.getElementById('txtLatitud').value = lat;
    document.getElementById('txtLongitud').value = lng;
    reverseGeocode();

}

function reverseGeocode() {

    reverseGeocodedLast = new Date();
    geocoder.geocode({
        latLng: map.getCenter()
    }, reverseGeocodeResult);

}

function reverseGeocodeResult(results, status) {

    currentReverseGeocodeResponse = results;

    if (status == 'OK') {
        if (results.length == 0) {
            document.getElementById('formatedAddress').innerHTML = '???';
        } else {
            document.getElementById('formatedAddress').innerHTML = results[0].formatted_address;
        }
    } else {
        document.getElementById('formatedAddress').innerHTML = '???';
    }

}

function geocode() {

    var address = document.getElementById("address").value;

    geocoder.geocode({
        'address': address,
        'partialmatch': true
    }, geocodeResult);

}

function geocodeResult(results, status) {

    if (status == 'OK' && results.length > 0) {
        map.fitBounds(results[0].geometry.viewport);
    } else {
        // alert("Geocode no cargó por la siguiente razón: " + status);
    }

}

function addMarkerAtCenter() {

    var marker = new google.maps.Marker({
        position: map.getCenter(),
        map: map
    });

    var text = 'Lat/Lng: ' + getCenterLatLngText();

    if (currentReverseGeocodeResponse) {
        var addr = '';
        if (currentReverseGeocodeResponse.size == 0) {
            addr = 'None';
        } else {
            addr = currentReverseGeocodeResponse[0].formatted_address;
        }
        text = text + '<br>' + 'Dirección: <br>' + addr;
    }

    var infowindow = new google.maps.InfoWindow({
        content: text
    });

    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map, marker);
    });

}

$(document).ready(function() {

    initialize();

});

$(document).keypress(function(event) {

    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        geocode();
    }

});
