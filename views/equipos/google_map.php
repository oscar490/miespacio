<?php



$this->registerJsFile(
    'js/google_map.js'
);

$css = <<<EOT
#map {
    height: 400px;
    width: 100%;
   }
EOT;

$this->registerCss($css);
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjc2m2ESE6-DqLNUUvW5tpB70Krjc1qaY&libraries=places&callback=initMap"
        async defer></script>

<input id="pac-input" class="controls" type="text"
        placeholder="Enter a location">
<h3>My Google Maps Demo</h3>
    <div id="map"></div>
