<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EquiposSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Equipos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipos-index">

    <?= ListView::widget([
        'dataProvider'=>$dataProvider,
        'itemView'=>'_equipos',
        'summary'=>'',
    ])?>
</div>
