<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $equipo app\models\Equipos */
/* @var $equipos app\models\Equipos */
/* @var $tablero app\models\Tableros */
/* @var $tablerosLista app\models\Tableros */


$this->title = 'Crear | MiEspacio';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipos-create">

    <?= $this->render('_form', [
        'equipo' => $equipo,
        'tablero'=>$tablero,
        'equipos'=>$equipos,
        'tablerosLista'=>$tablerosLista,
    ]) ?>

</div>
