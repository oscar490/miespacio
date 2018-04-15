<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Adjuntos */

$url = Url::to(['adjuntos/create-ajax']);

$js = <<<EOT
    $("#form_adjunto_$tarjeta->id").on('beforeSubmit', function() {
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
        })

        return false;
    })
EOT;

$this->registerJs($js);
?>
<div class='panel panel-default'>
    <div class='panel-heading'>
        <p>
            <?=
                Html::tag(
                    'span',
                    '',
                    ['class'=>'glyphicon glyphicon-link']
                ) . ' Adjuntar un enlace'
            ?>
        </p>
    </div>
    <div class='panel-body'>
        <?= $this->render('_form', [
            'model' => $model,
            'tarjeta'=>$tarjeta,
            'action'=>['adjuntos/create'],
        ]) ?>
    </div>
</div>
