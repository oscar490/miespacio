<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mensajes */


?>
<br>
<div class='row'>
    <div class='col-md-6 col-md-offset-3'>
        <?= $this->render('_form', [
            'nuevo_mensaje'=>$nuevo_mensaje,
            'datos'=>$datos,
        ]) ?>
    </div>

    <div class='col-md-6 col-md-offset-3'>
        <div class='centrado'>
            <strong>
                ¡Envía mensajes privados a tu amigos registrados!
            </strong>
        </div>
    </div>
</div>
