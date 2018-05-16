<?php
/* Vista del botón para añadir un miembro al equipo */

/* @var $model app\models\Usuarios */
/* @var $equipo app\models\Equipos */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;
use app\models\Miembros;
use app\models\TiposMiembros;


$miembro = Miembros::find()
    ->where([
        'usuario_id'=>$model->id,
        'equipo_id'=>$equipo->id,
    ])
    ->one();


//  Tipos de miembros.
$tipos_miembros = TiposMiembros::find()
    ->select(['tipo'])
    ->indexBy('id')
    ->column();

$url_add_miembro = Url::to(['miembros/create']);

$js = <<<EOT
    $(document).ready(function() {
        let imagen = $('<img>');

        $("#boton_add_user_$model->id").on('click', function() {

            datos = {
                usuario_id: '$model->id',
                equipo_id: '$equipo->id',
                tipo_id: 2,
            };

            imagen.attr('src','images/cargando.gif');
            $('#boton_add').find('button').remove();

            $('#boton_add').append(imagen);
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

<!-- Lista select de tipo de miembro -->
<?php if ($esMiembro): ?>
    <?= $this->render('form_select_miembros', [
        'tipos_miembros'=>$tipos_miembros,
        'miembro'=>$miembro
    ]) ?>

<?php else: ?>
    <div id='boton_add'>
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
    </div>

<?php endif; ?>
