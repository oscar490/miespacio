<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $lista app\models\Listas */


?>

<?= $this->render('_form', [
    'model' => $lista,
    'tablero'=>$lista->tablero,
    'label' => 'Modificar'
]) ?>
