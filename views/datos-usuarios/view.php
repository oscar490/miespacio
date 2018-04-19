<?php
/* Datos de perfil de usuario y de cuenta */

/* @var $this yii\web\View */
/* @var $model app\models\DatosUsuarios */

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\components\MyHelpers;
use yii\helpers\Url;

$js = <<<EOT
    $(document).ready(function() {

        selector = $('.jumbotron > img');
        imagen = '$model->url_imagen';

        cambiarImagen(imagen, selector);
    })
EOT;

$this->registerJs($js);
$this->title = 'Perfil | MiEspacio';
$this->params['breadcrumbs'][] = $this->title;

$items = [
    [
        //  Modificación de datos de perfil.
        'label'=>"<span class='glyphicon glyphicon-edit'></span> Datos de perfil",
        'content'=>$this->render('update', [
            'model'=>$model,
        ]),
        'active'=>true,
    ],
    [
        //  Modificación de datos de cuenta.
        'label'=>"<span class='glyphicon glyphicon-user'></span> Datos de cuenta",
        'content'=>$this->render('/usuarios/update', [
            'model'=>$model->usuario,
        ]),
    ],
];
?>
<!-- Nombre de usuario e imagen de perfil -->
<div class="datos-usuarios-view">
    <div class='jumbotron'>
        <?=
            Html::img(
                'images/cargando.gif',
                ['class'=>'logo-x3 img-circle']
            );
        ?>
        <?=
            Html::tag(
                'h2',
                $model->nombre_completo . ' ' .
                $model->apellidos . ' ' .
                Html::tag(
                    'small',
                    ' (' . $model->usuario->nombre . ') '
                )
            );
        ?>
        <?=
            Html::tag(
                'span',
                $model->descripcion
            );
        ?>
    </div>

    <!-- Pestañas de selección -->
    <?= MyHelpers::tabs($items) ?>
</div>
