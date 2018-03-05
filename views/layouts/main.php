<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
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
    $items = [];

    if (Yii::$app->user->isGuest) {
        $items = [
            [
                'label'=>Html::tag(
                    'span',
                    ' ',
                    ['class'=>'glyphicon glyphicon-user icono-x2']
                ) . ' Iniciar sesión',
                'url'=>['site/login'],
                'encode'=>false,
            ],
            [
                'label'=>Html::tag(
                    'span',
                    ' ',
                    ['class'=>'glyphicon glyphicon-log-in icono-x2']
                ) . ' Registrarse',
                'url'=>['usuarios/create'],
                'encode'=>false,
            ]
        ];
    } else {
        $items = [
            [
                'label'=>'Inicio',
                'url'=>['site/index'],
            ],
            [
                'label'=>\Yii::$app->user->identity->nombre,
                'url'=>['site/logout'],
                'linkOptions'=>['data-method'=>'POST'],
            ]
        ];
    }
?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<p><img src="/images/logotipo.png" alt="Logo" title="Logo" class="logo" />MiEspacio</p>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top nav-estilo',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right item-estilo'],
        'items'=>$items,
    ]);
    NavBar::end();
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
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
