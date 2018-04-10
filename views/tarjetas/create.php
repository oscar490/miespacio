<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tarjetas */

$this->title = 'Create Tarjetas';
$this->params['breadcrumbs'][] = ['label' => 'Tarjetas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tarjetas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
