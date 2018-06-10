<?php
/* Vista de secciones de la barra de navegación */

/* @var $datosUsuario app\models\DatosUsuarios */

use app\models\DatosUsuarios;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\components\MyHelpers;
use yii\helpers\Html;
use yii\web\View;



if (!Yii::$app->user->isGuest) {

$color = MyHelpers::establecer_color();

$css = <<<EOT
    .navbar-inverse {
        background-color: $color;
        border-color: $color;
    }

    .footer {
        background-color: $color;
    }

    .label-primary, .panel-heading {
        background-color: $color;
    }

    ul.breadcrumb li > a {
        color: $color;
    }

    #tablero, .panel-primary > .panel-heading {
        background-color: $color;
        border-color: $color;
    }

    .panel-primary {
        border-color: $color;
    }


EOT;

$this->registerCss($css);

$this->registerJsFile(
    'js/google_login.js'
);


}

if (Yii::$app->user->isGuest) {

    // Opciones para usuario invitado.
    $items_right[] =
        [
            //  Inicio de sesión.
            'label'=>MyHelpers::icon('glyphicon glyphicon-log-in')
                . ' ' . ' Iniciar sesión',
            'url'=>['site/login'],
            'encode'=>false,
        ];

    $items_right[] =
        [
            //  Registro de usuario.
            'label'=>Html::tag(
                'span',
                '',
                ['class'=>'glyphicon glyphicon-registration-mark ']
            ) . '  Registrarse',
            'url'=>['usuarios/create'],
            'encode'=>false,
        ];
} else {

    //  Opciones para usuario autenticado.
    //
    $items_left[] =
        [
            //  Búsqueda de tableros
            'label'=>MyHelpers::icon('glyphicon glyphicon-search')
                . ' Tableros',
            'encode'=>false,
            'linkOptions'=>[
                'data-toggle'=>'modal',
                'data-target'=>'#modal_tableros_search'
            ],
        ];

    $items_right[] =
        [
            //  Crear equipo nuevo.
            'label'=>MyHelpers::icon('glyphicon glyphicon-plus ')
                . ' Crear Equipo',

            'linkOptions'=>[
                'data-toggle'=>'modal',
                'data-target'=>'#modal_create_equipo'
            ],
            'encode'=>false,
        ];

    $items_right[] =
        [
            //  Mensajes.
            'label'=>MyHelpers::icon('glyphicon glyphicon-envelope')
                . ' Mensajes',
            'url'=>['mensajes/index'],
            'linkOptions'=>[
                'id'=>'index_mensajes'
            ],
            'encode'=>false,
        ];

    $items_right[] =
        [
            //  Notificaciones.
            'label'=>MyHelpers::icon('glyphicon glyphicon-bell '),

            'linkOptions'=>[
                'data-toggle'=>'modal',
                'data-target'=>'#modal_notificaciones'
            ],
            'encode'=>false,
        ];

    $items_left[] =
        [
            //  Estilo
            'label'=>MyHelpers::icon('glyphicon glyphicon-tint')
                . ' Estilo',
            'linkOptions'=>[
                'id'=>'ventana_estilos'
            ],

            'encode'=>false,
        ];


    $items_right[] =
        [
            //  Opciones sobre Usuario.
            'label'=>Html::img(
                'images/cargando.gif',
                ['class'=>'img-circle logo-nav']
            ),
            'items' => [

                //  Nombre de usuario.
                Html::tag(
                    'li',
                    $datosUsuario->nombre_completo
                    . ' ' . $datosUsuario->apellidos
                    . ' (' . Yii::$app->user->identity->nombre . ')',
                    ['class'=>'dropdown-header icono-x1']
                ),
                Html::tag(
                    'li',
                    '',
                    ['class'=>'divider']
                ),
                [

                    //  Perfil de usuario.
                    'label'=>Html::tag(
                        'span',
                        ' ',
                        ['class'=>'glyphicon glyphicon-list ']
                    ) . ' Perfil',
                    'url'=>['datos-usuarios/view'],
                    'encode'=>false,
                ],
                [

                    //  Cerrado de sesión.
                    'label'=>Html::tag(
                        'span',
                        ' ',
                        ['class'=>'glyphicon glyphicon-off ']
                    ) . ' Cerrar sesión',
                    'url'=>['site/logout'],
                    'linkOptions'=>[
                        'data-method'=>'POST',
                        'id'=>'cerrado_sesion',
                    ],
                    'encode'=>false,
                ],

            ],
            'encode'=>false,
            'linkOptions'=>[
                'id'=>'avatar_user'
            ]

        ];
}

NavBar::begin([
    //  Logotipo y nombre.
    'brandLabel' =>
        Html::tag(
            'p',
            Html::img(
                '/images/logotipo.png',
                [
                    'alt'=>'logotipo',
                    'class'=>'logo',
                ]
            ) .  ' ' . Yii::$app->name
        ),

    // URL de logotipo.
    'brandUrl' => ['equipos/gestionar-tableros'],
    'options' => [
        'class' => 'navbar-inverse navbar-fixed-top',
    ],

]);
echo Nav::widget([
    'options' => ['class' => 'navbar-nav navbar-right item-estilo'],
    'items'=>$items_right,
]);

if (isset($items_left)) {
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left item-estilo'],
        'items'=>$items_left,
    ]);
}


NavBar::end();

?>
