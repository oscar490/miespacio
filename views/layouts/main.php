<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\models\DatosUsuarios;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php
    $items[] = [

        'label'=>Html::tag(
            'span',
            ' ',
            ['class'=>'glyphicon glyphicon-home icono-x2']
        ) . ' Inicio',
        'url'=>['site/index'],
        'encode'=>false,

    ];
    $datosUsuario = DatosUsuarios::findOne([
        'usuario_id'=>Yii::$app->user->id,
    ]);

    if (Yii::$app->user->isGuest) {
        $items[] =
            [
                'label'=>Html::tag(
                    'span',
                    '',
                    ['class'=>'glyphicon glyphicon-log-in icono-x2']
                ) . '  Iniciar sesión',
                'url'=>['site/login'],
                'encode'=>false,
            ];
        $items[] =
            [
                'label'=>Html::tag(
                    'span',
                    '',
                    ['class'=>'glyphicon glyphicon-registration-mark icono-x2']
                ) . '  Registrarse',
                'url'=>['usuarios/create'],
                'encode'=>false,
            ];
    } else {
        $items[] =
            [
                'label'=> Html::tag(
                    'span',
                    ' ',
                    ['class'=>'glyphicon glyphicon-align-justify icono-x2']
                ) . ' Mis tableros',
                'url'=>['equipos/gestionar-tableros'],
                'encode'=>false,
            ];
        $items[] =
            [
                'label'=>Html::img(
                    'images/cargando.gif',
                    ['class'=>'img-circle logo-nav']
                ),
                'items' => [
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
                        'label'=>Html::tag(
                            'span',
                            ' ',
                            ['class'=>'glyphicon glyphicon-list icono-x2']
                        ) . ' Perfil',
                        'url'=>['datos-usuarios/view'],
                        'encode'=>false,
                    ],
                    [
                        'label'=>Html::tag(
                            'span',
                            ' ',
                            ['class'=>'glyphicon glyphicon-off icono-x2']
                        ) . ' Cerrar sesión',
                        'url'=>['site/logout'],
                        'linkOptions'=>['data-method'=>'POST'],
                        'encode'=>false,
                    ],

                ],
                'encode'=>false,

            ];


    }

?>

<div class="wrap">
    <?php
    NavBar::begin([
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
        'brandUrl' => ['equipos/gestionar-tableros'],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],

    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right item-estilo'],
        'items'=>$items,
    ]);
    NavBar::end();
    ?>

    <?php
        if (!Yii::$app->user->isGuest) {
            $img = $datosUsuario->url_imagen;
            $this->registerJs("
                $(document).ready(function() {
                    $('img.logo-nav').attr('src', '$img');
                })
            ");
        }
    ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; MiEspacio</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
