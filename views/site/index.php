<?php

/* @var $this yii\web\View */
use kartik\tabs\TabsX;
use yii\helpers\Html;
use app\components\MyHelpers;



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
    <div class='row'>

    </div>

    <!-- Contenido de cabecera -->
    <div class='row centrado'>

        <div class='col-md-5 centrado'>
            <h1>
                <?=
                    Html::img(
                        'images/logotipo.png',
                        ['class'=>'logo-index']
                    )
                ?>
                <strong id='title_app'>
                    <?=
                        Html::encode($this->title)
                    ?>
                </strong>
            </h1>
        </div>
    </div>
    <div class='row centrado'>
        <div class='col-md-7'>
            <h3 align='center' class='transition'>
                <strong>
                    MiEspacio es la manera gratuita , flexible y visual
                    de organizarlo todo con cualquiera.
                </strong>
            </h3>
        </div>
    </div>
    <div class='row centrado'>
        <div id='content_texto' class='col-md-7'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    <p align='center'>
                        <strong>
                            Deje a un lado las largas cadenas de correos electrónicos,
                            las hojas de cálculos sin actualizar, las notas rápidas y el
                            software inadecuado para gestionar tus proyectos. MiEspacio le deja
                            ver todo sobre su proyecto de un solo vistazo.
                        </strong>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Cubo 3D -->
    <div class='row centrado'>
        <div class='hidden-xs col-md-6'>
            <div class='cubo'>
                <div class='cara' id='superior'>
                    <h3 align='center'>
                        <strong>
                            Añade miembros a tus proyectos
                            para trabajar de forma colaborativa
                        </strong>
                    </h3>
                </div>
                <div class='cara' id='frente'>
                    <h3 align='center'>
                        <strong>
                            Se adapta a su proyecto
                            de forma cómoda y eficiente
                        </strong>
                    </h3>
                </div>
                <div class='cara' id='derecha'></div>
                <div class='cara' id='izquierda'></div>
                <div class='cara' id='atras'></div>
                <div class='cara' id='inferior'></div>
            </div>
        </div>
    </div>

    <div class='row centrado'>
        <div class='col-md-5' >
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    <strong>
                        <?=
                            MyHelpers::icon('glyphicon glyphicon-play-circle')
                        ?>
                        &nbsp;
                        Método de organización
                    </strong>
                </div>

                <div class='panel-body'>
                    <video width="100%" src="/videos/organizacion.mp4" autoplay="" loop=""></video>
                </div>
            </div>
        </div>
    </div>






</div>
