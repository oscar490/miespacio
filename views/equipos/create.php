<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $equipo app\models\Equipos */

$this->title = 'Crear un nuevo equipo';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipos-create">

    <?= $this->render('_form', [
        'equipo' => $equipo,
        'tablero'=>$tablero,
        'equipos'=>$equipos,
    ]) ?>

</div>
