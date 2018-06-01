<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Mensajes */

if ($model->tieneAsunto) {
    $asunto = $model->asunto;


} else {
    $asunto = "(Sin asunto)";
}

$datos_emisor = $model->emisor0->datosUsuarios;
$datos_receptor = $model->receptor0->datosUsuarios;

if  ($model->esRecibido) {
    $usuario = $datos_emisor;

} else {
    $usuario = $datos_receptor;
}
?>

<div class='row'>

    <!-- Emisor o Receptor -->
    <div class='col-md-6'>
        <?=
            Html::img(
                $usuario->url_imagen,
                ['class'=>'img-rounded logo']
            );
         ?>
        &nbsp;
        <?= Html::encode(
            $usuario->nombre_completo . ' ' .
            $usuario->apellidos
            )
        ?>
    </div>

    <!-- Asunto -->
    <div class='col-md-3'>
        <?= Html::encode($asunto) ?>

    </div>


</div>
<hr>
