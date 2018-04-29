<?php
/* Contenido de un Tablero */

/* @var $this yii\web\View */
/* @var $model app\models\Tableros */

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\components\MyHelpers;
use app\models\Listas;

//  Título de la página.
$this->title = $model->denominacion . ' | MiEspacio';

//  Migas de pan.
$this->params['breadcrumbs'][] = [
    'label' => 'Tableros | MiEspacio',
    'url' => ['equipos/gestionar-tableros']
];

$this->params['breadcrumbs'][] = [
    'label'=>$model->equipo->denominacion,
    'url'=>['equipos/view', 'id'=>$model->equipo->id],
];

$this->params['breadcrumbs'][] = $this->title;

//  CSS.
$this->registerCssFile(
    '/css/tableros_view.css'
);

//  Mensaje de confirmación de eliminación.
echo MyHelpers::confirmacion('Eliminar');

$url_tablero = Url::to(['tableros/delete', 'id'=>$model->id]);

//  JavaScript: Eliminación del tablero.
$js = <<<EOT

    eliminarElemento($('#btn_eliminar'), '$url_tablero');

EOT;
$this->registerJS($js);

?>
<div class="container">

    <!-- Nombre del tablero -->
    <div class='row'>
        <div id='tablero_name' class='col-md-12'>
            <h3>
                <span class='label label-primary'>
                    <strong>
                        <?=
                            Html::encode($model->denominacion);
                        ?>
                    </strong>
                </span>
            </h3>
        </div>
    </div>
    <br>

    <!-- Menú del Tablero, para crear lista y configurar tablero. -->
    <div class='row'>
            <?= $this->render('menu_view', [
                'lista'=>$lista,
                'model'=>$model,
                'equipos'=>$equipos
            ]) ?>
    </div>

    <!-- Listas que pertenecen al tablero -->
    <div class='row'>
        <div id='contenedor_general' class='col-md-12'>
            <?= $this->render('listas_tablero', [
                'model'=>$model,
                'tarjeta'=>$tarjeta,
                'adjunto'=>$adjunto,
            ]) ?>
        </div>
    </div>
</div>
