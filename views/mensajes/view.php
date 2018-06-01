<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Mensajes */

$datos_emisor = $model->emisor0->datosUsuarios;
$datos_receptor = $model->receptor0->datosUsuarios;

//  Comprobación si el mensaje es recibido o enviado.
if  ($model->esRecibido) {
    $usuario = $datos_emisor;

} else {
    $usuario = $datos_receptor;
}

$css = <<<EOT
    .logo-mensaje {
        width: 47px;
        height: 42px;
    }

    #name_user {
        color: grey;
    }
EOT;

$this->registerCss($css);

$js = <<<EOT
    cambiarImagen('$usuario->url_imagen', $('#imagen_mensaje_$model->id'));
EOT;
// $this->registerJs($js);
?>


<div class='row'>

    <!-- Emisor o Receptor -->
    <div class='col-xs-2 col-md-1'>
        <!-- Imágen -->
        <?=
            Html::img(
                $usuario->url_imagen,
                [
                    'class'=>'img-rounded logo-mensaje',
                    'id'=>"imagen_mensaje_$model->id"
                ]
            );
         ?>
    </div>
    <!-- Nombre de usuario -->
    <div class='col-xs-4 col-md-3'>
        <!-- Nombre completo -->
        <?= Html::encode(
            $usuario->nombre_completo . ' ' .
            $usuario->apellidos
            )
        ?>

        <!-- Nombre de usuario -->
        <div class='row'>
            <div id='name_user' class='col-md-9'>
                <?=
                    Html::encode($usuario->usuario->nombre)
                ?>
            </div>
        </div>
    </div>

    <!-- Asunto -->
    <div class='col-xs-4 col-md-3'>
        <?= Html::encode($model->asunto) ?>

    </div>

    <!-- Boton de mostrar contenido -->
    <div class='col-xs-2 col-md-2'>
        <?= $this->render('botones_mensaje', [
            'mensaje'=>$model,
        ]) ?>
    </div>

    <div class='col-xs-5 col-md-3'>
        <?=
            Yii::$app->formatter->asDateTime($model->created_at);
        ?>
    </div>

</div>
<hr>
