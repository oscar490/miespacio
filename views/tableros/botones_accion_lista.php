<?php
/* Botones de acción sobre la lista: Update y Delete. */

/* @var $lista app\models\Listas */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;
use app\models\Miembros;

$url_remove_lista = Url::to(['listas/delete', 'id'=>$lista->id]);

$equipo_lista = $lista->tablero->equipo;

$miembro = Miembros::find()
    ->where([
        'equipo_id'=>$equipo_lista->id,
        'usuario_id'=>Yii::$app->user->id,
    ])->one();

$js = <<<EOT

    $(document).ready(function() {
        $("#btn_update_lista_$lista->id").on('click', function() {
            $("#lista_update_$lista->id").slideToggle();
        })

        eliminarElemento($("#btn_remove_lista_$lista->id"), '$url_remove_lista',
            function (data) {
                $('#contenedor_general').html(data);
            })
    })
EOT;

$this->registerJs($js);
?>

<!-- Botón para mostrar formulario de crear tarjeta -->
<?=
    Html::button(
        MyHelpers::icon("glyphicon glyphicon-plus"),
        [
            'class'=>'btn btn-xs btn-success',
            'id'=>"btn_add_tarjeta_$lista->id"
        ]
    )
?>

<?php if ($miembro->esPropietario): ?>
    <!-- Botón para mostrar formulario de modificación de nombre lista -->
    <?=
        Html::button(
            MyHelpers::icon("glyphicon glyphicon-pencil"),
            [
                'class'=>'btn btn-xs btn-default',
                'id'=>"btn_update_lista_$lista->id"
            ]
        )
    ?>

    <!-- Botón para eliminar lista -->
    <?=
        Html::button(
            MyHelpers::icon("glyphicon glyphicon-remove"),
            [
                'class'=>'btn btn-xs btn-default',
                'id'=>"btn_remove_lista_$lista->id"
            ]
        )
    ?>

<?php endif; ?>
