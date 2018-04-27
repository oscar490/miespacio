<?php
/* Vista de tarjeta */

/* @var $tarjeta app\models\Tarjetas */

use yii\helpers\Html;
use app\components\MyHelpers;

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
        <div class='row'>
            <div class='col-xs-7 col-md-8'>
                <?= Html::encode($tarjeta->denominacion) ?>
            </div>
            <div class='col-xs-5 col-md-4'>
                <!-- Botón de crear tarjeta -->
                

                <!-- Botón de eliminar tarjeta -->
                <?=
                    Html::button(
                        MyHelpers::icon('glyphicon glyphicon-remove'),
                        ['class'=>'btn btn-xs btn-default']
                    );
                ?>


            </div>
        </div>

    </div>
</li>
