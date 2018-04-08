<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Tableros */

$this->title = $model->denominacion . ' | MiEspacio';
$this->params['breadcrumbs'][] = [
    'label' => 'Tableros | MiEspacio',
    'url' => ['equipos/gestionar-tableros']
];
$this->params['breadcrumbs'][] = [
    'label'=>$model->equipo->denominacion,
    'url'=>['equipos/view', 'id'=>$model->equipo->id],
];

$css = <<<EOT
    .rojo {
        background-color: red;
    }
EOT;

$this->registerCss($css);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class='row'>
        <div class='col-md-6'>
            <h4>
                <strong>
                    <?=
                        Html::encode($model->denominacion)
                    ?>
                </strong>
            </h4>
        </div>
        <div class='col-md-3 col-md-offset-9'>
            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <strong>
                        <?= Html::encode('Propiedades') ?>
                    </strong>
                </div>
                <div class='panel-body'>
                    <?php $form = ActiveForm::begin([
                        'action'=>['tableros/update', 'id'=>$model->id],
                    ]) ?>
                        <?= $form->field($model, 'denominacion') ?>
                        <?=
                            $form->field($model, 'equipo_id')->dropdownList([
                                'Equipos'=>$equipos
                            ]);
                        ?>

                        <?=
                            Html::submitButton('Modificar', [
                                'class'=>'btn btn-success btn-block'
                            ])
                        ?>
                    <?php ActiveForm::end() ?>
                </div>
            </div>

            <div class='panel panel-default'>
                <div class='panel-heading'>
                    <?= Html::encode('Color') ?>
                </div>
                <div class='panel-body'>
                    <div class='rojo'>
                        hola
                    </div>
                </div>
            </div>
        </div>
    </div>




</div>
