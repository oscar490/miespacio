<?php
/* Mensajes Recibidos */

/* @var $mensajes_recibidos yii\db\ActiveRecord */

use yii\helpers\Url;

$url_load = Url::to(['mensajes/load-recibidos']);

$js = <<<EOT
    setInterval(function() {
        sendAjax('$url_load', 'GET', {}, function(data) {
            $('#mensajes_recibidos').html(data);
        })
    }, 3000);

    console.log($('#mensajes_recibidos'));
EOT;

// $this->registerJs($js);
?>
<br>

<div id='mensajes_recibidos'>
    <?= $this->render('lista_mensajes', [
        'query'=>$mensajes_recibidos
    ]) ?>
</div>
