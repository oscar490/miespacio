<?php
use yii\helpers\Html;


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
        <?= Html::encode($model->nombre) ?>

    </div>
    <div class='col-md-1'>
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
    </div>
</div>
<hr>
