<?php
use yii\helpers\Html;

$css = <<<EOT
    #item {
        list-style: none;
    }
EOT;

$this->registerCss($css);

?>
<li id='item'>

                <?= Html::encode($tarjeta->denominacion) ?>

</li>
