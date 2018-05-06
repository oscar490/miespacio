<?php
/* Vista de un miembro del equipo */

/* @var $model app\models\Miembros */
/* @var $equipo app\models\Equipos */

use yii\helpers\Html;
use app\components\MyHelpers;


if ($model->id == $equipo->propietario_id) {
    $class = 'default';
    $contenido = Html::encode('Propietario');

} else {
    $class = 'primary';
    $contenido = Html::encode('Miembro');
}

$datos = $model->usuario->datosUsuarios;
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
                <?= Html::encode($model->usuario->nombre) ?>
            </div>
        </div>
    </div>

    <!-- Tipo de usuario: Propietario o miembro -->
    <div class='col-xs-4 col-md-5'>
        <h4>
            <?= MyHelpers::label($class, $contenido) ?>
        </h4>
    </div>


</div>
<hr>
