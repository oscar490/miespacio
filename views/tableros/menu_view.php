<?php
/* Menú de propiedades de un tablero */

/* $model app\models\Tableros */
/* $tarjeta app\models\Tarjetas */
/* $equipos app\models\Equipos */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Miembros;
use app\components\MyHelpers;

$url_create = Url::to(['listas/create']);

$url_recargar_actividades = Url::to(['tableros/recargar-actividades', 'id'=>$model->id]);

$miembro = Miembros::find()
    ->where([
        'equipo_id'=>$model->equipo->id,
        'usuario_id'=>Yii::$app->user->id
    ])->one();

//  JavaScript.
$this->registerJsFile(
    '/js/menu_view.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$css = <<<EOT
    #notificaciones {
        height: 210px;
    }
EOT;
$this->registerCss($css);

$js = <<<EOT
    $(document).ready(function() {

        iteracionMenu();
        createLista('$url_create');

        let modal_actividades = $("#modal_actividades");
        recargar_actividades(modal_actividades, '$url_recargar_actividades');
    })
EOT;

$this->registerJs($js);

//  CSS.
$this->registerCssFile('/css/menu_view.css')
?>

<!-- Formulario de creación de lista -->
<div class='col-md-3'>
    <?= $this->render('/listas/create', [
        'lista'=>$lista,
        'tablero'=>$model,
    ]) ?>
</div>

<?php if ($miembro->esPropietario): ?>
    <!-- Modificar las propiedades del tablero -->
    <div class='col-md-3'>
        <?= $this->render('update', [
            'model'=>$model,
            'equipos'=>$equipos,
        ]) ?>
    </div>

<?php endif; ?>

<!-- Panel de Actividades sobre el tablero -->

<div class='col-md-3'>
    <?php
        MyHelpers::modal_begin(
            MyHelpers::icon('glyphicon glyphicon-align-right')
                . ' <strong>Actividades</strong>',
            MyHelpers::icon('glyphicon glyphicon-align-right')
                . ' <strong>Actividades</strong>',
            'btn btn-md btn-default',
            'modal_actividades'
        )
    ?>
        <div id="content-actividades" class='content-scroll'>
            <?= $this->render('/notificaciones/lista_notificaciones', [
                'notificaciones'=>$model->getNotificaciones(),
            ]) ?>
        </div>
    <?php
        MyHelpers::modal_end();
    ?>
</div>
