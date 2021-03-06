<?php
/* Vista del contenido del equipo */

/* @var $this yii\web\View */
/* @var $model app\models\Equipos */
/* @var $tableros yii\data\ActiveDataProvider */
/* @var $tablero_crear app\models\Tableros */
/* @var $miembros yii\data\ActiveDataProvider */
/* @var $usuario_search app\models\UsuariosSearch */


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

?>

<!-- Propiedades. Nombre del equipo e imagen -->
<div class='container'>
    <?= $this->render('propiedades', [
        'model'=>$model
    ]) ?>
</div>
<br>

<!-- Secciones del navegador de opciones -->
<?= $this->render('secciones', [
    'model'=>$model,
    'tableros'=>$tableros,
    'tablero_crear'=>$tablero_crear,
    'miembros'=>$miembros,
    'usuario_search'=>$usuario_search,
]) ?>
