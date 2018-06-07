<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mapas */
$equipo = $tarjeta->lista->tablero->equipo;
$tablero = $tarjeta->lista->tablero;
$tarjeta = $tarjeta;

$this->title = $tarjeta->denominacion . ' | Ubicación';
$this->params['breadcrumbs'][] = ['label' => 'Tableros | MiEspacio', 'url' => ['equipos/gestionar-tableros']];
$this->params['breadcrumbs'][] = [
    'label'=>$equipo->denominacion,
    'url'=>['equipos/view', 'id'=>$equipo->id],
];
$this->params['breadcrumbs'][] = [
    'label' => $tablero->denominacion,
    'url' => [
        'tableros/view', 'id' => $tablero->id
        ]
    ];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mapas-update">



    <?= $this->render('view', [
        'tarjeta'=>$tarjeta,
        'model'=>$model,
    ]) ?>

</div>
