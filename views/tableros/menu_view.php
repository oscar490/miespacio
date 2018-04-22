<?php
/* Menú de propiedades de un tablero */

/* $model app\models\Tableros */
/* $tarjeta app\models\Tarjetas */
/* $equipos app\models\Equipos */

use yii\helpers\Html;

$this->registerJsFile(
    '/js/menu_view.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$this->registerCssFile('/css/menu_view.css')
?>

<div id='menu' class='col-md-3'>
    <!-- Formulario de creación de tarjeta -->
    <?= $this->render('/listas/create', [
        'lista'=>$lista,
        'tablero'=>$model,
    ]) ?>

    <!-- Modificar el tablero -->
    <?= $this->render('update', [
        'model'=>$model,
        'equipos'=>$equipos,
    ]) ?>

</div>
