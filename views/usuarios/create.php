<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = 'Crear una cuenta de Miespacio';
?>
<div class="usuarios-create">

    <div class='col-md-4 col-md-offset-4'>
        <h2><?= Html::encode($this->title)?></h2>
        <h3><?= Html::a('o iniciar sesión', ['site/login'])?></h3>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
