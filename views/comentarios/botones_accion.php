<?php
/* Botones de eliminación y modificación de comentario */

/* @var $comentario app\models\Comentario */
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;

$this->registerJsFile(
    '/js/comentario.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$url_delete = Url::to(['comentarios/delete', 'id'=>$comentario->id]);
$tarjeta = $comentario->tarjeta;

//  ELiminiación de comentario.
$js = <<<EOT
    deleteComentario(
        '$url_delete',
        '$comentario->id',
        '$tarjeta->id',
        $("#btn_delete_comentario_$comentario->id")
    );

EOT;

$this->registerJs($js);

?>

<!-- Botón de eliminación de un comentario -->
<div class='col-md-3'>
    <?=
        Html::button(
            MyHelpers::icon('glyphicon glyphicon-remove-circle')
                . ' Eliminar',
            [
                'class'=>'btn btn-sm btn-default',
                'id'=>"btn_delete_comentario_$comentario->id"
            ]
        )
    ?>
</div>


<div class='col-md-3'>
    <?=
        Html::button(
            MyHelpers::icon('glyphicon glyphicon-edit')
                . ' Modificar',
            [
                'class'=>'btn btn-sm btn-default',
                'id'=>"btn_update_comentario_$comentario->id"
            ]
        )
    ?>
</div>
