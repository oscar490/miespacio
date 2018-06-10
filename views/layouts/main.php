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
use yii\web\View;

AppAsset::register($this);

$datosUsuario = DatosUsuarios::findOne([
    'usuario_id'=>Yii::$app->user->id,
]);

$url_login_google = Url::to(['site/login-google']);
$js = <<<EOT
    var url_google = '$url_login_google';
EOT;

$this->registerJs($js, View::POS_HEAD);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta name="google-signin-client_id" content="298114253005-3cn3hadqmp0qig5ua3a5vjdkb37n9rbm.apps.googleusercontent.com">
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://apis.google.com/js/platform.js" async defer></script>


    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>


<body>
<?php $this->beginBody() ?>

<div class="wrap">

    <!-- Mensaje de confirmación de eliminación y alert -->
    <?= MyHelpers::dialogo(); ?>

    <!-- Secciones de la barra de navegación -->
    <?= $this->render('items_nav', [
        'datosUsuario'=>$datosUsuario
    ]) ?>

    <!-- Registro de código JavaScript -->
    <?= $this->render('register_js', [
        'datosUsuario'=>$datosUsuario,
    ]) ?>

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
