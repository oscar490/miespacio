<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use kartik\tabs\TabsX;
use app\models\Tableros;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model app\models\Equipos */
/* @var $form yii\widgets\ActiveForm */

$url = Url::to(['tableros/devolver-tableros']);
$js = <<<EOT
    $('select').on('change', function() {
        $.ajax({
            type: 'GET',
            url: '$url',
            data: {
                id_equipo: $(this).val(),
            },
            success: function(data) {
                $('div.contenedor').empty();
                $('div.contenedor').html(data);
            }
        })
    })
EOT;

$tablerosLista = new ActiveDataProvider([
    'query'=>Tableros::find()
        ->where(['equipo_id'=>1]),
]);

$this->registerJs($js);

$items = [
    [
        'label'=>'<span class="glyphicon glyphicon-list-alt icono-x2"></span>'
            . ' Equipo',
        'content'=>$this->render('form-crear-equipo.php', [
            'equipo'=>$equipo,
        ]),
        'active'=>true,
        'encode'=>false,
    ],
    [
        'label'=>'<span class="glyphicon glyphicon-align-justify icono-x2"></span>'
            . ' Tablero',
        'content'=>$this->render('form-crear-tablero', [
            'tablero'=>$tablero,
            'equipos'=>$equipos,
        ]),
        'encode' => false,
    ]
];
?>
<!-- Formularios -->
<div class="equipos-form">

    <div class='row'>
        <div class='col-md-6'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    <?= Html::encode('Crear') ?>
                </div>
                <div class='panel-body'>

                    <?= TabsX::widget([
                        'items'=>$items,
                         'position'=>TabsX::POS_LEFT,
                    ]) ?>
                </div>
            </div>
        </div>

        <div class='col-md-6'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    <?= Html::encode('Ver tableros de un equipo') ?>
                </div>
                <div class='panel-body'>
                    <?php $form = ActiveForm::begin() ?>

                        <?= $form->field($tablero, 'equipo_id')->dropdownList([
                            'Equipos'=>$equipos,
                        ]) ?>

                    <?php ActiveForm::end() ?>
                    <hr>
                    <div class='contenedor'>
                        <?= GridView::widget([
                            'dataProvider'=>$tablerosLista,
                            'columns'=>[
                                [
                                    'attribute'=>'denominacion',
                                    'header'=>'Tableros',
                                ],
                            ],
                            'summary'=>'',
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
