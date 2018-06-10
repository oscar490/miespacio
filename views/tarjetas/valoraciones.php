<?php
/* Valoraciones de tarjeta */

use yii\helpers\Html;
use app\components\MyHelpers;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;



$num_valoraciones = $valoraciones->count();

$js = <<<EOT
    $("#valoraciones_$tarjeta->id").text('$num_valoraciones')
EOT;

$this->registerJs($js);
?>

<?= ListView::widget([
    'dataProvider'=>new ActiveDataProvider([
        'query'=>$valoraciones
    ]),
    'itemView'=>'_valoracion',
    'summary'=>'',
]) ?>
