<?php

/* @var $model app\models\Tableros */

use yii\helpers\Html;

$css = <<<EOT
    div.panel-tablero {
        background-color: #0266a0;
        color: white;
        border-radius: 5px;
    }
EOT;

$this->registerCss($css);
?>
<div class='col-md-3'>
    <div class='panel-tablero'>
        <div class='panel-heading'>
            <?=
                Html::tag(
                    'p',
                    Html::tag(
                        'strong',
                        $model->denominacion
                    )
                );
            ?>
        </div>
        <div class='panel-body'>

        </div>
    </div>
</div>
