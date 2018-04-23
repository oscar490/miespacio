<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ListasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Listas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="listas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Listas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'denominacion',
            'tablero_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
