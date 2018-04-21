<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Listas */

$this->title = 'Create Listas';
$this->params['breadcrumbs'][] = ['label' => 'Listas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="listas-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
