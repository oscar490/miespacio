<?php
/* Vista parcial de una lista */

/* $model app\models\Listas */

use yii\helpers\Html;
use app\components\MyHelpers;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

$this->registerCssFile(
    '/css/lista.css'
);

?>

<div class='panel panel-default'>
    <div class='panel-heading'>
        <?=
            MyHelpers::icon('glyphicon glyphicon-th-list') .
            ' ' . Html::encode($model->denominacion)
        ?>
    </div>
    <div class='panel-body lista'>
        <div class='row'>
            <?= ListView::widget([
                'dataProvider'=>new ActiveDataProvider([
                    'query' => $model->getTarjetas(),
                ]),
                'itemView'=>'_tarjeta',
                'summary'=>''
            ]); ?>
        </div>
    </div>
</div>
