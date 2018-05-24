<?php
/* Contenido de lista de adjuntos de la tarjeta */

/* @var $model app\models\Tarjetas */

use yii\helpers\Html;
use app\components\MyHelpers;

if ($model->getAdjuntos()->count() > 2) {
    $scroll = 'content-scroll';

} else {
    $scroll = '';
}
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
    <div id='lista_adjuntos_<?= $model->id ?>'class='panel-body <?= $scroll ?>'>
        <?= $this->render('lista_adjuntos', [
            'model'=>$model,
        ]) ?>
    </div>
</div>
