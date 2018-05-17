<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $lista app\models\Listas */

$url_update_lista = Url::to(['listas/update-ajax', 'id'=>$lista->id]);

//  Modificación del nombre de la lista.
$js = <<<EOT
    $(document).ready(function() {
        let formulario = $("#form_lista_$lista->id");
        let input = formulario.find('input#denominacion');

        formulario.on('afterValidateAttribute', function(event, attribute, messages) {
            if (messages.length == 0) {

                sendAjax('$url_update_lista', 'POST', formulario.serialize(),
                    function(data) {
                        $('#contenedor_general').html(data);
                    })
            }
        })
    })
EOT;

$this->registerJs($js);


?>

<?= $this->render('_form', [
    'model' => $lista,
    'tablero'=>$lista->tablero,
    'action'=>['listas/update', 'id'=>$lista->id],
    'label' => 'Modificar',
    'id_form_lista'=>"form_lista_$lista->id"
]) ?>
