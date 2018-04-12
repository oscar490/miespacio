<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;
use yii\bootstrap\Modal;

$css = <<<EOT
    .tarjeta {
        box-shadow: 2px 2px 10px;
    }

    .forma {
        height: 60px;
    }
EOT;

$url_tarjeta = Url::to(['tarjetas/delete', 'id'=>$model->id]);
$js = <<<EOT
    eliminarElemento($("#btn_delete_tarjeta_$model->id"), '$url_tarjeta');
EOT;

$this->registerCss($css);
$this->registerJs($js);
?>

<div class='col-md-4'>
    <div class='panel panel-default tarjeta'>
        <div class='panel-heading forma'>
            <p class='text-left'>
                <?= Html::encode($model->denominacion) ?>
            </p>
        </div>
        <div class='panel-footer'>
            <?php Modal::begin([
                'header'=>Html::tag(
                        'h4',
                        Html::tag(
                            'span',
                            '',
                            ['class'=>'glyphicon glyphicon-credit-card']
                        ) . ' ' .
                        Html::encode($model->denominacion)
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
                <?= $this->render('/tarjetas/view', [
                    'model'=>$model,
                ]) ?>
            <?php Modal::end() ?>

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
        </div>
    </div>
</div>
