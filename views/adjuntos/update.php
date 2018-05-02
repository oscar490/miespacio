<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Adjuntos */

$url_adjunto_update = Url::to(['adjuntos/update-ajax', 'id'=>$model->id]);
$id_tarjeta = $model->tarjeta->id;

$js = <<<EOT
    validarForm($("#form_adjunto_update_$model->id"),'$url_adjunto_update',
        'POST', function(data) {
            $("div#lista_adjuntos_$id_tarjeta").html(data);
        }
    );
EOT;

$this->registerJs($js);

?>

<div class='panel panel-default'>
    <div class='panel-body'>
        <?= $this->render('_form', [
            'model' => $model,
            'action'=>['adjuntos/update', 'id'=>$model->id],
            'tarjeta'=>$model->tarjeta,
            'id_form' =>"form_adjunto_update_$model->id",
            'label'=>'Modificar',
        ]) ?>
    </div>
</div>
