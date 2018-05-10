<?php
/* Lista de notificaciones */

/* @var $notificaciones yii\db\ActiveQuery */

use yii\helpers\Html;
use app\components\MyHelpers;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

?>

<?= ListView::widget([
    'dataProvider'=>new ActiveDataProvider([
        'query'=>$notificaciones,
        'sort'=>[
            'defaultOrder'=>['created_at'=>SORT_DESC]
        ]
    ]),
    'itemView'=>'_notificacion',
    'summary'=>''
]) ?>
