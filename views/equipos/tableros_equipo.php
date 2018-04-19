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
        <div class='panael-heading centrado create'>
            <?php Modal::begin([
                'toggleButton'=>[
                    'label'=>"Crear un nuevo tablero",
                    'class'=>'btn btn-lg btn-default',
                ],
                'size'=>Modal::SIZE_SMALL,
            ]) ?>

                <?= $this->render('/tableros/_form', [
                    'tablero'=>$tablero_crear,
                    'equipo'=>$equipo,
                ]) ?>
            <?php Modal::end() ?>
        </div>
    </div>
</div>
