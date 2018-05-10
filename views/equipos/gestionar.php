<?php
/* Se muestra los equipos y los tableros que pertenecen a cada equipo. */

/* @var $this yii\web\View */
/* @var $equipos yii\data\ActiveDataProvider */


use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\popover\PopoverX;
use app\components\MyHelpers;
use yii\bootstrap\Modal;
use app\assets\AppAsset;

$this->title = 'Tableros | MiEspacio';
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile(
    '/js/gestionar.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$this->registerCssFile(
    '/css/gestionar.css'
);

?>


<!-- Vista de creación de equipo -->
<div class='row'>
    <div id='form_create_equipo'>
        <?=
            $this->render('create', [
                'equipo' => $equipo,
            ]);
        ?>
    </div>
</div>
<br>

<!-- Listado de los equipos creados por el usuario -->
<div class="equipos-index">
    <?= ListView::widget([
        'dataProvider'=>$equipos,
        'itemView'=>'_equipo',
        'viewParams'=>[
            'tablero_crear'=>$tablero_crear,
        ],
        'summary'=>'',
    ])?>
</div>
