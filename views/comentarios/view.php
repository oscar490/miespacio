<?php
/* Vista parcial de un comentario */

/* @var $model app\models\Comentarios */

use yii\helpers\Html;
use app\components\MyHelpers;
use yii\helpers\Url;

$datos_usuario = $model->usuario->datosUsuarios;
$tarjeta = $model->tarjeta;

$this->registerCssFile(
    '/css/comentarios.css'
);

$this->registerJsFile(
    '/js/comentario.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$url_delete = Url::to(['comentarios/delete', 'id'=>$model->id]);

//  ELiminiación de comentario.
$js = <<<EOT
    deleteComentario(
        '$url_delete',
        '$model->id',
        '$tarjeta->id',
        $("#btn_delete_comentario_$model->id")
    );

EOT;

$this->registerJs($js);

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
            </div>
        </div>

        <!-- Botón de eliminación de un comentario -->
        <?php if ($model->usuario->id === Yii::$app->user->id): ?>
            <div class='col-md-3'>
                <?=
                    Html::button(
                        MyHelpers::icon('glyphicon glyphicon-remove-circle')
                            . ' Eliminar',
                        [
                            'class'=>'btn btn-sm btn-default',
                            'id'=>"btn_delete_comentario_$model->id"
                        ]
                    )
                ?>
            </div>

        <?php endif; ?>
    </div>
</div>
<br>
