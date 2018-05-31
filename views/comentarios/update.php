<?php
/* Formulario de modificación de comentario */

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Comentarios */
$url_update = Url::to(['comentarios/update', 'id'=>$model->id]);

$css = <<<EOT
    form[id^='form_update_comentario'] > div.field-contenido
    {
        margin-top: 10px;
        margin-left: 60px;
    }
EOT;

$this->registerCss($css);

$js = <<<EOT

    validarForm(
        $("#form_update_comentario_$model->id"),
        '$url_update',
        'POST',
        function(data) {
            let content = $(`#container_comentarios_$tarjeta->id`);
            content.html(data);
        }
    );
EOT;
$this->registerJs($js);
?>

<?= $this->render('_form', [
    'model' => $model,
    'tarjeta'=>$tarjeta,
    'id_form'=>"form_update_comentario_$model->id",
    'action'=>['comentarios/update', 'id'=>$model->id],
    'label'=>'Modificar',
    'id_button'=>"btn_update_comentario_$model->id",
]) ?>
