<?php

use yii\helpers\Html;
use app\components\MyHelpers;
/* @var $this yii\web\View */
/* @var $model app\models\Tableros */
/* @var $equipos app\models\Equipos */

?>

<!-- Formulario de propiedades del tablero -->

<div  class='panel panel-default'>
    <div id='header_menu' class='panel-heading'>
        <strong>
            <?=
                MyHelpers::icon('glyphicon glyphicon-edit') . ' ' .
                Html::encode('Propiedades ')
            ?>
        </strong>
    </div>
    <div class='panel-body'>
        <?= $this->render('_form', [
            'tablero' => $model,
            'equipo'=>$model->equipo,
            'equipos'=>$equipos,
            'label'=>'Modificar',
            'action'=>['tableros/update', 'id'=>$model->id]
        ]) ?>

        <!-- Eliminar el tablero -->
        <?=
            Html::button(
                Html::tag(
                    'span',
                    '',
                    ['class'=>'glyphicon glyphicon-remove-sign']
                ) . ' ' .
                'Eliminar',
                [
                    'class'=>'btn btn-danger btn-block',
                    'id'=>'btn_eliminar',
                ]
            );
        ?>
    </div>
</div>
