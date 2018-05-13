<?php
/* Menú de propiedades de un tablero */

/* $model app\models\Tableros */
/* $tarjeta app\models\Tarjetas */
/* $equipos app\models\Equipos */

use yii\helpers\Html;
use yii\helpers\Url;

$url_create = Url::to(['listas/create']);

//  JavaScript.
$this->registerJsFile(
    '/js/menu_view.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$js = <<<EOT
    $(document).ready(function() {

        iteracionMenu();
        createLista('$url_create');
    })
EOT;

$this->registerJs($js);

//  CSS.
$this->registerCssFile('/css/menu_view.css')
?>

<!-- Formulario de creación de lista -->
<div class='col-md-2'>
    <?= $this->render('/listas/create', [
        'lista'=>$lista,
        'tablero'=>$model,
    ]) ?>
</div>

<!-- Modificar las propiedades del tablero -->
<div class='col-md-2'>
    <?= $this->render('update', [
        'model'=>$model,
        'equipos'=>$equipos,
    ]) ?>
</div>
