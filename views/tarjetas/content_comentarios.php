<?php
/* Vista de comentarios de una tarjeta */

/* @var $comentarios yii\db\ActiveRecord */
/* @var $comentarios app\models\Comentarios */

use yii\helpers\Html;

?>

<?= $this->render('lista_comentarios', [
    'comentarios'=>$comentarios,
]) ?>
