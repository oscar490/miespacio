<?php
/* Lista de notificaciones */

/* @var $notificaciones yii\db\ActiveQuery */

use yii\helpers\Html;
use app\components\MyHelpers;
use yii\data\ActiveDataProvider;
use yii\widgets\ListView;

$css = <<<EOT
    #button_ver_mas {
        margin-bottom: 10px;
    }
EOT;

$this->registerCss($css);
?>

<?= ListView::widget([
    'dataProvider'=>new ActiveDataProvider([
        'query'=>$notificaciones->limit(3),
        'sort'=>[
            'defaultOrder'=>['created_at'=>SORT_DESC]
        ],
        'pagination'=>false,
    ]),
    'itemView'=>'_notificacion',
    'summary'=>''
]) ?>


<div class='row'>
    <div id='button_ver_mas' class='col-xs-12 col-md-2 col-md-offset-5 col-xs-offset-3'>
        <?= Html::a(
            'Ver más actividades',
            ['#'],
            ['class'=>'btn btn-primary']
        ) ?>
    </div>
</div>
