<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Adjuntos */

$url = Url::to(['adjuntos/create-ajax']);

$js = <<<EOT
    $("#form_adjunto_create_$tarjeta->id").on('beforeSubmit', function() {
        var form = $(this);

        if (form.find('.has-error').length) {
            console.log('entra');
            return false;
        }

        $.ajax({
            url: '$url',
            type: 'POST',
            data: form.serialize(),
            success: function(data) {
                $("div[data-key='$tarjeta->id'] div#lista_adjunto").html(data);
            }
        });

        return false;
    })
EOT;

$this->registerJs($js);
?>
<div class='panel panel-default'>
    <div id='header_form_adjunto_<?= $tarjeta->id ?>'class='panel-heading'>
        <strong>
            <?=
                MyHelpers::icon('glyphicon glyphicon-link') .
                ' ' . 'Adjuntar un enlace'
            ?>
        </strong>
        <small>(click aquí)</small>
    </div>
    <div class='panel-body'>
        <?= $this->render('_form', [
            'model' => $model,
            'tarjeta'=>$tarjeta,
            'action'=>['adjuntos/create'],
            'id_form'=>"form_adjunto_create_$tarjeta->id",
        ]) ?>
    </div>
</div>
