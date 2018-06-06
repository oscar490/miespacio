<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Mapas */

$this->title = 'Update Mapas: ' . $model->tarjeta_id;
$this->params['breadcrumbs'][] = ['label' => 'Mapas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tarjeta_id, 'url' => ['view', 'id' => $model->tarjeta_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mapas-update">



    <?= $this->render('view', [
        'tarjeta'=>$model->tarjeta,
        'model'=>$model,
    ]) ?>

</div>
