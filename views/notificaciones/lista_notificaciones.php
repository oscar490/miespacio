<?php
/* Lista de notificaciones */

/* @var $notificaciones yii\data\ActiveDataProvider */

use yii\helpers\Html;
use app\components\MyHelpers;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

?>

<?= ListView::widget([
    'dataProvider'=>new ActiveDataProvider([
        'query'=>$notificaciones,
    ]),
    'itemView'=>'_notificacion',
    'summary'=>''
]) ?>
