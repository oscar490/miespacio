<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EquiposSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $tablero yii\data\ActiveDataProvider */
/* @var $equipo app\models\Equipos */

$this->title = 'Tableros | MiEspacio';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="equipos-index">

    <?= ListView::widget([
        'dataProvider'=>$equipos,
        'itemView'=>'_equipo',
        'viewParams'=>[
            'tableroCrear'=>$tableroCrear,
        ],
        'summary'=>'',
    ])?>
</div>
