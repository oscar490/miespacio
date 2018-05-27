<?php
/* Vista de la lista de notificaciones */
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $notificaciones yii\db\ActiveQuery */

$css = <<<EOT
    div#content_notificaciones {
        height: 300px;
    }
EOT;

$this->registerCss($css);

?>

<div id='content_notificaciones' class='content-scroll'>
    <?= $this->render('lista_notificaciones', [
        'notificaciones'=>$notificaciones,
        'id_tablero'=>null,

    ]) ?>
</div>
