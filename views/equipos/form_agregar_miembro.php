<?php
/* Formulario para buscar y agregar un miembro */

/* @var $usuario_search app\models\UsuariosSearch */
/* @var $equipo app\models\Equipos */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin([
    'id'=>'search_user'
]) ?>

    <?=
        $form->field($usuario_search, 'nombre')
            ->textinput(['placeholder'=>'Buscar por nombre'])
            ->label(false)
    ?>

    <?= Html::hiddenInput('id_equipo', $equipo->id); ?>

<?php ActiveForm::end() ?>
