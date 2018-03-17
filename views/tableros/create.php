<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tableros */

$this->title = 'Create Tableros';
$this->params['breadcrumbs'][] = ['label' => 'Tableros', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tableros-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
