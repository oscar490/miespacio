<?php
/* Botones de acción sobre el mensaje */

/* @var $mensaje app\models\Mensajes */

use yii\helpers\Html;
use app\components\MyHelpers;

?>

<?php
    MyHelpers::modal_begin(
        MyHelpers::icon('glyphicon glyphicon-envelope')
            . ' ' . '<strong>Mensaje</strong>',
        MyHelpers::icon('glyphicon glyphicon-new-window'),
        'btn btn-default',
        "view_contenido_$mensaje->id"
    )
?>
    <?= $this->render('contenido_mensaje', [
        'mensaje'=>$mensaje,
    ]) ?>

<?php MyHelpers::modal_end() ?>
