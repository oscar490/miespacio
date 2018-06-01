<?php
/* Listado completo de mensajes */

use yii\helpers\Html;
use app\components\MyHelpers;

/* @var $mensajes_enviados yii\db\ActiveRecord */
/* @var $mensajes_recibidos yii\db\ActiveRecord */

$this->title = 'Mensajes';
$this->params['breadcrumbs'][] = $this->title;

$num_recibidos = $mensajes_recibidos->count();
$num_enviados = $mensajes_enviados->count();

$items = [
    [
        //  Mensajes Recibidos
        'label'=> MyHelpers::icon('glyphicon glyphicon-inbox') .
            ' ' . '<strong>Recibidos</strong>' . ' ' .
            MyHelpers::badge($num_recibidos),
        'content'=>'Recibidos'
    ],

    [
        //  Mensajes Enviados
        'label'=> MyHelpers::icon('glyphicon glyphicon-send') .
            ' ' . '<strong>Enviados</strong>' . ' ' .
            MyHelpers::badge($num_enviados),
        'content'=>'enviados'
    ],

    [
        //  Crear mensaje
        'label'=> MyHelpers::icon('glyphicon glyphicon-pencil') .
            ' ' . '<strong>Redactar</strong>',
        'content'=>'Redactar'
    ]
];


?>

<?= MyHelpers::tabs($items); ?>
