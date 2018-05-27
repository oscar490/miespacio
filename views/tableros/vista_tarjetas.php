<?php
/* vista de tarjetas */

/* $model app\models\Listas */
use yii\widgets\ListView;
use yii\helepers\Html;
use yii\data\ActiveDataProvider;

?>

<?php if ($model->contieneTarjetas): ?>
    <?= ListView::widget([
        'dataProvider'=>new ActiveDataProvider([
            'query' => $model->getTarjetas()->with('lista'),
            'sort'=>[
                'defaultOrder'=>['created_at'=>SORT_DESC]
            ]
        ]),
        'itemView'=>'_tarjeta',
        'summary'=>''
    ]); ?>
<?php endif; ?>
