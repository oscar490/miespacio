<?php
/* Mensajes Recibidos */

/* @var $mensajes_recibidos yii\db\ActiveRecord */

use yii\helpers\Url;
use yii\db\Expression;
use app\models\Mensajes;

$url_load = Url::to(['mensajes/load-recibidos']);


//  Se actualiza la lista de mensajes. La ventana modal
//  debe estar cerrada.
$js = <<<EOT
    setInterval(function() {
        sendAjax('$url_load', 'GET', {}, function(data) {
            if ($("div.in").length < 3) {
                $('#mensajes_recibidos').html(data);
                let num = $('.mensaje_sin_leer').length;

                indicarMensajes(num);

                $("span.badge").text(num);
                console.log('render');
            }
        })
    }, 5000);


EOT;

// $this->registerJs($js);
?>
<br>

<div id='mensajes_recibidos'>
    <?= $this->render('lista_mensajes', [
        'query'=>$mensajes_recibidos
    ]) ?>
</div>
