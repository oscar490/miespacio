<?php
/* Vista de una Lista */

/* @var $lista app\models\Listas */
/* @var $tarjeta app\models\Tarjetas */

use yii\helpers\Html;
use app\components\MyHelpers;
use yii\helpers\Url;

$this->registerJsFile(
    '/js/jquery-ui/jquery-ui.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '/js/lista.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$url_update = Url::to(['tarjetas/update-lista']);

$js = <<<EOT
    $(document).ready(function() {
        let selector = $("#btn_form_tarjeta_$lista->id");

        efectoSortable('$url_update');
        iteracionFormTarjeta(selector);
    })
EOT;

$css = <<<EOT
    ul[id^='lista_'] {
        min-height: 20px;
        height: 280px;
        overflow: scroll;
        padding-left: 20px;
        padding-right: 20px;
    }

    .contenedor_lista {
        box-shadow: 2px 2px 5px #999;
    }

    #form_create_tarjeta {
        display: none;
    }

EOT;
$this->registerJs($js);
$this->registerCss($css);
?>

<!-- Contenido de la Lista -->
<div class='col-md-6'>
    <div class='panel panel-default contenedor_lista'>
        <!-- Título de la lista -->
        <div class='panel-heading'>
            <div class='row'>
                <div class='col-md-9'>
                    <?= Html::encode($lista->denominacion) ?>
                </div>
                <div class='col-md-3'>
                    <?=
                        Html::button(
                            MyHelpers::icon('glyphicon glyphicon-plus'),
                            [
                                'class'=>'btn btn-xs btn-default',
                                'id' => "btn_form_tarjeta_$lista->id"
                            ]
                        )
                    ?>
                </div>
            </div>

        </div>

        <!-- Conjunto de tarjetas de la lista -->
        <div class='panel-body'>
            <ul id="lista_<?= $lista->id ?>"  data-key="<?= $lista->id ?>"
                    class='contenedor'>
                <?php foreach ($lista->getTarjetas()->orderBy(['created_at'=>SORT_DESC])->all() as $elem): ?>
                    <?= $this->render('_tarjeta_nueva', [
                        'tarjeta'=>$elem
                    ]) ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div id="form_create_tarjeta" class='panel-footer'>
            <?= $this->render('/tarjetas/create', [
                'model'=>$tarjeta,
                'lista'=>$lista,
            ]) ?>
        </div>
    </div>
</div>
