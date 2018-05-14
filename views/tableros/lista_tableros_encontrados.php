<?php
/* Vista de lista de tableros encontrados */

/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\widgets\ListView;
use app\models\Tableros;
use app\models\Equipos;
use app\components\MyHelpers;

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
    <div class='row'>
        <?= $this->render('create', [
            'model'=>new Tableros([
                'denominacion'=>$busqueda
            ]),
            'equipos'=>$equipos
        ]) ?>
    </div>

<?php endif; ?>
