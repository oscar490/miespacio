<?php
use yii\helpers\Html;

$css = <<<EOT
    #item {
        list-style: none;

    }

    .tarjeta {
        background-color: #f5f5f5;
        padding: 10px 15px;
        border-color: #ddd;
        box-shadow: 2px 2px 5px #999;
    }
EOT;

$this->registerCss($css);

?>
<li id='item' data-key="<?= $tarjeta->id ?>">
    <div class='panel panel-default tarjeta'>
        <?= Html::encode($tarjeta->denominacion) ?>
    </div>
</li>
