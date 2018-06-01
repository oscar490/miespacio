<?php
/* Mensajes Recibidos */

/* @var $mensajes_recibidos yii\db\ActiveRecord */
?>

<div id='mensajes_rcibidos'>
    <?= $this->render('lista_mensajes', [
        'query'=>$mensajes_recibidos
    ]) ?>
</div>
