<?php
/* Se muestra los equios y los tableros que pertenecen a cada equipo. */
/* Se permite crear nuevos equipos. */

/* @var $this yii\web\View */
/* @var $equipos yii\data\ActiveDataProvider */
/* @var $equipo_crear app\models\Equipos */
/* @var $tablero_crear app\models\Tableros */

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use kartik\popover\PopoverX;

$this->title = 'Tableros | MiEspacio';
$this->params['breadcrumbs'][] = $this->title;

?>
<!-- Listado de los equipos creados por el usuario -->
<div class="equipos-index">
    <?= ListView::widget([
        'dataProvider'=>$equipos,
        'itemView'=>'_equipo',
        'viewParams'=>[
            'tablero_crear'=>$tablero_crear,
        ],
        'summary'=>'',
    ])?>
</div>

<!-- Formulario para crear un nuevo equipo -->
<?php PopoverX::begin([
    'toggleButton'=>[
        'label'=>'Crear un nuevo equipo',
        'class'=>'btn btn-info'
    ],
    'placement' => PopoverX::ALIGN_TOP,
    'type' => PopoverX::TYPE_INFO,
    'header'=>'Crear un nuevo equipo',

]) ?>
        <?php $form = ActiveForm::begin([
            'action'=>['equipos/create'],
            'enableAjaxValidation' => true,
            'id'=>'form-crear-equipo',
        ]) ?>
            <!-- Nombre del equipo. -->
            <?= $form->field($equipo_crear, 'denominacion', ['enableAjaxValidation' => true]) ?>

            <!-- Descripción del equipo. -->
            <?= $form->field($equipo_crear, 'descripcion')->textarea([
                'row'=>5,
            ]) ?>

            <!-- Botón de envio de formulario -->
            <?= Html::submitButton('Crear equipo', ['class'=>'btn btn-success btn-block'])?>

        <?php ActiveForm::end() ?>

<?php PopoverX::end() ?>
