<?php

/* @var $this yii\web\View */
use kartik\tabs\TabsX;
use yii\helpers\Html;



$js = <<<EOT
    $('.site-index').fadeIn('slow');
EOT;

// $this->registerJs($js);
$this->title = Yii::$app->name;

$this->registerCssFile(
    'css/index.css'
);
?>

<div class="site-index">


    <!-- Contenido de cabecera -->
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>

            <div class='cubo'>
                <div class='cara' id='superior'>
                    <div class='centrado'>
                        hola mundo
                    </div>
                </div>
                <div class='cara' id='frente'></div>
                <div class='cara' id='derecha'></div>
                <div class='cara' id='izquierda'></div>
                <div class='cara' id='atras'></div>
                <div class='cara' id='inferior'></div>
            </div>
        </div>
        <div class='col-md-5 col-md-offset-5'>
            <h1>
                <strong id='title_app'>
                    <?=
                        Html::encode($this->title)
                    ?>
                </strong>
            </h1>
        </div>
    </div>

</div>
