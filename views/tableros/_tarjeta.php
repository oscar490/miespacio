<?php
/* Vista de una tarjeta */

/* $model app\models\Tarjetas */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;
use yii\bootstrap\Modal;

//  CSS.
$css = <<<EOT
    .tarjeta {
        box-shadow: 2px 2px 10px;
    }

    .forma {
        height: 60px;
    }
EOT;

$url_tarjeta = Url::to(['tarjetas/delete', 'id'=>$model->id]);

//  JavaScript.

//  Eliminar una tarjeta.
$js = <<<EOT
    eliminarElemento($("#btn_delete_tarjeta_$model->id"), '$url_tarjeta');
EOT;

$this->registerCss($css);
$this->registerJs($js);
?>

<div class='col-md-4'>
    <!-- Nombre de la tarjeta -->
    <div class='panel panel-default tarjeta'>
        <div class='panel-heading forma'>
            <p class='text-left'>
                <?= Html::encode($model->denominacion) ?>
            </p>
        </div>
        <div class='panel-footer'>
            <!-- Modal que muestra el contenido de la tarjeta -->
            <?php Modal::begin([
                'header'=>Html::tag(
                        'h4',
                        Html::tag(
                            'span',
                            '',
                            ['class'=>'glyphicon glyphicon-credit-card']
                        ) . ' ' . 'Contenido de tarjeta'
                    ),
                'toggleButton'=>[
                    'label'=>Html::tag(
                        'span',
                        '',
                        ['class'=>'glyphicon glyphicon-eye-open']
                    ),
                    'class'=>'btn btn-default'
                ],
                'size'=>Modal::SIZE_LARGE,
            ]) ?>
                <!-- Vista de la tarjeta -->
                <?= $this->render('/tarjetas/view', [
                    'model'=>$model,
                ]) ?>
            <?php Modal::end() ?>

            <!-- Eliminar tarjeta -->
            <?= Html::button(
                Html::tag(
                    'span',
                    '',
                    ['class'=>'glyphicon glyphicon-remove']
                ),
                [
                    'class'=>'btn btn-default',
                    'id'=>"btn_delete_tarjeta_$model->id",
                ]
            ) ?>

            <!-- Modal para mostrar formulario de adjunar -->
            <?php Modal::begin([
                'header'=>"<span class='glyphicon glyphicon-circle-arrow-up'></span>",
                'toggleButton'=>[
                    'label'=>"<span class='glyphicon glyphicon-paperclip'></span>",
                    'class'=>'btn btn-default'
                ],
                'size'=>Modal::SIZE_LARGE,
            ]) ?>
                <?= $this->render('/adjuntos/form_adjuntar', [
                    'model'=>$adjunto,
                    'tarjeta'=>$model,
                ]) ?>
            <?php Modal::end(); ?>

        </div>
    </div>
</div>
