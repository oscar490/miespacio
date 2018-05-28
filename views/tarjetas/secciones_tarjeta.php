<?php
/* Secciones del contenido de la tarjeta */

/* @var $model app\models\Tarjetas */
/* @var $adjunto app\models\Adjuntos */

use yii\helpers\Html;
use app\components\MyHelpers;


$items = [
    [
        'label'=> MyHelpers::icon('glyphicon glyphicon-file') .
            ' ' . '<strong>Adjuntos</strong>',
        'content'=>$this->render('content_tarjeta', [
            'model'=>$model,
            'adjunto'=>$adjunto
        ]),
    ],
    [
        'label'=>MyHelpers::icon('glyphicon glyphicon-comment') .
            ' ' . '<strong>Comentarios</strong>',
        'content'=>$this->render('content_comentarios', [
            'comentarios'=>$model->getComentarios(),
        ]),
    ]
];


?>

<?= MyHelpers::tabs($items); ?>
