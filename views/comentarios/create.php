<?php
/* Creación de un nuevo comentario */
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Comentarios */
$css = <<<EOT
    textarea#contenido {
        border-radius: 10px;
    }

    .comentarios-form {
        margin-bottom: 20px;
    }
EOT;

$this->registerCss($css);

$url_create = Url::to(['comentarios/create']);

$js = <<<EOT
    validarForm(
        $("#form_create_comentario_$tarjeta->id"),
        '$url_create',
        'POST',
        function (data) {
            $("div#container_comentarios_$tarjeta->id").html(data);
        }
    );
EOT;

$this->registerJs($js);
?>

<div class='row'>
    <div class='col-md-8 col-md-offset-1'>
        <?= $this->render('_form', [
            'model' => $model,
            'tarjeta'=>$tarjeta,
            'id_form'=>"form_create_comentario_$tarjeta->id",
            'action'=>['comentarios/create'],
        ]) ?>
    </div>
</div>
