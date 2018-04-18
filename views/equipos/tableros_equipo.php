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

$this->registerCssFile(
    '/css/tablero.css'
);

$this->registerJsFile(
    '/js/tablero.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);
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
        <div class='panel panel-default'>
            <div id='tablero_create' class='panel-heading centrado'>
                <?php Modal::begin([
                    'toggleButton'=>[
                        'label'=>"Crear un nuevo tablero",
                        'class'=>'btn btn-md btn-info',
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
        </div>
    </div>
</div>
