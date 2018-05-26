<?php
/* Visor de imágenes de Tarjeta */

/* @var $tajeta app\models\Tarjetas */

use yii\helpers\Html;
use app\components\MyHelpers;

$css = <<<EOT

    button[id^='visualizar_img'] {
        float: right;
    }
EOT;
$this->registerCss($css);

$js = <<<EOT
    $("#visualizar_img_$tarjeta->id").on('click', function() {
        $(this).parent().next().find('img').slideToggle();
    })
EOT;

$this->registerJs($js);


?>

<div class='panel panel-default'>
    <div class='panel-heading'>
        <?= MyHelpers::icon('glyphicon glyphicon-picture') ?>
        &nbsp;

        <strong><?= Html::encode('Viasualizar imágen') ?></strong>

        <?=
            Html::button(
                MyHelpers::icon('glyphicon glyphicon-eye-open'),
                [
                    'class'=>'btn btn-xs btn-default',
                    'id'=>"visualizar_img_$tarjeta->id"
                ]
            );
        ?>
    </div>

    <div id="view_imagen_<?= $tarjeta->id ?>" class='panel-body'>

    </div>
</div>
