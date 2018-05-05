<?php
/* Vista del contenido del equipo */

/* @var $this yii\web\View */
/* @var $model app\models\Equipos */
/* @var $tableros app\models\Tableros */
/* @var $tablero_crear app\models\Tableros */
/* @var $miembros yii\data\ActiveDataProvider */

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\MyHelpers;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;

//  Migas de pan.
$this->title = $model->denominacion;
$this->params['breadcrumbs'][] = [
    'label' => 'Tableros | MiEspacio',
    'url' => ['equipos/gestionar-tableros']
];
$this->params['breadcrumbs'][] = $this->title;

//  JavaScript.
$this->registerJsFile(
    '/js/equipo.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

//  Css.
$this->registerCssFile(
    '/css/equipo.css'
);

$js = <<<EOT
    $(document).ready(function() {
        selector = $('#img_equipo img');
        imagen = '$model->url_imagen';

        cambiarImagen(imagen, selector);
    })
EOT;

$this->registerJs($js);

?>

<!-- Propiedades. Nombre del equipo e imagen -->
<div class='container'>
    <?= $this->render('propiedades', [
        'model'=>$model
    ]) ?>
</div>
<br>

<!-- Secciones de opciones -->
<?= $this->render('secciones', [
    'model'=>$model,
    'tableros'=>$tableros,
    'tablero_crear'=>$tablero_crear,
    'miembros'=>$miembros
]) ?>
