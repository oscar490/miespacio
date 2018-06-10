<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Valoraciones */

$this->title = 'Create Valoraciones';
$this->params['breadcrumbs'][] = ['label' => 'Valoraciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="valoraciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
