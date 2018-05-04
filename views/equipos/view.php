<?php
/* Vista del contenido del equipo */

/* @var $this yii\web\View */
/* @var $model app\models\Equipos */
/* @var $tableros app\models\Tableros */
/* @var $tablero_crear app\models\Tableros */

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\MyHelpers;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

//  Migas de pan.
$this->title = $model->denominacion;
$this->params['breadcrumbs'][] = [
    'label' => 'Tableros | MiEspacio',
    'url' => ['equipos/gestionar-tableros']
];
$this->params['breadcrumbs'][] = $this->title;

//  JavaScript.
$this->registerJsFile(
    '/js/equipo.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

//  Css.
$this->registerCssFile(
    '/css/equipo.css'
);

$js = <<<EOT
    $(document).ready(function() {
        selector = $('#img_equipo img');
        imagen = '$model->url_imagen';

        cambiarImagen(imagen, selector);
    })
EOT;

$this->registerJs($js);

//  Secciones
$items = [
    [
        //  Lista de tableros del equipo.
        'label'=>MyHelpers::icon('glyphicon glyphicon-align-justify')
                . ' ' . 'Tableros',
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
        'label'=>MyHelpers::icon('glyphicon glyphicon-wrench')
                . ' ' . 'Configuración',
        'content'=> $this->render('update', [
            'equipo'=>$model,
        ]),
        'linkOptions'=>[
            'id'=>'config_tableros'
        ]
    ],
    [
        //  Modificación de imágen.
        'label'=>MyHelpers::icon('glyphicon glyphicon-picture')
                . ' ' . 'Imágen',
        'content'=> $this->render('form_imagen', [
            'equipo'=>$model,
        ])
    ],
    [
        //  Miembros del equipo
        'label'=>MyHelpers::icon('glyphicon glyphicon-user')
                . ' ' . 'Miembros',
        'content'=> 'hola'
    ],
];

?>

    <!-- Propiedades. Nombre del equipo e imagen -->
    <div class='container'>
        <?= $this->render('propiedades', [
            'model'=>$model
        ]) ?>
    </div>
    <br>

    <!-- Pestañas de selección -->
    <?= MyHelpers::tabs($items) ?>

</div>
