<?php
/* Renderizar formulario de creación de tarjeta */

/* @var $this yii\web\View */
/* @var $model app\models\Tarjetas */
use yii\helpers\Html;

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
            'label'=>'Crear',
            'action'=>['tarjetas/create'],
        ]) ?>
    </div>
</div>
