<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\components\MyHelpers;
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
    a:link {
        text-decoration: none;
    }
EOT;

echo MyHelpers::confirmacion('Eliminar tablero');

$url_update = Url::to(['tableros/update', 'id'=>$model->id]);
$url_delete = Url::to(['tableros/delete', 'id'=>$model->id]);

$js = <<<EOT
    let contenedor = $('div.wrap');
    let titulo = $('#nombre_tablero');
    let boton = $('#btn_eliminar');

    eliminarElemento(boton, '$url_delete');
    contenedor.css('backgroundColor', '$model->color');
    cambiarColorTitulo('$model->color');

    $('#btn_color').on('click', function() {
        let color_seleccion = $('#color').val();

        titulo.css('color', 'black');
        cambiarColorTitulo(color_seleccion);
        contenedor.css('backgroundColor', color_seleccion);
        cambiar_color_ajax(color_seleccion);
    })

    function cambiarColorTitulo(color) {
        if (color !== "#ffffffff") {
            titulo.css('color', 'white');
        }
    }

    function cambiar_color_ajax(color) {
        $.ajax({
            url: '$url_update',
            type: 'POST',
            data: {
                color: color,
            }
        });
    }


EOT;

$this->registerJS($js);
$this->registerCss($css);

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class='row'>
        <!-- Nombre del tablero y enlace de su equipo -->
        <div id='nombre_tablero' class='col-md-6'>
            <h4>
                <strong>
                    <?= Html::encode($model->denominacion) ?>

                    <?=
                        Html::a(
                            $model->equipo->denominacion,
                            ['equipos/view', 'id' => $model->equipo->id],
                            ['class'=>'btn-sm btn-primary']
                        );
                    ?>
                </strong>
            </h4>
        </div>
        <div class='col-md-3 col-md-offset-3'>

            <!-- Formulario de propiedades del tablero -->
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    <strong>
                        <?= Html::encode('Propiedades') ?>
                    </strong>
                </div>
                <div class='panel-body'>

                    <!-- Modificar el tablero -->
                    <?= $this->render('update', [
                        'model'=>$model,
                        'equipos'=>$equipos,
                    ]) ?>

                    <!-- Eliminar el tablero -->
                    <?=
                        Html::button(
                            'Eliminar',
                            [
                                'class'=>'btn btn-danger btn-block',
                                'id'=>'btn_eliminar',
                            ]
                        );
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
