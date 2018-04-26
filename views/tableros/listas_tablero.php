<?php
/* Listas de un tablero */

/* $model app\models\Tableros */
/* $tarjeta app\models\Tarjetas */

use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;

?>

<?php if ($model->contieneListas): ?>
    <?php /**
    <?= ListView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query' => $model->getListas(),
            'sort'=>['defaultOrder'=>['created_at'=>SORT_DESC]]
        ]),

        'itemView' => '_lista',
        'viewParams'=>[
            'tarjeta'=>$tarjeta,
        ],
        'summary' => '',
    ]); **/?>

    <!-- Listas del Tablero -->
    <div class='row'>
        <?php foreach ($model->getListas()
            ->orderBy(['created_at'=>SORT_DESC])->all() as $lista): ?>
            <?= $this->render('_lista_nueva', [
                'lista'=>$lista,
                'tarjeta' => $tarjeta
            ]) ?>
        <?php endforeach; ?>
    </div>

<?php else: ?>
    <!-- Lista de prueba -->
    <div class='row'>
        <div class='col-md-4'>
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
        </div>
    </div>
<?php endif; ?>
