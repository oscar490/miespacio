<?php
/* Botones de accion, view, update y delete */

/* @var $model app\models\Adjuntos */
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Miembros;

$url_delete = Url::to(['adjuntos/delete', 'id'=>$model->id]);
$tarjeta = $model->tarjeta;

$miembro = Miembros::find()
    ->where([
        'equipo_id'=>$model->tarjeta->lista
            ->tablero->equipo->id,
        'usuario_id'=>Yii::$app->user->id
    ])->one();

$js = <<<EOT
    $("#btn_update_adjunto_$model->id").on('click', function() {
        $("#div_update_adjunto_$model->id").slideToggle();
    })

    $('#btn_delete_adjunto_$model->id').on('click', function() {
        krajeeDialog.confirm("¿Deseas de verdad eliminarlo?", function (result) {
            if (result) {
                sendAjax('$url_delete', 'POST', {}, function(data) {
                    $("#lista_adjuntos_$tarjeta->id").html(data);
                })

                if ('$model->esImagen') {
                    $("#view_imagen_$tarjeta->id").empty();
                }
            }
        });

    })
EOT;
$this->registerJs($js);

?>

<!-- Botón de view -->
<div class='col-xs-7 col-md-4'>

    <?= $this->render('elemento_view_adjunto', [
        'adjunto'=>$model,
    ]) ?>

    <?php if ($miembro->esPropietario): ?>
        <!-- Botón de delete -->
        <?=
            Html::button(
                Html::tag(
                    'span',
                    '',
                    ['class'=>'glyphicon glyphicon-remove']
                ),
                [
                    'class'=>'btn btn-default',
                    'id'=>"btn_delete_adjunto_$model->id"
                ]
            );
        ?>

        <!-- Botón de update -->
        <?=
            Html::button(
                Html::tag(
                    'span',
                    '',
                    ['class'=>'glyphicon glyphicon-pencil']
                ),
                [
                    'class'=>'btn btn-default',
                    'id'=>"btn_update_adjunto_$model->id"
                ]
            );
        ?>

    <?php endif; ?>
</div>
