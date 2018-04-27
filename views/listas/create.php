<?php
/* Creación de una Lista */
use yii\helpers\Html;
use app\components\MyHelpers;

/* @var $this yii\web\View */
/* @var $model app\models\Listas */

?>

<div class='panel panel-default'>
    <div id='header_menu' class='panel-heading'>
        <?=
            MyHelpers::icon('glyphicon glyphicon-plus') . ' ' .
            Html::encode('Crear lista ');
        ?>
        <small>(click aquí)</small>
    </div>
    <div class='panel-body'>
        <?= $this->render('_form', [
            'model' => $lista,
            'tablero' => $tablero,
            'label'=>'Crear'
        ]) ?>
    </div>
</div>
