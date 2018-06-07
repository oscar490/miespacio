
function initMap() {

    //  Coordenadas.
    var latitud = parseFloat(document.getElementById('latitud').value);
    var longitud = parseFloat(document.getElementById('longitud').value);

    var coordenadas = {lat: latitud, lng: longitud};
    var map = new google.maps.Map(document.getElementById('map'), {
          center: coordenadas,
          zoom: 10
    });
   //  Entrada de ubicación.
    var input = document.getElementById('pac-input');
    var autocomplete = new google.maps.places.Autocomplete(input);
    input.addEventListener('click', function() {
        this.value = '';
    });


    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();

    //  Creación del marcador.
    var marker = new google.maps.Marker({
      map: map,
      position: coordenadas,
    });

    marker.setVisible(true);
    let lugar = document.getElementById('pac-input').value;
    infowindow.setContent(lugar);
    infowindow.open(map, marker);



    input.addEventListener('blur', function() {
        var place = autocomplete.getPlace();

        if (place.geometry == undefined) {
           growl_error('No existe esa ubicación');
           return;

         }
    })

    autocomplete.addListener('place_changed', function() {

        infowindow.close();
        marker.setVisible(false);

        var place = autocomplete.getPlace();


        if (!place.geometry) {
           growl_error('No existe esa ubicación');
           return;

         }

         document.getElementById('latitud').value = place.geometry.location.lat();
         document.getElementById('longitud').value = place.geometry.location.lng();



         if (place.geometry.viewport) {
             map.fitBounds(place.geometry.viewport);
         } else {
             map.setCenter(place.geometry.location);
             map.setZoom(17);  // Why 17? Because it looks good.
         }

         marker.setIcon(/** @type {google.maps.Icon} */({
           url: place.icon,
           size: new google.maps.Size(71, 71),
           origin: new google.maps.Point(0, 0),
           anchor: new google.maps.Point(17, 34),
           scaledSize: new google.maps.Size(35, 35)
         }));

         marker.setPosition(place.geometry.location);
         marker.setVisible(true);

         var address = '';


         if (place.address_components) {
           address = [
             (place.address_components[0] && place.address_components[0].short_name || ''),
             (place.address_components[1] && place.address_components[1].short_name || ''),
             (place.address_components[2] && place.address_components[2].short_name || '')
           ].join(' ');
         }

         var ubicacion = '<strong>' + place.name + '</strong><br>' + address;

         var formulario = $("#form_map");

         // Modificación de mapa.
         sendAjax(formulario.attr('action'), 'POST', formulario.serialize(), function (data) {
             growl_success('Se ha guardado la última modificación');
             $("div#nombre_ubicacion > strong span#ubicacion_span").text(data);
         });

         infowindow.setContent(ubicacion);
         infowindow.open(map, marker);
     });
}
