<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tableros */

?>

<!-- Formulario de tablero -->

<?= $this->render('_form', [
    'tablero' => $model,
    'equipo'=>$model->equipo,
    'equipos'=>$equipos,
]) ?>
