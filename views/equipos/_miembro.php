<?php
/* Vista de un miembro del equipo */

/* @var $model app\models\Usuarios */
/* @var $equipo app\models\Equipos */

use yii\helpers\Html;
use app\components\MyHelpers;


$datos = $model->datosUsuarios;

?>
<div class='row'>
    <!-- Imagen de perfil -->
    <div id='img_user' class='col-xs-2 col-md-1'>
        <?=
            Html::img(
                $datos->url_imagen,
                ['class'=>'img-circle']
            );
        ?>
    </div>
    <!-- Nombre completo -->
    <div class='col-xs-5 col-md-4'>
        <strong>
            <?=
                Html::encode(
                    $datos->nombre_completo .
                    ' ' . $datos->apellidos
                );
            ?>
        </strong>

        <!-- Nombre de usuario -->
        <div class='row'>
            <div id='name_user' class='col-md-5'>
                <?= Html::encode($model->nombre) ?>
            </div>
        </div>
    </div>

    <!-- Tipo de usuario: Propietario o miembro -->
    <!-- Botón para añadir usuario si no es miembro del equipo -->
    <div class='col-xs-4 col-md-5'>
        <?= $this->render('boton_add_miembro', [
            'model'=>$model,
            'equipo'=>$equipo
        ]) ?>
    </div>


</div>
<hr>
