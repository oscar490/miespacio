<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = 'Crear una cuenta de MiEspacio';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="usuarios-create">

    <div class='col-md-4 col-md-offset-3'>
        <h1>
            <strong>
                <?= Html::encode($this->title)?>
            </strong>
        </h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
