<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\models\DatosUsuarios;
use app\components\MyHelpers;
use app\assets\AppAsset;
use yii\helpers\Url;

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
$datosUsuario = DatosUsuarios::findOne([
    'usuario_id'=>Yii::$app->user->id,
]);

?>

<div class="wrap">

    <!-- Secciones de la barra de navegación -->
    <?= $this->render('items_nav', [
        'datosUsuario'=>$datosUsuario
    ]) ?>


    <?php

        $this->registerJsFile(
            '/js/main.js',
            ['depends'=>[\yii\web\JqueryAsset::className()]]
        );


        if (!Yii::$app->user->isGuest) {
            $img = $datosUsuario->url_imagen;
            $num_notifi = Yii::$app->user->identity
                ->getNotificaciones()
                ->where(['view_at'=>null])
                ->count();

            $url_observar = Url::to([
                'notificaciones/observar',
                'id_usuario'=>Yii::$app->user->id
            ]);


            $this->registerJs("
                $(document).ready(function() {
                    $('img.logo-nav').attr('src', '$img');
                    indicarNotificaciones('$num_notifi', '$url_observar');
                    iniciarGestionVentanas(400, 400, 80);

                    establecerEstilo();
                })
            ");
        }


    ?>

    <!-- Ventanas modales -->
    <?= $this->render('modales_main');?>

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
