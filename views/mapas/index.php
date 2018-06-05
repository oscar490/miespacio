<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MapasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mapas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mapas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mapas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'ubicacion',
            'latitud',
            'longitud',
            'tarjeta_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
