<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Adjuntos */

?>

<div class='panel panel-default'>
    <div class='panel-heading'>
        <?=
            Html::encode('Modificar');
        ?>
    </div>
    <div class='panel-body'>
        <?= $this->render('_form', [
            'model' => $model,
            'action'=>$action,
            'tarjeta'=>$tarjeta,
        ]) ?>
    </div>
</div>
