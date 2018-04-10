<?php
use yii\helpers\Html;

$css = <<<EOT
    .tarjeta {
        width: 240px;
        height: 18px;
    }
EOT;

$this->registerCss($css);
?>

<div class='col-md-3'>
    <div class='panel panel-default'>
        <div class='panel-heading'>
            <?= Html::encode($model->denominacion) ?>
        </div>
        <div class='panel-body'>
        </div>
    </div>
</div>
