<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Adjuntos */

$this->title = 'Create Adjuntos';
$this->params['breadcrumbs'][] = ['label' => 'Adjuntos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="adjuntos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
