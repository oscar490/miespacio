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
<div class='row'>
    <?php if (!empty($tableros->query->all())): ?>
        <?= ListView::widget([
            'dataProvider'=>$tableros,
            'itemView'=>'_tablero',
            'summary'=>'',
        ]) ?>
    <?php endif; ?>

    <!-- Formulario para crear tableros en un equipo -->
    <div class='col-md-3'>
        <div class='panel panel-primary'>
            <div class='panel-heading'>
                <?php Modal::begin([
                    'toggleButton'=>[
                        'label'=>"<span class='glyphicon glyphicon-plus'></span>
                                  Crear un nuevo tablero",
                        'class'=>'btn-md btn-info',
                    ],
                    'size'=>Modal::SIZE_SMALL,
                ]) ?>

                    <?= $this->render('/tableros/_form', [
                        'tablero'=>$tablero_crear,
                        'equipo'=>$equipo,
                    ]) ?>
                <?php Modal::end() ?>
                <br>
            </div>
            <div class='panel-body'>
            </div>
        </div>
    </div>
</div>

&nbsp;

<!-- Enlace a los tableros del equipo actual -->
<?=
    Html::a(
        "<span class='glyphicon glyphicon-menu-hamburger'></span> Tableros",
        ['equipos/view', 'id'=>$equipo->id],
        ['class'=>'btn btn-info']
    )
?>
