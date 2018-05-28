<?php
/* Vista de comentarios de una tarjeta */

/* @var $comentarios yii\db\ActiveRecord */
/* @var $comentarios app\models\Comentarios */
/* @var $nuevo_comentario app\models\Comentarios */
/* @var $tarjeta app\models\Tarjetas */

use yii\helpers\Html;

?>

<!-- Lista de comentarios -->
<?= $this->render('lista_comentarios', [
    'comentarios'=>$comentarios,
]) ?>

<!-- Formulario de crear un comentario -->
<?= $this->render('/comentarios/create', [
    'model'=>$nuevo_comentario,
    'tarjeta'=>$tarjeta,
]) ?>
