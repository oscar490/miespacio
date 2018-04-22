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

$this->registerJsFile(
    '/js/lista.js',
    [
        'depends'=>[\yii\web\JqueryAsset::className()],
        'lista_id'=>$model->id,
    ]
);
?>

<div class='panel panel-default'>
    <!-- Título de la lista-->
    <div id='titulo_lista' class="panel-heading">
        <?=
            MyHelpers::icon('glyphicon glyphicon-th-list') .
            ' ' . Html::encode($model->denominacion) . ' '
        ?>

        <small>
            (click aquí para crear una nueva tarjeta)
        </small>
    </div>

    <!-- Tarjetas de la lista -->
    <div class='panel-body lista'>
        <div class='row'>
            <?php if ($model->contieneTarjetas): ?>
                <?= ListView::widget([
                    'dataProvider'=>new ActiveDataProvider([
                        'query' => $model->getTarjetas(),
                    ]),
                    'itemView'=>'_tarjeta',
                    'summary'=>''
                ]); ?>
            <?php endif; ?>
        </div>
    </div>

    <div id='form_create' class='panel-footer'>
        <?= $this->render('/tarjetas/create', [
            'model'=>$tarjeta,
            'tablero'=>$tablero
        ]) ?>
    </div>
</div>
