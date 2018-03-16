<?php

use yii\helpers\Html;
use yii\widgets\ListView;
?>

<?=
    Html::tag(
        'h4',
        Html::tag(
            'span',
            '',
            ['class'=>'glyphicon glyphicon-list-alt']
        ) . ' ' .
        Html::tag(
            'strong',
            $model->denominacion
        )
    );
?>
