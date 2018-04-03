<?php
/* Datos de perfil de usuario y de cuenta */

/* @var $this yii\web\View */
/* @var $model app\models\DatosUsuarios */

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use app\components\MyHelpers;
use yii\helpers\Url;


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
    <div class='cabecera-flex-row'>
        <div class='cabecera-flex-column'>
            <!-- Imágen de perfil-->
            <?=
                Html::tag(
                    'h2',
                    Html::tag(
                        'span',
                        Html::tag(
                            'span',
                            '',
                            ['class'=>'glyphicon glyphicon-user']
                        ),
                        ['class'=>'label label-primary icono-x3']
                    )
                );
            ?>
            <br>
            <!-- Nombre completo y apellidos -->
            <?=
                Html::tag(
                    'h2',
                    $model->nombre_completo . ' ' .
                    $model->apellidos . ' ' .
                    Html::tag(
                        'small',
                        '(' . $model->usuario->nombre . ')'
                    )
                );
            ?>
            <br>
            <!-- Descripción -->
            <?=
                Html::tag(
                    'p',
                    $model->descripcion
                );
            ?>
        </div>
    </div>
</div>
<br>

<!-- Pestañas de selección -->
<?= MyHelpers::tabs($items) ?>
