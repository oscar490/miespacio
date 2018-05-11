<?php
/** Vista del título del tablero **/

/* @var $model app\models\Tableros */

use yii\helpers\Html;
use app\components\MyHelpers;

$this->registerJsFile(
    '/js/titulo_tablero.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

?>

<div id='tablero_name' class='col-md-12'>
    <h3>
        <!-- Nombre del tablero -->
        <strong>
            <?=
                MyHelpers::label(
                    'primary',
                    $model->denominacion
                )
            ?>
        </strong>

        <!-- Nombre del equipo -->
        <?=
            Html::a(
                MyHelpers::label(
                    'primary',
                    $model->equipo->denominacion
                ),
                ['equipos/view', 'id'=>$model->equipo->id],
                ['id'=>'link_equipo']
            )
        ?>

        <?=
            Html::button(
                MyHelpers::icon('glyphicon glyphicon-star'),
                [
                    'class'=>'btn btn-md btn-default',
                    'id'=>'btn_favorite'
                ]
            )
        ?>
    </h3>
</div>
