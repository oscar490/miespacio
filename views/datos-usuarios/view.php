<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\DatosUsuarios */

$this->title = 'Perfil | MiEspacio';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="datos-usuarios-view">

    <div class='row'>
        <div class='col-md-4 col-md-offset-3'>
            <h2>
                <?= Html::encode($model->nombre_completo) ?>
                <small>
                    <?= Html::encode('(' . $model->usuario->nombre . ')') ?>
                </small>
            </h2>
        </div>

    </div>

    <?php $form = ActiveForm::begin() ?>

        <div class='row'>
            <div class='col-md-4 col-md-offset-3'>
                <?= $form->field($model, 'nombre_completo') ?>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-4 col-md-offset-3'>
                <?= $form->field($model->usuario,'nombre')?>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-4 col-md-offset-3'>
                <?= $form->field($model, 'iniciales') ?>
            </div>
        </div>

        <div class='row'>
            <div class='col-md-7 col-md-offset-3'>
                <?= $form->field($model, 'descripcion')->textarea([
                    'rows'=>3,
                ]) ?>
            </div>
        </div>


    <?php ActiveForm::end() ?>


</div>
