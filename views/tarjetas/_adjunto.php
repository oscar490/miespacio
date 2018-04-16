<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\popover\PopoverX;

$url_adjunto = Url::to(['adjuntos/delete', 'id'=>$model->id]);
$js = <<<EOT

    $('#btn_delete_adjunto_$model->id').on('click', function() {
        krajeeDialog.confirm("¿Deseas de verdad eliminarlo?", function (result) {
            if (result) {
                $.ajax({
                    url: '$url_adjunto',
                    type: 'POST',
                    success: function(data) {
                        console.log(data);
                        let div_adjunto = $("div[data-key='$model->id']");

                        div_adjunto.children('div.row').remove();
                        div_adjunto.find('hr').remove();
                    }
                })
            }
        });
    })

    $('#btn_update_adjunto_$model->id').on('click', function() {
        $("div[data-key='$model->id'] #update_adjunto").fadeToggle();
    })

EOT;

$css = <<<EOT
    #update_adjunto {
        display: none;
    }
EOT;

$this->registerCss($css);
$this->registerJs($js);
?>

<div class='row'>
    <div class='col-md-1'>
        <?=
            Html::img(
                'images/adjunto.png',
                ['alt'=>'adjunto']
            )
        ?>
    </div>
    <div class='col-md-3'>
        <?php if ($model->nombre !== null): ?>
            <?= Html::encode($model->nombre) ?>
        <?php else: ?>
            <?= Html::encode($model->url_direccion) ?>
        <?php endif; ?>

    </div>
    <!-- Botón de ver -->
    <div class='col-md-4'>
        <?=
            Html::a(
                Html::tag(
                    'span',
                    '',
                    ['class'=>'glyphicon glyphicon-eye-open']
                ),
                $model->url_direccion,
                [
                    'class'=>'btn btn-default',
                    'target'=>'_blank'
                ]
            )
        ?>

        <!-- Botón de borrar -->
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

        <!-- Botón de modificar -->
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
    </div>
</div>
<br>
<div class='row'>
    <div id="update_adjunto" class='col-md-8 col-md-offset-3'>
        <?=
            $this->render('/adjuntos/update', [
                'model'=>$model,
                'tarjeta'=>$model->tarjeta,
                'action'=>['adjuntos/update', 'id'=>$model->id]
            ]);
        ?>
    </div>
</div>
<hr>
