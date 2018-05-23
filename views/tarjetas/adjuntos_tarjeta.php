<?php
/* Contenido de lista de adjuntos de la tarjeta */

/* @var $model app\models\Tarjetas */

use yii\helpers\Html;
use app\components\MyHelpers;
?>

<div class='panel panel-default'>
    <div class='panel-heading'>
        <strong>
            <?=
                MyHelpers::icon('glyphicon glyphicon-paperclip')
                . ' ' . Html::encode('Adjuntos')
            ?>
        </strong>
    </div>

    <!-- Lista de adjunto -->
    <div id='lista_adjuntos_<?= $model->id ?>'class='panel-body'>
        <?= $this->render('lista_adjuntos', [
            'model'=>$model,
        ]) ?>
    </div>
</div>
