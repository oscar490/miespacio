<?php

use yii\helpers\Url;

// $this->registerJsFile(
//     'js/google_map.js'
// );

$css = <<<EOT
#map {
    height: 400px;
    width: 100%;
   }
EOT;

$this->registerCss($css);

?>
<h1><?= $model->denominacion ?></h1>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjc2m2ESE6-DqLNUUvW5tpB70Krjc1qaY&libraries=places&callback=initMap"
        async defer></script>

<script src="js/google_map.js"></script>


<div class='row'>
    <div class='col-md-4'>
        <div class='panel panel-primary'>
            <div class='panel-heading'>
                Mapa
            </div>

            <div class='panel-body'>
                <!-- <input id="pac-input" class="controls" type="text"
                        placeholder="Enter a location"> -->
                <?= $this->render('/mapas/create', [
                    'model'=>$mapa,
                    'tarjeta'=>$model,
                ]) ?>
            </div>
        </div>
    </div>

    <div class='col-md-8'>
        <div class='panel panel-primary'>
            <div class='panel-heading'>
                Mapa
            </div>

            <div class='panel-body'>
                    <div id="map"></div>
            </div>
        </div>
    </div>
</div>
