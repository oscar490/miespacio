<?php
/* Vista de un tablero encontrado */

/* @var $model app\models\Tableros */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;

$js = <<<EOT
    function changedColor(elem, color) {
        elem.css('background-color', color);
        elem.css('border-color', color);
        elem.parent().css('border-color', color);
    }

    $("#tablero_encontrado_$model->id").hover(
        function() {
            $(this).css({opacity: 0.8});
        }, function() {
            $(this).css({opacity: 1});
        }
    );
EOT;

$this->registerJs($js);


$icono = 'glyphicon glyphicon-globe';
$url_tablero = Url::to(['tableros/view', 'id'=>$model->id]);

if ($model->esPrivado) {
    $icono = 'glyphicon glyphicon-lock';

    $miembro = $model->equipo->getMiembros()
        ->where(['usuario_id'=>Yii::$app->user->id])
        ->one();

    if (!$miembro->esPropietario) {
        $url_tablero = '#';
    }

}
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
                            &nbsp;
                            <?=
                                MyHelpers::icon($icono) . ' ' .
                                Html::encode($model->visibilidad->visibilidad)
                            ?>
                        </div>
                        <div class='col-md-5'>

                        </div>
                    </div>

                </div>
            </div>
        </a>

    </div>
</div>

<hr>
