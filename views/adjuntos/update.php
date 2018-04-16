<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Adjuntos */

$url_adjuntos_update = Url::to(['adjuntos/update-ajax', 'id'=>$model->id]);
$js = <<<EOT
    $("#form_adjunto_update_$model->id").on('beforeSubmit', function(e) {
        e.preventDefault();
        var form = $(this);

        if (form.find('.has-error').length) {
               return false;
        }

        $.ajax({
            url: '$url_adjuntos_update',
            type: 'POST',
            data: form.serialize(),
            success: function(data) {
                $("div[data-key='$tarjeta->id'] div#lista_adjunto").html(data);
            },
            dataType: 'json'
        });

        return false;
    })
EOT;

$this->registerJs($js);

?>

<div class='panel panel-default'>
    <div class='panel-heading'>
        <?=
            Html::encode('Modificar');
        ?>
    </div>
    <div class='panel-body'>
        <?= $this->render('_form', [
            'model' => $model,
            'action'=>$action,
            'tarjeta'=>$tarjeta,
            'id_form' =>"form_adjunto_update_$model->id",
        ]) ?>
    </div>
</div>
