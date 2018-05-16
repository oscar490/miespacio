<?php
/* Vista del botón para añadir un miembro al equipo */

/* @var $model app\models\Usuarios */
/* @var $equipo app\models\Equipos */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;
use app\models\Miembros;
use app\models\TiposMiembros;
use yii\widgets\ActiveForm;


$miembro = Miembros::find()
    ->where(['usuario_id'=>$model->id])
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
                equipo_id: '$equipo->id'
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

    <?php $form = ActiveForm::begin() ?>
        <div class='row'>
            <div class='col-md-9'>
                <?= $form->field($miembro, 'tipo_id')->dropdownList([
                        'Tipo de miembro'=>$tipos_miembros
                ])->label(false) ?>
            </div>
        </div>
    <?php ActiveForm::end() ?>



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
