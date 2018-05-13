<?php
/* Vista de lista de tableros encontrados */

/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\widgets\ListView;
?>

<?= ListView::widget([
    'dataProvider'=> $dataProvider,
    'itemView'=>'_tablero_encontrado',
    'summary'=>'',
]) ?>
