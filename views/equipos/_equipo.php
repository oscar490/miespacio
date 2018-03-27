<?php
/* Se muestra un listado de los tableros que pertenecen a un equipo. */
/* Se permite crear nuevos tableros. */
/* @var $model app\models\Equipos */
/* @var $tablero_crear app\models\Tableros */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use app\models\Tableros;

//  Tableros que pertenecen al equipo actual.
$tableros = new ActiveDataProvider([
    'query'=>Tableros::find()
        ->where(['equipo_id'=>$model->id]),
]);
?>

<!-- Nombre del equipo -->
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

<!-- Tableros de cada equipo -->
<?= $this->render('tableros_equipo', [
    'tableros'=>$tableros,
    'equipo'=>$model,
    'tablero_crear'=>$tablero_crear,
]) ?>

&nbsp;

<!-- Enlace a los tableros del equipo actual -->
<?=
    Html::a(
        "<span class='glyphicon glyphicon-menu-hamburger'></span> Tableros",
        ['equipos/view', 'id'=>$model->id],
        ['class'=>'btn-sm btn-info']
    )
?>
<hr>
