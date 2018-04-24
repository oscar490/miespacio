<?php
use yii\helpers\Html;

$this->registerJsFile(
    '/js/jquery-ui/jquery-ui.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$js = <<<EOT
    $(document).ready(function() {
        $("ul[id^='lista_']").sortable({
            connectWith: ".contenedor",
            receive: function (event, ui) {
                console.log('listo');
            }

        })
    })
EOT;

$css = <<<EOT

EOT;
$this->registerJs($js);
$this->registerCss($css);
?>

<div class='panel panel-default'>
    <div class='panel-heading'>
        <?= Html::encode($lista->denominacion) ?>
    </div>
    <div class='panel-body'>
        <ul id="lista_<?= $lista->id ?>" class='contenedor'>
            <?php foreach ($lista->getTarjetas()->all() as $tarjeta): ?>
                <?= $this->render('_tarjeta_nueva', [
                    'tarjeta'=>$tarjeta
                ]) ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
