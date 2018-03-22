<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TablerosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tableros';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tableros-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Tableros', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'denominacion',
            'equipo_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
