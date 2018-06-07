<?php

use yii\helpers\Url;
use app\components\MyHelpers;
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
<h3>
    <storng>
        <span class='label label-primary'>
            <?= $tarjeta->denominacion ?>
        </span>
    </storng>
</h3>

<br>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjc2m2ESE6-DqLNUUvW5tpB70Krjc1qaY&libraries=places&callback=initMap"
        async defer></script>

<script src="js/google_map.js"></script>


<div class='row'>
    <!-- Buscador de ubicación -->
    <div class='col-md-4'>
        <div class='panel panel-primary'>
            <div class='panel-heading'>
                <strong>
                    <?=
                        MyHelpers::icon('glyphicon glyphicon-search')
                        . ' ' . 'Buscar ubicación';
                    ?>
                </strong>
            </div>

            <div class='panel-body'>
                <?= $this->render('_form', [
                    'model'=>$model,
                    'tarjeta'=>$tarjeta,
                ]) ?>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-12'>
                <div class='panel panel-primary'>
                    <div class='panel-heading'>
                        <strong>
                            Añade ubicaciones de mapas como adjuntos
                            en la tarjeta.

                        </strong>
                        <hr>
                        <strong>
                            Se puede visualuzar ubicaciones desde este
                            mapa interactivo.
                        </strong>
                        <hr>

                        <strong>
                            Modifica desde aqui la ubicación existente.
                        </strong>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Renderizado de mapa -->
    <div class='col-md-8'>
        <div class='panel panel-primary'>
            <div id='nombre_ubicacion' class='panel-heading'>
                <strong>
                    <?=
                        MyHelpers::icon('glyphicon glyphicon-map-marker');
                    ?>
                    <span id='ubicacion_span'>
                        <?=
                            $model->ubicacion;
                        ?>
                    </span>
                </strong>
            </div>

            <div class='panel-body'>
                    <div id="map"></div>
            </div>
        </div>
    </div>
</div>
