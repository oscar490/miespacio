<?php
/* Menú de propiedades de un tablero */

/* $model app\models\Tableros */
/* $tarjeta app\models\Tarjetas */
/* $equipos app\models\Equipos */

use yii\helpers\Html;
use yii\helpers\Url;

$url_create = Url::to(['listas/create-ajax']);

$this->registerJsVar('url', $url_create);

$this->registerJsFile(
    '/js/menu_view.js',
    [
        'depends'=>[\yii\web\JqueryAsset::className()],
        'url' => $url_create
    ]
);

$this->registerCssFile('/css/menu_view.css')
?>

<!-- Formulario de creación de lista -->
<?= $this->render('/listas/create', [
    'lista'=>$lista,
    'tablero'=>$model,
]) ?>

<!-- Modificar el tablero -->
<?= $this->render('update', [
    'model'=>$model,
    'equipos'=>$equipos,
]) ?>
