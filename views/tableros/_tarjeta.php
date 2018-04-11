<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;

$css = <<<EOT
    .tarjeta {
        box-shadow: 2px 2px 10px;
    }

    .forma {
        height: 60px;
    }
EOT;


$this->registerCss($css);
?>

<div class='col-md-4'>
    <div class='panel panel-default tarjeta'>
        <div class='panel-heading forma'>
            <p class='text-left'>
                <?= Html::encode($model->denominacion) ?>
            </p>
        </div>
        <div class='panel-footer'>
            <?= Html::button(
                    Html::tag(
                        'span',
                        '',
                        ['class'=>'glyphicon glyphicon-remove']
                    ). '',
                    [
                        'class'=>'btn btn-xs btn-danger',
                        'id'=>'btn_remove'
                    ]
                )
            ?>
        </div>
    </div>


</div>
