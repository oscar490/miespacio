<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Subidas */

$this->title = 'Create Subidas';
$this->params['breadcrumbs'][] = ['label' => 'Subidas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="subidas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
