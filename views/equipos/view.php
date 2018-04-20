<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\MyHelpers;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Equipos */
/* @var $tableros app\models\Tableros */
/* @var $tablero_crear app\models\Tableros */

$js = <<<EOT
    $(document).ready(function() {
        selector = $('#img_equipo img');
        imagen = '$model->url_imagen';

        cambiarImagen(imagen, selector);
    })
EOT;

$this->registerJs($js);

$this->title = $model->denominacion;
$this->params['breadcrumbs'][] = [
    'label' => 'Tableros | MiEspacio',
    'url' => ['equipos/gestionar-tableros']
];

//  Contenido de pestañas
$items = [
    [
        //  Lista de tableros del equipo.
        'label'=>"<span class='glyphicon glyphicon-align-justify'></span>
                Tableros",
        'content'=> $this->render('tableros_equipo', [
            'tableros'=>$tableros,
            'tablero_crear'=>$tablero_crear,
            'equipo'=>$model,
        ]),
        'linkOptions'=>[
            'id'=>'lista_tableros'
        ]
    ],
    [
        //  Modificación del equipo.
        'label'=>"<span class='glyphicon glyphicon-wrench'></span>
                Configuración",
        'content'=> $this->render('update', [
            'equipo'=>$model,
        ]),
        'linkOptions'=>[
            'id'=>'config_tableros'
        ]
    ],
    [
        //  Modificación de imágen.
        'label'=>"<span class='glyphicon glyphicon-picture'></span>
                Imágen",
        'content'=> $this->render('form_imagen', [
            'equipo'=>$model,
        ])
    ],
];
$css = <<<EOT
    .contenido {
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }

    #img_equipo > img {
        width: 120px;
        height: 120px;
    }

    #titulo {
        padding-left: 50px;
    }

    #titulo.col-md-11 {
        padding-left: 75px;
    }

    #titulo.col-sm-11 {
        padding-left: 100px;
    }

    #titulo.col-lg-11 {
        padding-left: 60px;
    }
EOT;

$this->registerCss($css);

$this->params['breadcrumbs'][] = $this->title;
?>

    <!-- Nombre del equipo e imagen -->
    <div class='container'>
        <div class='row centrado'>
            <div id='img_equipo' class='col-xs-4 col-sm-1 col-md-1 col-lg-1'>
                <?=
                    Html::img(
                        'images/cargando.gif',
                        ['class'=>'img-circle']
                    );
                ?>
            </div>
            <div id='titulo' class='col-xs-8 col-sm-11 col-md-11 col-lg-11'>
                <h3>
                    <strong>
                        <?= Html::encode($this->title) ?>
                    </strong>
                </h3>
                <div class='row'>
                    <div class='col-md-4'>
                        <p>
                            <?= Html::encode($model->descripcion) ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <!-- Pestañas de selección -->
    <?= MyHelpers::tabs($items) ?>

</div>
