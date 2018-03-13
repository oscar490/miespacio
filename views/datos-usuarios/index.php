<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DatosUsuariosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Datos Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="datos-usuarios-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Datos Usuarios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre_completo',
            'descripcion',
            'registro',
            'ultimo_acceso',
            //'iniciales',
            //'usuario_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
