<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EquiposSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $tableros yii\data\ActiveDataProvider */

$this->title = 'Tableros | MiEspacio';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipos-index">

    <?= ListView::widget([
        'dataProvider'=>$dataProvider,
        'itemView'=>'_equipo',
        'summary'=>'',
    ])?>
</div>
