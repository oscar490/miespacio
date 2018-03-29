<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use kartik\tabs\TabsX;
use app\models\Tableros;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $this yii\web\View */
/* @var $equipo app\models\Equipos */
/* @var $equipos app\models\Equipos */
/* @var $tablero app\models\Tableros */
/* @var $tablerosLista app\models\Tableros */

$url = Url::to(['tableros/devolver-tableros']);

//  Código JavaScript.
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

$this->registerJs($js);

$items = [
    //  Formulario para crear un nuevo equipo.
    [
        'label'=>'<span class="glyphicon glyphicon-list-alt icono-x2"></span>'
            . ' Equipo',
        'content'=>$this->render('form-crear-equipo.php', [
            'equipo'=>$equipo,
        ]),
        'active'=>true,
        'encode'=>false,
    ],
    //  Formulario para crer un nuevo tablero.
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
<div class="equipos-form">
    <div class='row'>
        <!-- Panel para crear tablero o equipo -->
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

        <!-- Panel donde se muestra los tableros de un equipo -->
        <div class='col-md-6'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    <?= Html::encode('Lista de tableros de un equipo') ?>
                </div>
                <div class='panel-body'>
                    <div class='contenedor'>
                        <?=
                            $this->render('/tableros/tableros_lista', [
                                'tableros'=>$tablerosLista,
                            ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
