<?php
/* Vista del botón para añadir un miembro al equipo */

/* @var $model app\models\Usuarios */
/* @var $equipo app\models\Equipos */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;

if ($model->id == $equipo->propietario_id) {
    $class = 'default';
    $contenido = Html::encode('Propietario');

} else {
    $class = 'primary';
    $contenido = Html::encode('Miembro');
}

$url_add_miembro = Url::to(['miembros/create']);

$js = <<<EOT
    $(document).ready(function() {
        $("#boton_add_user_$model->id").on('click', function() {

            datos = {
                usuario_id: '$model->id',
                equipo_id: '$equipo->id'
            };

            sendAjax('$url_add_miembro', 'POST', datos, function (data) {
                $('.in').html(data);
            })
        })
    })
EOT;
$this->registerJs($js);

$esMiembro = !empty($model->getMiembros()
    ->where(['equipo_id'=>$equipo->id])->all());
?>

<?php if ($esMiembro): ?>
    <h4>
        <?= MyHelpers::label($class, $contenido) ?>
    </h4>

<?php else: ?>
    <?=
        Html::button(
            MyHelpers::icon('glyphicon glyphicon-plus') .
            ' ' . 'Añadir',
            [
                'class'=>'btn btn-md btn-success',
                'id'=>"boton_add_user_$model->id"
            ]
        )
    ?>

<?php endif; ?>
