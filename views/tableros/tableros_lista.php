<?php
/* Tabla con los nombres de los tableros que pertenecen a un equipo */
/* @var $tableros app\models\Tableros */

use yii\grid\GridView;
use yii\data\ActiveDataProvider;

?>

<?php if (!$tableros->exists()): ?>
    <h4>No existe ningún tablero creado.</h4>
<?php else: ?>
    <?php $nombre_equipo = $tableros->one()->equipo->denominacion; ?>
    <?= GridView::widget([
        'dataProvider'=>new ActiveDataProvider([
            'query'=>$tableros,
        ]),
        'columns'=>[
            [
                'attribute'=>'denominacion',
                'header'=>"Tableros de $nombre_equipo",
            ],
        ],
        'summary'=>'',
    ]) ?>
<?php endif; ?>
