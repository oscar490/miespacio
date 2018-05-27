<?php
/* Vista de las notificaciones del tablero . */

/* @var $notificaciones yii\db\ActiveRecord */
/* @var $notificaciones app\models\Notificaciones */

use yii\helpers\Html;
use app\components\MyHelpers;

?>

<?= $this->render('lista_notificaciones', [
    'query_mas_notificaciones'=>$query_mas_notificaciones,
]) ?>
