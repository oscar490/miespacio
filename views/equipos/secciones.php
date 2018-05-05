<?php

/** Vista de secciones de opciones **/

/* @var $model app\models\Equipos */
/* @var $tableros app\models\Tableros */
/* @var $model app\models\Tableros */

use yii\helpers\Html;
use app\components\MyHelpers;


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
        'content'=> $this->render('miembros', [
            'model'=>$model,
            'miembros'=>$miembros
        ]),
    ],
];
?>

<!-- Pestañas de selección -->
<?= MyHelpers::tabs($items) ?>
