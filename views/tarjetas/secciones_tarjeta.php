<?php
/* Secciones del contenido de la tarjeta */

/* @var $model app\models\Tarjetas */
/* @var $adjunto app\models\Adjuntos */
/* @var $valoraciones yii\db\ActiveRecord */

use yii\helpers\Html;
use app\components\MyHelpers;
use app\models\Comentarios;
use app\models\Mapas;


$items = [
    [
        //  Contenido de la tarjeta.
        'label'=> MyHelpers::icon('glyphicon glyphicon-file') .
            ' ' . '<strong>Adjuntos</strong>',

        'content'=>$this->render('content_tarjeta', [
            'model'=>$model,
            'adjunto'=>$adjunto,
            'valoraciones_add'=>$valoraciones_add,
        ]),
    ],
    [
        //  Comentarios de tarjeta. Crear comentario.
        'label'=>MyHelpers::icon('glyphicon glyphicon-comment') .
            ' ' . '<strong>Comentarios</strong>'  .
            ' ' . "<span id='$model->id'class='badge'></span>",

        'content'=>$this->render('content_comentarios', [
            'comentarios'=>$model->getComentarios(),
            'nuevo_comentario'=>new Comentarios(),
            'tarjeta'=>$model,
        ]),
        'linkOptions'=>[
            'id'=>"comentarios_tarjeta_$model->id",
        ],
    ],

    [
        //  Valoraciones de tarjeta.
        'label'=>MyHelpers::icon('glyphicon glyphicon-thumbs-up') .
            ' ' . '<strong>Valoraciones</strong>',
        'content'=>$this->render('valoraciones', [
            'valoraciones'=>$valoraciones,
        ]),
    ],
];


?>

<?= MyHelpers::tabs($items); ?>
