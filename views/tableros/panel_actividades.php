<?php
/* Vista de panel de actividades sobre el tablero */

/* @var $miembro app\models\Miembros */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;

$css = <<<EOT
    #header_actividades + div {
        display: none;
    }
EOT;
$this->registerCss($css);

$js = <<<EOT
    $("#header_actividades").on('click', function() {
        $(this).next().slideToggle();
    })
EOT;

$this->registerJs($js);
?>

<div class='panel panel-default'>
    <div id='header_actividades' class='panel-heading'>
        <strong>

            <?= MyHelpers::icon('glyphicon glyphicon-align-right') ?>
            &nbsp;
            <?=
                Html::encode("Actividades")
            ?>
        </strong>
    </div>
    <div id='notificaciones' class='panel-body content-scroll'>
        <?= $this->render('/notificaciones/lista_notificaciones', [
            'notificaciones'=>$model->getNotificaciones(),
        ]) ?>
    </div>
</div>
