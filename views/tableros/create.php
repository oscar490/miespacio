<?php
/* Creación de un nuevo tablero */

/* @var $this yii\web\View */
/* @var $model app\models\Tableros */

use yii\helpers\Html;


?>

<?= $this->render('_form', [
    'tablero' => $model,
    'equipos'=>$equipos,
]) ?>
