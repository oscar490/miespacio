<?php
/* Vista parcial de un comentario */

/* @var $model app\models\Comentarios */
use yii\helpers\Html;

$datos_usuario = $model->usuario->datosUsuarios;


$css = <<<EOT
    #content_comentario {
        margin-top: 10px;
    }

    #img_usuario {
        width: 47px;
        height: 42px;
    }
EOT;

$this->registerCss($css);
?>

<div id='content_comentario'>
    <div class='row'>
        <!-- Imagen de usuario -->
        <div class='col-md-1'>
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
        <div class='col-md-9'>
            <strong>
                <?= Html::encode($datos_usuario->nombre_completo) ?>&nbsp;

                <?= Html::encode($datos_usuario->apellidos) ?>&nbsp;

                <?= \Yii::$app->formatter->asRelativeTime($model->created_at) ?>
            </strong>

            <!-- Contenido del comentario -->
            <div class='row'>
                <div class='col-md-12'>
                    <p>
                        <?= Html::encode($model->contenido) ?>
                    </p>
                </div>
            </div>
        </div>



    </div>
</div>

<hr>
