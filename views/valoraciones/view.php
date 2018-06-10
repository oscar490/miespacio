<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Valoraciones */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Valoraciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="valoraciones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tipo_id',
            'usuario_id',
            'tarjeta_id',
        ],
    ]) ?>

</div>
