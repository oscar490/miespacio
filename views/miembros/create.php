<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Miembros */

$this->title = 'Create Miembros';
$this->params['breadcrumbs'][] = ['label' => 'Miembros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="miembros-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
