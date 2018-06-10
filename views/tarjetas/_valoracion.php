<?php
/* Vista parcial de una valoración */
/* @var $model app\models\Valoraciones */

use yii\helpers\Html;
use app\components\MyHelpers;

$usuario = $model->usuario->datosUsuarios;

$nombre_apellido = $usuario->nombre_completo . ' ' . $usuario->apellidos;

?>
<div id='content_comentario'>
    <div class='row'>
        <!--- Usuario valora -->
        <div class='col-md-1'>
            <?=
                Html::img(
                    $usuario->url_imagen,
                    [
                        'class'=>'img_circle logo-x2',
                        'id'=>'img_usuario'
                    ]
                );
            ?>
        </div>

        <!-- Usuario nombre -->
        <div id='cuerpo_comentario'class='col-md-4'>
            <strong>
                <?= Html::encode($nombre_apellido) ?>
            </strong>

            <!-- Momento de valoración -->
            <div class='row'>
                <div class='col-md-6'>
                    <?=
                        \Yii::$app->formatter->asRelativeTime($model->created_at);
                    ?>
                </div>
            </div>
        </div>

        <div class='col-md-4'>
            <h4>
                <?=
                    MyHelpers::label(
                        'primary',
                        MyHelpers::icon($model->tipo->icono) . ' ' .
                        Html::encode($model->tipo->denominacion)
                    )
                ?>
            </h4>
        </div>


    </div>
</div>
<br>
