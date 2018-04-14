<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SubidasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Subidas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subidas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Subidas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'adjunto_id',
            'tarjeta_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
