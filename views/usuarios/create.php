<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = 'Crear una cuenta de Miespacio';
?>
<div class="usuarios-create">

    <div class='col-md-5 col-md-offset-3'>
        <h1>
            <strong>
                <?= Html::encode($this->title)?>
                <small>
                    <?= Html::a('o iniciar sesion', ['site/login']) ?>
                </small>
            </strong>
        </h1>
    </div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
