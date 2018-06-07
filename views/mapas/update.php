<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mapas */

$this->title = $model->tarjeta->denominacion . ' | Ubicación';
$this->params['breadcrumbs'][] = ['label' => 'Tableros | MiEspacio', 'url' => ['equipos/gestionar-tableros']];
$this->params['breadcrumbs'][] = [
    'label' => $model->tarjeta->lista->tablero->denominacion,
    'url' => [
        'tableros/view', 'id' => $model->tarjeta->lista->tablero->id
        ]
    ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mapas-update">



    <?= $this->render('view', [
        'tarjeta'=>$model->tarjeta,
        'model'=>$model,
    ]) ?>

</div>
