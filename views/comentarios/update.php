<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Comentarios */

$css = <<<EOT
    form[id^='form_update_comentario'] > div.field-contenido 
    {
        margin-top: 10px;
        margin-left: 60px;
    }
EOT;

$this->registerCss($css);
?>

<?= $this->render('_form', [
    'model' => $model,
    'tarjeta'=>$tarjeta,
    'id_form'=>"form_update_comentario_$tarjeta->id",
    'action'=>['comentarios/validate-comentario', 'id'=>$model->id],
]) ?>
