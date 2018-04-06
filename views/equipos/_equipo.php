<?php
/* Vista parcial de un equipo */
/* Se muestra un listado de los tableros que pertenecen a un equipo. */

/* @var $model app\models\Equipos */
/* @var $tablero_crear app\models\Tableros */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\Tableros;

?>

<!-- Nombre del equipo -->
<div class='row'>
    <div class='col-md-4'>
        <?=
            Html::tag(
                'h4',
                Html::tag(
                    'span',
                    '',
                    ['class'=>'glyphicon glyphicon-list-alt']
                ) . ' ' .
                Html::tag(
                    'strong',
                    $model->denominacion
                )
            );
        ?>
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
<hr>
