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
        $('#btn_view_form').on('click', function() {
            let content = $("#form_search_user");
            let input_text = content.find('input#nombre');

            content.slideToggle();
            input_text.focus()

            addEventKey(input_text, '$url_search', '$model->id',
                $('#search_user'));
        })
    })
EOT;
$this->registerJs($js);
?>
<br>

<!-- Formulario de búsqueda de usuario -->
<div class='row'>
    <div id='form_search_user' class='col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-4'>
        <?= $this->render('form_agregar_miembro', [
            'usuario_search'=>$usuario_search,
            'equipo'=>$model,
        ])?>
    </div>
</div>

<!-- Panel de miembros del equipo -->
<div clas='row'>
    <div class='col-xs-12 col-md-6 col-md-offset-3'>
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

            <!-- Botón para mostrar formulario de búsqueda -->
            <div class='panel-heading centrado'>
                <?=
                    Html::button(
                        MyHelpers::icon('glyphicon glyphicon-search')
                        . ' ' . 'Buscar usuarios',
                        [
                            'class'=>'btn btn-md btn-info',
                            'id'=>'btn_view_form',
                        ]
                    );
                ?>
            </div>
        </div>
    </div>

    <!-- Descripción -->
    <div class='col-xs-12 col-md-6 col-md-offset-3'>
        <div id='panel_definicion'>
            Añade a otros usuarios a tu equipos y de esa manera ellos tendrán
            acceso a él y para trabajar de forma colaborativa contigo.
        </div>
    </div>
</div>
