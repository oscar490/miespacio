<?php
/* Lista de mensajes */

/* @var $query yii\db\ActiveRecord */

use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

?>

<?= ListView::widget([
    'dataProvider'=>new ActiveDataProvider([
        'query'=>$query,
        'pagination'=>[
            'pageSize'=>5
        ],
        'sort'=>[
            'defaultOrder'=>['created_at'=>SORT_DESC]
        ],
    ]),
    'summary'=>'',
    'itemView'=>'view',
]) ?>
