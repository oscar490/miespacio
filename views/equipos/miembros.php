<?php

use yii\helpers\Html;
use app\components\MyHelpers;

$this->registerCssFile(
    '/css/miembro.css'
);

?>
<br>
<div clas='row'>
    <div class='col-md-6 col-md-offset-3'>
        <div class='panel panel-primary'>
            <div class='panel-heading centrado'>
                <?=
                    MyHelpers::icon('glyphicon glyphicon-user')
                ?>
                &nbsp;
                <?=
                    Html::encode('Miembros del equipo')
                ?>
            </div>

            <div id='content_miembros' class='panel-body'>
                <?= $this->render('lista_miembros', [
                    'model'=>$model,
                    'miembros'=>$miembros,
                ]) ?>
            </div>
        </div>
    </div>
</div>
