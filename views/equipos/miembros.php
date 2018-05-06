<?php
/* Vista del contenido de miembros del equipo */

/* @var $miembros yii\data\ActiveDataProvider */
/* @var $model app\models\Equipos */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;

$this->registerCssFile(
    '/css/miembro.css'
);

$this->registerJsFile(
    '/js/miembros.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$num_miembros = $miembros->query->count();
$url_search = Url::to(['usuarios/search']);

$js = <<<EOT
    $(document).ready(function() {
        $('#btn_add_miembro').on('click', function() {
            let content = $("#form_search_user");
            let input_text = content.find('input');

            content.slideToggle();
            input_text.focus()

            addEventKey(input_text, '$url_search', '$model->id');
        })
    })
EOT;
$this->registerJs($js);
?>
<br>

<div class='row'>
    <div id='form_search_user' class='col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4'>
        <?= $this->render('form_agregar_miembro', [
            'usuario_search'=>$usuario_search,
        ])?>
    </div>
</div>

<!-- Panel de miembros del equipo -->
<div clas='row'>
    <div class='col-md-6 col-md-offset-3'>
        <div class='panel panel-primary'>

            <!-- Título -->
            <div class='panel-heading centrado'>
                <?=
                    MyHelpers::icon('glyphicon glyphicon-user')
                ?>
                &nbsp;
                <?=
                    Html::encode("Miembros del equipo ($num_miembros)");
                ?>
            </div>

            <!-- Lista de miembros del equipo -->
            <div id='content_miembros' class='panel-body content-scroll'>
                <?= $this->render('lista_miembros', [
                    'model'=>$model,
                    'miembros'=>$miembros,
                ]) ?>
            </div>

            <div class='panel-heading centrado'>
                <?=
                    Html::button(
                        MyHelpers::icon('glyphicon glyphicon-plus-sign')
                        . ' ' . 'Añadir miembro',
                        [
                            'class'=>'btn btn-md btn-info',
                            'id'=>'btn_add_miembro',
                        ]
                    );
                ?>
            </div>
        </div>
    </div>
</div>
