<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tarjetas */


?>

<div class='panel panel-primary'>
    <div class='panel-heading'>
        <strong>
            <?=
                Html::tag(
                    'span',
                    '',
                    ['class'=>'glyphicon glyphicon-plus']
                ) . ' ' .
                Html::encode('Crear tarjeta');
            ?>
        </strong>
    </div>
    <div class='panel-body'>
        <?= $this->render('_form', [
            'model' => $model,
            'tablero'=>$tablero,
        ]) ?>
    </div>
</div>
