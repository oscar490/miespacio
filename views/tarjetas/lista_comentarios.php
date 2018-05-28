<?php
/* Lista de comentarios de tarjeta */

/* @var $comentarios yii\db\ActiveRecord */
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

?>

<?= ListView::widget([
    'dataProvider'=>new ActiveDataProvider([
        'query'=>$comentarios,
    ]),
    'itemView'=>'/comentarios/view',
    'summary'=>''
]) ?>
