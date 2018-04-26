<?php
/* Menú de propiedades de un tablero */

/* $model app\models\Tableros */
/* $tarjeta app\models\Tarjetas */
/* $equipos app\models\Equipos */

use yii\helpers\Html;
use yii\helpers\Url;

$url_create = Url::to(['listas/create']);

$this->registerJsVar('url_create', $url_create);

$this->registerJsFile(
    '/js/menu_view.js',
    [
        'depends'=>[\yii\web\JqueryAsset::className()],
        'url_create' => $url_create,
    ]
);

$this->registerCssFile('/css/menu_view.css')
?>

<!-- Formulario de creación de lista -->
<div class='col-md-3'>
    <?= $this->render('/listas/create', [
        'lista'=>$lista,
        'tablero'=>$model,
    ]) ?>
</div>

<!-- Modificar el tablero -->
<div class='col-md-3'>
    <?= $this->render('update', [
        'model'=>$model,
        'equipos'=>$equipos,
    ]) ?>
</div>
