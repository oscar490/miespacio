<?php
/* Vista de los botones de valoración */

/* @var $valoraciones app\models\TiposValoraciones */
/* @var $model app\models\Tarjetas */

use yii\helpers\Html;
use app\components\MyHelpers;
use yii\helpers\Url;
use app\models\Valoraciones;

$url_valorar = Url::to(['valoraciones/valorar', 'id_tarjeta'=>$tarjeta->id]);
$url_render = Url::to(['tarjetas/render-valoraciones', 'id'=>$tarjeta->id]);
$usuario_id = Yii::$app->user->id;
$tarjeta_id = $tarjeta->id;

$js = <<<EOT
    $("button[data-tipo]").on('click', function() {
        let tipo_voto = $(this).data('tipo');
        datos = {
            usuario_id: '$usuario_id',
            tarjeta_id: '$tarjeta_id',
            tipo_id: tipo_voto
        };
        var boton = $(this);
        sendAjax('$url_valorar', 'POST', datos, function(data) {
            $("button[data-tipo]").attr('class','btn btn-default btn-block');

            boton.attr('class', 'btn btn-primary btn-block');

            sendAjax('$url_render', 'GET', {}, function(data) {
                $("#view_valoraciones_$tarjeta_id").html(data);
            })
        });

    })
EOT;

$this->registerJs($js);
$valoracion_tarjeta = Valoraciones::find()
    ->where([
        'usuario_id'=>Yii::$app->user->id,
        'tarjeta_id'=>$tarjeta_id
    ])->one();

?>

<?php foreach ($valoraciones_add as $valoracion):

    if ($valoracion_tarjeta === null) {
        $class = "btn btn-default btn-block";

    } else {
        $class = ($valoracion_tarjeta->tipo_id === $valoracion->id)
            ? 'btn btn-primary btn-block' : 'btn btn-default btn-block';
    }
?>
    <div class='col-md-4'>
        <?= Html::button(
            MyHelpers::icon($valoracion->icono)
                . " " . "<strong>$valoracion->denominacion</strong>",
            [
                'class'=>$class,
                'data-tipo'=>$valoracion->id,
                'id'=>'btn_voto'
            ]
        ) ?>
    </div>
<?php endforeach; ?>
