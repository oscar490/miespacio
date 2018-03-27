<?php
/* Se muestran todos los tableros junto a su equipo correspondiente */

/* @var $tableros app\models\Tableros */
/* @var $equipo app\models\Equipos */
/* @var $tablero_crear app\models\Tableros */

use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use kartik\popover\PopoverX;
use yii\bootstrap\Modal;
use yii\widgets\ActiveForm;
use yii\helpers\Html;


?>
<br>
<!-- Tableros pertenecientes al equipo -->
<?php if (!empty($tableros->query->all())): ?>
    <div class='row'>
        <?= ListView::widget([
            'dataProvider'=>$tableros,
            'itemView'=>'_tablero',
            'summary'=>'',
        ]) ?>
    </div>
<?php endif; ?>

<!-- Formulario para crear tableros en un equipo -->
<?php Modal::begin([
    'header'=>"<h4>Crear un nuevo tablero en $equipo->denominacion</h4>",
    'toggleButton'=>[
        'label'=>"<span class='glyphicon glyphicon-plus'></span>
                  Crear un nuevo tablero",
        'class'=>'btn-md btn-success',
    ],
    'size'=>Modal::SIZE_SMALL,
]) ?>

    <?php $form = ActiveForm::begin([
        'action'=>[
            'equipos/gestionar-tableros',
            'id_equipo'=>$equipo->id,
        ],
        'enableAjaxValidation' => true,
    ]) ?>

        <?= $form->field($tablero_crear, 'denominacion', [
            'enableAjaxValidation' => true
            ])->textInput(['placeholder'=>'Añadir título del tablero',])
                ->label(false)
        ?>

        <?=
            Html::submitButton(
                'Crear tablero',
                ['class'=>'btn-xs btn-success',]
            )
        ?>

    <?php ActiveForm::end() ?>

<?php Modal::end() ?>
