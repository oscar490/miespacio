<?php


$this->registerJsFile(
    '/js/jquery-ui/jquery-ui.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$js = <<<EOT
    $(function() {
        $('#lista1, #lista2').sortable({
            connectWith: ".contenedor",
        })
    });
EOT;

$css = <<<EOT
    li {
        border: solid 2px black;
        list-style: none;
    }

    #lista1, #lista2 {
        min-height: 20px;
    }
EOT;

$this->registerJs($js);
$this->registerCss($css);
?>

<ul id='lista1' class='contenedor'>
    <li>pepe</li>
    <li>manolo</li>
    <li>carlos</li>
    <li>roberto</li>
</ul>
<hr>

<ul id='lista2' class='contenedor'>
    <li>coche</li>
    <li>moto</li>
    <li>camion</li>
</ul>
