<?php
/* Lista de miembros del equipo */

/* @var $miembros yii\data\ActiveDataProvider */
/* @var $model app\models\Equipos */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

?>

<?= ListView::widget([
    'dataProvider'=>$miembros,
    'itemView'=>'_miembro',
    'viewParams'=> [
        'equipo'=>$model
    ],
    'summary'=>'',
]); ?>
