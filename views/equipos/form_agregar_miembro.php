<?php
/* Formulario para buscar y agregar un miembro */

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

<?php ActiveForm::end() ?>
