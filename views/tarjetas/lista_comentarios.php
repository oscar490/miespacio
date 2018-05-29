<?php
/* Lista de comentarios de tarjeta */

/* @var $comentarios yii\db\ActiveRecord */
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

?>

<?= ListView::widget([
    'dataProvider'=>new ActiveDataProvider([
        'query'=>$comentarios->limit(4),
        'pagination'=>false,
        'sort'=>[
            'defaultOrder'=>['created_at'=>SORT_DESC]
        ],
    ]),
    'itemView'=>'/comentarios/view',
    'summary'=>''
]) ?>

<!-- Formulario de crear un comentario -->
<?= $this->render('/comentarios/create', [
    'model'=>$nuevo_comentario,
    'tarjeta'=>$tarjeta,
]) ?>
