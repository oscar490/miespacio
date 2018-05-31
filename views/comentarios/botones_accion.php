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
$tarjeta = $comentario->tarjeta;

$url_delete = Url::to(['comentarios/delete', 'id'=>$comentario->id]);
$url_render_comentarios = Url::to(['tarjetas/load-comentarios', 'id'=>$tarjeta->id]);



//  ELiminiación de comentario.
$js = <<<EOT
    deleteComentario(
        '$url_delete',
        '$comentario->id',
        '$tarjeta->id',
        $("#btn_delete_comentario_$comentario->id"),
        '$url_render_comentarios'
    );

    $("#btn_update_view_$comentario->id").on('click', function() {
        $(this).parent().parent().next().slideToggle();
    })

EOT;

$this->registerJs($js);

?>

<!-- Botón de eliminación de un comentario -->
<div class='col-xs-3 col-md-3'>
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

<!-- Botón para mostrar formulario update -->
<div class='col-xs-3 col-md-3'>
    <?=
        Html::button(
            MyHelpers::icon('glyphicon glyphicon-edit')
                . ' Modificar',
            [
                'class'=>'btn btn-sm btn-default',
                'id'=>"btn_update_view_$comentario->id"
            ]
        )
    ?>
</div>
