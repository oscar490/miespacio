<?php
/* Vista parcial de un equipo */
/* Se muestra un listado de los tableros que pertenecen a un equipo. */

/* @var $model app\models\Equipos */
/* @var $tablero_crear app\models\Tableros */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\Tableros;

$this->registerCssFile('/css/equipo.css');
?>

<!-- Nombre del equipo -->
<div class='row'>
    <div id='imagen_equipo' class='col-xs-1 col-md-1 col-lg-1'>
        <?=
            Html::img(
                $model->url_imagen,
                ['class'=>'img-circle logo-equipo']
            )
        ?>
    </div>
    <div id='texto_equipo' class='col-xs-8 col-md-11 col-lg-11'>

        <h4>
            <strong>
                <?= Html::encode($model->denominacion) ?>
            </strong>
        </h4>

    </div>

</div>


<!-- Tableros de cada equipo -->
<?= $this->render('tableros_equipo', [
    'tableros'=>new ActiveDataProvider([
        'query'=>$model->getTableros(),
    ]),
    'equipo'=>$model,
    'tablero_crear'=>$tablero_crear,
]) ?>


<!-- Enlace a los tableros del equipo actual -->
<?=
    Html::a(
        "<span class='glyphicon glyphicon-menu-hamburger'></span> Tableros",
        ['equipos/view', 'id'=>$model->id],
        ['class'=>'btn btn-info']
    )
?>

<hr>
