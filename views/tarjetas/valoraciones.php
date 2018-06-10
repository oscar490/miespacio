<?php
/* Valoraciones de tarjeta */

use yii\helpers\Html;
use app\components\MyHelpers;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

$css = <<<EOT
    #view_valoraciones {
        height: 400px;
    }
EOT;

$this->registerCss($css);
?>

<div id='view_valoraciones' class='content-scroll'>
    <?= ListView::widget([
        'dataProvider'=>new ActiveDataProvider([
            'query'=>$valoraciones
        ]),
        'itemView'=>'_valoracion',
        'summary'=>'',
    ]) ?>
</div>
