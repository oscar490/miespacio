<?php
/* Creación de un nuevo comentario */
use yii\helpers\Html;


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

?>

<div class='row'>
    <div class='col-md-8 col-md-offset-1'>
        <?= $this->render('_form', [
            'model' => $model,
            'tarjeta'=>$tarjeta,
        ]) ?>
    </div>
</div>
