<?php
/* Vista parcial de un comentario */

/* @var $model app\models\Comentarios */
use yii\helpers\Html;

$datos_usuario = $model->usuario->datosUsuarios;


$this->registerCssFile(
    '/css/comentarios.css'
);

?>

<div id='content_comentario'>
    <div class='row'>
        <!-- Imagen de usuario -->
        <div class='col-xs-2 col-md-1'>
            <?=
                Html::img(
                    $datos_usuario->url_imagen,
                    [
                        'class'=>'img-circle logo-x2',
                        'id'=>'img_usuario',
                    ]
                )
            ?>
        </div>

        <!-- Nombre completo de usuario comentario -->
        <div id="cuerpo_comentario" class='col-xs-9 col-md-9'>
            <strong>
                <?= Html::encode($datos_usuario->nombre_completo) ?>&nbsp;

                <?= Html::encode($datos_usuario->apellidos) ?>&nbsp;

                <?= \Yii::$app->formatter->asRelativeTime($model->created_at) ?>
            </strong>

            <!-- Contenido del comentario -->
            <div class='row'>
                <div id='bocadillo' class='col-md-9'>
                    <?= Html::encode($model->contenido) ?>
                </div>
                <div id='triangulo'>
                </div>
            </div>
        </div>



    </div>
</div>

<hr>
