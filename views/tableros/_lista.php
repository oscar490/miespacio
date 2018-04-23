<?php
/* Vista parcial de una lista */

/* $model app\models\Listas */
/* $tarjeta app\models\Tarjetas */

use yii\helpers\Html;
use app\components\MyHelpers;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use yii\helpers\Url;

$this->registerCssFile(
    '/css/lista.css'
);


$js = <<<EOT
    $(document).ready(function() {
        $("div#titulo_lista_$model->id").on('click', function() {
            $(this).parent().find('#form_create').slideToggle();
        });
    })
EOT;

$this->registerJs($js);

?>

<div class='panel panel-default'>
    <!-- Título de la lista-->
    <?=
        Html::tag(
            'div',
            MyHelpers::icon('glyphicon glyphicon-th-list') .
            ' ' . Html::encode($model->denominacion) . ' ' .
            Html::tag(
                'small',
                '(click aquí para crear una nueva tarjeta)'
            ),
            [
                'class'=>'panel-heading',
                'id' => "titulo_lista_$model->id"
            ]
        )
    ?>
    <!-- Tarjetas de la lista -->
    <div class='panel-body contenido_lista'>
        <div class='row'>
            <?= $this->render('vista_tarjetas', [
                'model'=>$model
            ]) ?>
        </div>
    </div>

    <div id='form_create' class='panel-footer'>
        <?= $this->render('/tarjetas/create', [
            'model'=>$tarjeta,
            'lista'=>$model,
        ]) ?>
    </div>
</div>
