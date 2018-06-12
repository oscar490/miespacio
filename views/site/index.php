<?php
/* Vista de página principal */

/* @var $this yii\web\View */

use kartik\tabs\TabsX;
use yii\helpers\Html;
use app\components\MyHelpers;



// $this->registerJs($js);
$this->title = Yii::$app->name;

$this->registerCssFile(
    'css/index.css'
);
?>

<div class="site-index">

    <!-- Cabecera -->
    <div class='row centrado'>

        <!-- MiEspacio -->
        <div id='content_logotipo' class='col-md-5 centrado'>
            <?=
                Html::img(
                    'images/logotipo.png',
                    ['class'=>'logo-index']
                )
            ?>
            <h1>
                <strong id='title_app'>
                    <?=
                        Html::encode($this->title)
                    ?>
                </strong>
            </h1>
        </div>
    </div>

    <!-- Característica -->
    <div class='row centrado'>
        <div class='col-md-7'>
            <h3 class='transition'>
                <strong>
                    MiEspacio es la manera gratuita , flexible y visual
                    de organizarlo todo con cualquiera.
                </strong>
            </h3>
        </div>
    </div>

    <!-- Ver de un solo vistazo -->
    <div class='row centrado'>
        <div id='content_texto' class='col-md-7'>
            <div class='panel panel-primary'>
                <div id='tareas_largas' class='panel-heading'>
                    <p>
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

    <!-- Enlaces de login y registro -->
    <div class='row centrado'>
        <div class='col-md-6 centrado'>
            <?= Html::a(
                '<strong>Regístrese. ¡Es gratis!</strong>',
                ['usuarios/create'],
                ['class'=>'btn btn-lg btn-success']
            ) ?>
        </div>
    </div>
    <br>
    <div class='row centrado'>
        <div class='col-md-6 centrado'>
            <?= Html::a(
                '<strong>Iniciar sesión</strong>',
                ['site/login'],
                ['class'=>'btn btn-lg btn-success']
            ) ?>
        </div>
    </div>
    <br>

    <!-- Cubo 3D -->
    <div class='row centrado'>
        <div class='hidden-xs col-md-6'>
            <div class='cubo'>
                <div class='cara' id='superior'>
                    <h3>
                        <strong>
                            Añade miembros a tus proyectos
                            para trabajar de forma colaborativa
                        </strong>
                    </h3>
                </div>
                <div class='cara' id='frente'>
                    <h3>
                        <strong>
                            Se adapta a su proyecto
                            de forma cómoda y eficiente
                        </strong>
                    </h3>
                </div>
                <div class='cara' id='derecha'></div>
                <div class='cara' id='izquierda'></div>
                <div class='cara' id='atras'></div>
                <div class='cara' id='inferior'>
                    <div id='texto' class='centrado'>
                        <h3>
                            <strong>
                                MiEspacio
                            </strong>
                        </h3>
                    </div>
                    <div class='centrado'>
                        <?=
                            Html::img(
                                'images/logotipo.png',
                                ['class'=>'logo-x2']
                            )
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class='row centrado'>
        <!-- Video -->
        <div class='col-md-6' >
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
                    <video  src="/videos/organizacion.mp4" controls autoplay="" loop="" muted></video>
                </div>
            </div>
        </div>
    </div>






</div>
