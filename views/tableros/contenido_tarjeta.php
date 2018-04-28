<?php

/** Contenido de la tarjeta */

/* @var $tarjeta app\models\Tarjetas */
/* @var $adjunto app\models\Adjuntos */

use app\components\MyHelpers;
use yii\helpers\Html;

?>
<!-- Modal contenido tarjeta -->
<?php MyHelpers::modal_begin(
        'Contenido tarjeta',
        MyHelpers::icon('glyphicon glyphicon-eye-open'),
        'btn-xs btn-default'
); ?>

    <?= $this->render('/tarjetas/view',[
        'model' => $tarjeta,
        'adjunto'=>$adjunto
    ]) ?>

<?php MyHelpers::modal_end() ?>


<!-- Botón de eliminar tarjeta -->
<?=
    Html::button(
        MyHelpers::icon('glyphicon glyphicon-remove'),
        [
            'class'=>'btn btn-xs btn-default',
            'id'=>"btn_delete_tarjeta_$tarjeta->id",
        ]
    );
?>
