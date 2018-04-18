<?php
/* Vista de creación de un nuevo equipo */

/* @var $this yii\web\View */
/* @var $equipo app\models\Equipos */

use yii\helpers\Html;
use app\components\MyHelpers;

?>

<div class='col-md-4'>
    <div class='panel panel-default'>
        <div class='panel-heading centrado'>
            <?=
                Html::tag(
                    'p',
                    MyHelpers::icon('glyphicon glyphicon-plus')
                    . ' Crear un nuevo equipo'
                );
            ?>
        </div>
        <div class='panel-body'>
            <?=
                $this->render('_form', [
                    'equipo' => $equipo,
                    'action' => ['equipos/create'],
                    'label' => 'Crear',
                ]);
            ?>
            <hr>
            <p>
                Un equipo es un conjunto de tableros y
                personas. Utilícelo para organizar su
                empresa y sus planes.
            </p>
        </div>
    </div>
</div>
