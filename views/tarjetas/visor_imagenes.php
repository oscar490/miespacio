<?php
/* Visor de imágenes de Tarjeta */

/* @var $tajeta app\models\Tarjetas */

use yii\helpers\Html;
use app\components\MyHelpers;

?>

<div class='panel panel-default'>
    <div class='panel-heading'>
        <?= MyHelpers::icon('glyphicon glyphicon-picture') ?>
        &nbsp;

        <strong><?= Html::encode('Imágen') ?></strong>
    </div>

    <div id="view_imagen_<?= $tarjeta->id ?>" class='panel-body'>

    </div>
</div>
