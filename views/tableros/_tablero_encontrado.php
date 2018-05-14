<?php
/* Vista de un tablero encontrado */

/* @var $model app\models\Tableros */

use yii\helpers\Html;
use yii\helpers\Url;

$js = <<<EOT
    function changedColor(elem, color) {
        elem.css('background-color', color);
        elem.css('border-color', color);
        elem.parent().css('border-color', color);
    }

    $("#tablero_encontrado_$model->id").hover(
        function() {
            changedColor($(this), '#75a4c1');
        }, function() {
            changedColor($(this), '#337ab7');
        }
    );
EOT;

$this->registerJs($js);

$url_tablero = Url::to(['tableros/view', 'id'=>$model->id]);
?>

<div class='row'>
    <div class='col-md-12'>

        <!-- Enlace al tablero -->
        <a href="<?= $url_tablero ?>" >
            <div class='panel panel-primary'>

                <!-- Nombre del tablero -->
                <div id="tablero_encontrado_<?= $model->id ?>"  class='panel-heading'>
                    <strong>
                        <?= Html::encode($model->denominacion) ?>
                    </strong>

                    <!-- Nombre del equipo -->
                    <div class='row'>
                        <div class='col-md-6'>
                            <?= Html::encode($model->equipo->denominacion) ?>
                        </div>
                    </div>

                </div>
            </div>
        </a>
        
    </div>
</div>

<hr>
