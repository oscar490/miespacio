<?php
/* Renderización del formulario de modificación de tarjeta */

/* @var $this yii\web\View */
/* @var $model app\models\Tarjetas */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="container">

    <div class='row'>
        <div class='col-md-6'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <?= Html::encode('Tarjeta') ?>
                </div>
                <div class='panel-body'>
                    <?= $this->render('_form', [
                        'model' => $model,
                        'tablero'=>$model->tablero,
                        'label'=>'Modificar',
                        'action'=>['tarjetas/update', 'id'=>$model->id]
                    ]) ?>
                </div>
            </div>
        </div>

        <div class='col-md-3'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <?= Html::encode('Mover') ?>
                </div>
                <div class='panel-body'>
                    <?php $form = ActiveForm::begin() ?>

                        <?= $form->field($model, 'tablero_id')->dropdownList([
                            'Tableros'=>$tableros
                        ]) ?>

                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>

</div>
