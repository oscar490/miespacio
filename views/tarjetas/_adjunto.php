<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\popover\PopoverX;
use app\components\MyHelpers;

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
        let aqui = $(this).closest('div.row').next()
            .find('div#update_adjunto').fadeToggle();
    });

EOT;

$css = <<<EOT
    #update_adjunto {
        display: none;
    }

    #content_img > img{
        width: 80px;
        height: 80px;
    }
EOT;

$this->registerCss($css);
$this->registerJs($js);

switch ($model->tipo) {
    case 'image':
        $src = $model->url_direccion;
        break;

    case null:
        $src = 'images/enlace.png';
        break;

    default:
        $src = 'images/adjunto.png';
        break;
}
?>

<div class='row'>
    <!-- Imágen del Adjunto -->
    <div id='content_img' class='col-md-2'>
        <?=
            Html::img(
                $src,
                [
                    'alt'=>'adjunto',
                    'class'=>'img-circle'
                ]
            )
        ?>
    </div>

    <!-- Nombre del adjunto -->
    <div class='col-md-6'>
        <?php
            if ($model->nombre !== null) {
                $nombre = $model->nombre;
            } else {
                $nombre = $model->url_direccion;
            }
        ?>
        <p>
            <strong>
                <?= Html::encode($nombre) ?>
            </strong>
            <small>
                <?=
                    Yii::$app->formatter->asRelativeTime($model->created_at);
                ?>
            </small>
        </p>
    </div>
    <!-- Botón de ver -->
    <div class='col-md-4'>
        <?php
            MyHelpers::modal_begin(
                'content',
                MyHelpers::icon('glyphicon glyphicon-eye-open'),
                'btn btn-default'
            );
        ?>
            <?= $this->render('vista_adjunto', [
                'adjunto'=>$model,
            ]) ?>
        <?php MyHelpers::modal_end() ?>

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
