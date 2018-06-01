<?php
/* Mensajes Recibidos */

/* @var $mensajes_recibidos yii\db\ActiveRecord */
?>

<div id='mensajes_enviados'>
    <?= $this->render('lista_mensajes', [
        'query'=>$mensajes_enviados
    ]) ?>
</div>
