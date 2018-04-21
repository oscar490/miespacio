<?php
/* Contenido de un Tablero */

/* @var $this yii\web\View */
/* @var $model app\models\Tableros */

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
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

    .container {
        padding-left: 0px;
    }

    #menu {
        display: none;
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
        <div class='col-xs-12 col-md-12'>
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
        <!-- Tarjetas del tablero -->
        <div class='col-md-9'>
            <div class='row'>
                <?= ListView::widget([
                    'dataProvider' => new ActiveDataProvider([
                        'query' => $model->getListas(),
                    
                    ]),
                    'itemView' => '_lista',
                    'summary' => '',
                ]); ?>

            </div>

        </div>

        <div id='menu' class='col-md-3'>
            <!-- Formulario de creación de tarjeta -->
            <div>
                <?= $this->render('/tarjetas/create', [
                    'model'=>$tarjeta,
                    'tablero'=>$model,
                ]) ?>
            </div>
            <!-- Formulario de propiedades del tablero -->
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    <strong>
                        <?=
                            Html::tag(
                                'span',
                                '',
                                ['class'=>'glyphicon glyphicon-edit']
                            ) . ' ' .
                            Html::encode('Propiedades')
                        ?>
                    </strong>
                </div>
                <div class='panel-body'>

                    <!-- Modificar el tablero -->
                    <?= $this->render('update', [
                        'model'=>$model,
                        'equipos'=>$equipos,
                    ]) ?>

                    <!-- Eliminar el tablero -->
                    <?=
                        Html::button(
                            Html::tag(
                                'span',
                                '',
                                ['class'=>'glyphicon glyphicon-remove-sign']
                            ) . ' ' .
                            'Eliminar',
                            [
                                'class'=>'btn btn-danger btn-block',
                                'id'=>'btn_eliminar',
                            ]
                        );
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>
