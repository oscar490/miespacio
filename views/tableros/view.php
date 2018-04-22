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



$this->title = $model->denominacion . ' | MiEspacio';
$this->params['breadcrumbs'][] = [
    'label' => 'Tableros | MiEspacio',
    'url' => ['equipos/gestionar-tableros']
];
$this->params['breadcrumbs'][] = [
    'label'=>$model->equipo->denominacion,
    'url'=>['equipos/view', 'id'=>$model->equipo->id],
];

//  CSS.
$css = <<<EOT
    a:link {
        text-decoration: none;
    }



    #menu {

    }
EOT;

//  Mensaje de confirmación de eliminación.
echo MyHelpers::confirmacion('Eliminar');
$url_tablero = Url::to(['tableros/delete', 'id'=>$model->id]);

//  JavaScript.
$js = <<<EOT

    eliminarElemento($('#btn_eliminar'), '$url_tablero');

EOT;

$this->registerJS($js);
$this->registerCss($css);

$this->params['breadcrumbs'][] = $this->title;
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

    <div class='row'>
        <!-- Listas del tablero -->
        <div class='col-md-9'>
            <?= $this->render('listas_tablero', [
                'model'=>$model
            ]) ?>
        </div>

        <!-- Menú del Tablero -->
        <?= $this->render('menu_view', [
            'tarjeta'=>$tarjeta,
            'lista'=>$lista,
            'model'=>$model,
            'equipos'=>$equipos
        ]) ?>

    </div>
</div>
