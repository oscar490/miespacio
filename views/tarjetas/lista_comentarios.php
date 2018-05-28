<?php
/* Lista de comentarios de tarjeta */

/* @var $comentarios yii\db\ActiveRecord */
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

?>

<?= ListView::widget([
    'dataProvider'=>new ActiveDataProvider([
        'query'=>$comentarios->limit(5),
        'pagination'=>false,
        'sort'=>[
            'defaultOrder'=>['created_at'=>SORT_DESC]
        ],
    ]),
    'itemView'=>'/comentarios/view',
    'summary'=>''
]) ?>
