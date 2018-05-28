<?php
/* Secciones del contenido de la tarjeta */

/* @var $model app\models\Tarjetas */
/* @var $adjunto app\models\Adjuntos */

use yii\helpers\Html;
use app\components\MyHelpers;


$items = [
    [
        'label'=>'Contenido de tarjeta',
        'content'=>$this->render('content_tarjeta', [
            'model'=>$model,
            'adjunto'=>$adjunto
        ]),
    ],
    [
        'label'=>'Comentarios',
        'content'=>'pepe',
    ]
];


?>

<?= MyHelpers::tabs($items); ?>
