<?php
/* Creación de una Lista */
use yii\helpers\Html;
use app\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Listas */

?>

<div class='panel panel-default'>
    <div id='header_menu' class='panel-heading'>
        <strong>
            <?=
                MyHelpers::icon('glyphicon glyphicon-plus') . ' ' .
                Html::encode('Crear lista ');
            ?>
        </strong>

    </div>
    <div class='panel-body'>
        <?= $this->render('_form', [
            'model' => $lista,
            'tablero' => $tablero,
            'action'=>['listas/validate-ajax'],
            'label'=>'Crear',
            'id_form_lista'=>'form_lista'
        ]) ?>
    </div>
</div>
