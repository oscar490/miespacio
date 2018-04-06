<?php
/* Se muestra los equios y los tableros que pertenecen a cada equipo. */

/* @var $this yii\web\View */
/* @var $equipos yii\data\ActiveDataProvider */
/* @var $equipo_crear app\models\Equipos */
/* @var $tablero_crear app\models\Tableros */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\popover\PopoverX;

$this->title = 'Tableros | MiEspacio';
$this->params['breadcrumbs'][] = $this->title;

?>
<!-- Formulario para crear un nuevo equipo -->
<div class='row'>
    <div class='col-xs-12 col-md-6'>
        <?= PopoverX::widget([
            'toggleButton'=>[
                'label'=>'Crear un nuevo equipo',
                'class'=>'btn btn-info'
            ],
            'placement' => PopoverX::ALIGN_BOTTOM,
            'type' => PopoverX::TYPE_INFO,
            'header'=>'Crear un nuevo equipo',
            'size'=>'md',
            'content'=>$this->render('_form', [
                'equipo'=>$equipo_crear,
            ]),

        ]) ?>
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
