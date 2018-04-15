<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Adjuntos */


?>
<div class='panel panel-default'>
    <div class='panel-heading'>
        <p>
            <?=
                Html::tag(
                    'span',
                    '',
                    ['class'=>'glyphicon glyphicon-link']
                ) . ' Adjuntar un enlace'
            ?>
        </p>
    </div>
    <div class='panel-body'>
        <?= $this->render('_form', [
            'model' => $model,
            'tarjeta'=>$tarjeta,
            'action'=>['adjuntos/create'],
        ]) ?>
    </div>
</div>
