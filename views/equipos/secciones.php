<?php

/** Vista de secciones de opciones del equipo **/

/* @var $this yii\web\View */
/* @var $model app\models\Equipos */
/* @var $tableros yii\data\ActiveDataProvider */
/* @var $tablero_crear app\models\Tableros */
/* @var $miembros yii\data\ActiveDataProvider */
/* @var $usuario_search app\models\UsuariosSearch */

use yii\helpers\Html;
use app\components\MyHelpers;
use app\models\Miembros;

$miembro = Miembros::find()
    ->where(['equipo_id'=>$model->id,'usuario_id'=>Yii::$app->user->id])
    ->one();

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
    ],

    [
        //  Miembros del equipo
        'label'=>MyHelpers::icon('glyphicon glyphicon-user')
                . ' ' . 'Miembros',
        'content'=> $this->render('miembros', [
            'model'=>$model,
            'miembros'=>$miembros,
            'usuario_search'=>$usuario_search,
        ]),
    ]

];

if ($miembro->esPropietario) {

    $items[] = [

        //  Modificación de imágen.
        'label'=>MyHelpers::icon('glyphicon glyphicon-picture')
                . ' ' . 'Imágen',
        'content'=> $this->render('form_imagen', [
            'equipo'=>$model,
        ]),

    ];

    $items[] = [
        //  Modificación del equipo.
        'label'=>MyHelpers::icon('glyphicon glyphicon-wrench')
                . ' ' . 'Configuración',
        'content'=> $this->render('update', [
            'equipo'=>$model,
        ]),

    ];

}

?>

<!-- Pestañas de selección -->
<?= MyHelpers::tabs($items) ?>
