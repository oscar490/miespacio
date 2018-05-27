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

if (isset($notificaciones)) {
    $consulta = $notificaciones->limit(3);
    $page = false;

} else {
    $consulta = $query_mas_notificaciones;
    $page = [
        'pageSize'=>4,
    ];

}
?>

<?= ListView::widget([
    'dataProvider'=>new ActiveDataProvider([
        'query'=>$consulta,
        'sort'=>[
            'defaultOrder'=>['created_at'=>SORT_DESC]
        ],
        'pagination'=>$page,
    ]),
    'itemView'=>'_notificacion',
    'summary'=>''
]) ?>

<!-- <div class='row'>
    <div id='button_ver_mas' class='col-xs-12 col-md-2 col-md-offset-5 col-xs-offset-3'>
    <?php /**
        <?= Html::a(
            'Ver más actividades',
            ['tableros/view-notificaciones', 'id'=>$id_tablero],
            ['class'=>'btn btn-primary']
        )
        **/?>
    </div>
</div> -->
