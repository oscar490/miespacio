<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->registerJsFile(
    '/js/jquery-ui/jquery-ui.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '/js/sortable.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$url_update = Url::to(['tarjetas/update-lista']);

$js = <<<EOT
    $(document).ready(function() {
        efectoSortable('$url_update');
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

EOT;
$this->registerJs($js);
$this->registerCss($css);
?>

<div class='col-md-6'>
    <div class='panel panel-default contenedor_lista'>
        <div class='panel-heading'>
            <?= Html::encode($lista->denominacion) ?>
        </div>
        <div class='panel-body'>
            <ul id="lista_<?= $lista->id ?>"  data-key="<?= $lista->id ?>"
                    class='contenedor'>
                <?php foreach ($lista->getTarjetas()->orderBy(['created_at'=>SORT_DESC])->all() as $tarjeta): ?>
                    <?= $this->render('_tarjeta_nueva', [
                        'tarjeta'=>$tarjeta
                    ]) ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
