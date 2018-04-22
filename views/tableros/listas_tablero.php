<?php
/* Listas de un tablero */

/* $model app\models\Tableros */

use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

?>

<?php if ($model->contieneListas): ?>
    <?= ListView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query' => $model->getListas(),
            'sort'=>['defaultOrder'=>['created_at'=>SORT_DESC]]
        ]),

        'itemView' => '_lista',
        'summary' => '',
    ]); ?>
<?php else: ?>
    <div class='panel panel-default'>
        <div class='panel-heading'>
            <?= Html::encode('Lista'); ?>
        </div>
        <div class='panel-body'>
            <p>
                En una <strong>Lista</strong> se pueden colocar las
                diferentes tarjetas para realizar sobre ellas una
                clasificación y tener un orden sobre ellas. Desde
                el menú <strong>Crear lista</strong> podemos empezar
                a crear nuestras listas.
            </p>
        </div>
    </div>
<?php endif; ?>
