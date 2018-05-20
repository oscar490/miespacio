<?php
/* Menú de propiedades de un tablero */

/* $model app\models\Tableros */
/* $tarjeta app\models\Tarjetas */
/* $equipos app\models\Equipos */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Miembros;

$url_create = Url::to(['listas/create']);

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

<div class='col-md-6'>
    <div class='panel panel-default'>
        <div class='panel-heading'>
            <strong>
                <?=
                    Html::encode("Actividades")
                ?>
            </strong>
        </div>
        <div id='notificaciones' class='panel-body content-scroll'>
            <?= $this->render('/notificaciones/lista_notificaciones', [
                'notificaciones'=>$miembro->getNotificaciones()
                    ->where(['tablero_id'=>$model->id])
            ]) ?>
        </div>
    </div>
</div>
