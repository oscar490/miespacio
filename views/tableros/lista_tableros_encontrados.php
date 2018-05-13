<?php
/* Vista de lista de tableros encontrados */

/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\widgets\ListView;
use app\models\Tableros;
use app\models\Equipos;

$equipos = Equipos::find()
    ->select(['denominacion'])
    ->indexBy('id')
    ->column();

?>

<?php if (!empty($dataProvider->query->all())): ?>
    <?= ListView::widget([
        'dataProvider'=> $dataProvider,
        'itemView'=>'_tablero_encontrado',
        'summary'=>'',
    ]) ?>

<?php else: ?>
    <?= $this->render('create', [
        'model'=>new Tableros,
        'equipos'=>$equipos,
    ]) ?>

<?php endif; ?>
