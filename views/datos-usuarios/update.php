<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\DatosUsuarios */

$this->title = 'Update Datos Usuarios: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Datos Usuarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="datos-usuarios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
