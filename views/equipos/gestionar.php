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
use app\components\MyHelpers;
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

<!-- Botón de creación de nuevo equipo -->
<?=
    Html::button(
        MyHelpers::icon('glyphicon glyphicon-plus') .
        ' Crear un nuevo equipo',
        [
            'class' => 'btn btn-default',
            'id' => 'btn_create_equipo'
        ]
    );
?>

<!-- Vista de creación de equipo -->
<div class='row'>
    <br>
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
