<?php
/* Vista parcial de una valoración */
/* @var $model app\models\Valoraciones */

use yii\helpers\Html;
use app\components\MyHelpers;

$usuario = $model->usuario->datosUsuarios;

$nombre_apellido = $usuario->nombre_completo . ' ' . $usuario->apellidos;

$css = <<<EOT
    #content_valoracion {
        margin-top: 10px;
        margin-left: 50px;
    }

    @media (max-width: 990px) {
        #content_valoracion {
            margin-top: 10px;
            margin-left: 0px;
        }

        #cuerpo_valoracion {
            margin-left: 10px;
        }

        #tiempo {
            margin-left: 10px;
            margin-top: 5px;
        }

        #valoracion_name {
            margin-left: 62px;
            margin-top: 45px;
        }

    }

    #img_votante {
        width: 47px;
        height: 42px;
    }
EOT;

$this->registerCss($css);

?>
<div id='content_valoracion'>
    <div class='row'>
        <!--- Usuario valora -->
        <div class='col-xs-2 col-md-1'>
            <?=
                Html::img(
                    $usuario->url_imagen,
                    [
                        'class'=>'img_circle logo-x2',
                        'id'=>'img_votante'
                    ]
                );
            ?>
        </div>

        <!-- Usuario nombre -->
        <div id='cuerpo_valoracion'class='col-xs-9 col-md-4'>
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

        <!-- Valoración -->
        <div class='col-md-4'>
            <h4>
                <div id='valoracion_name'>
                    <?=
                        MyHelpers::label(
                            'primary',
                            MyHelpers::icon($model->tipo->icono) . ' ' .
                            Html::encode($model->tipo->denominacion)
                        )
                    ?>
                </div>
            </h4>
        </div>


    </div>
</div>
<br>
