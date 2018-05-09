<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Notificaciones */


?>

<?= $this->render('lista_notificaciones', [
    'notificaciones'=>$notificaciones
]) ?>
