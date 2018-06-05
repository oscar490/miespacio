<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mapas */

$this->title = 'Create Mapas';
$this->params['breadcrumbs'][] = ['label' => 'Mapas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mapas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
