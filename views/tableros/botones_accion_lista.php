<?php
/* Botones de acción sobre la lista: Update y Delete. */

/* @var $lista app\models\Listas */

use yii\helpers\Html;
use app\components\MyHelpers;

$js = <<<EOT

    $(document).ready(function() {
        $("#btn_update_lista_$lista->id").on('click', function() {
            $("#lista_update_$lista->id").slideToggle();
        })
    })
EOT;

$this->registerJs($js);
?>

<?=
    Html::button(
        MyHelpers::icon("glyphicon glyphicon-plus"),
        [
            'class'=>'btn btn-xs btn-success',
            'id'=>"btn_add_tarjeta_$lista->id"
        ]
    )
?>

<?=
    Html::button(
        MyHelpers::icon("glyphicon glyphicon-pencil"),
        [
            'class'=>'btn btn-xs btn-default',
            'id'=>"btn_update_lista_$lista->id"
        ]
    )
?>
