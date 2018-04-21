<?php
/* Vista parcial de una lista */

/* $model app\models\Listas */

use yii\helpers\Html;
use app\components\MyHelpers;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use kop\y2sp\ScrollPager;

?>


    <div class='col-md-4'>
        <div class='panel panel-default'>
            <div class='panel-heading'>
                <?=
                    MyHelpers::icon('glyphicon glyphicon-th-list') .
                    ' ' . Html::encode($model->denominacion)
                ?>
            </div>
            <div class='panel-body'>
                <?= ListView::widget([
                    'dataProvider'=>new ActiveDataProvider([
                        'query' => $model->getTarjetas(),
                    ]),
                    'itemView'=>'_tarjeta',
                    'pager' => [
                        'class' => \kop\y2sp\ScrollPager::className(),
                        'triggerOffset' => 3,
                    ],
                    'summary'=>''
                ]); ?>
            </div>
        </div>
    </div>
