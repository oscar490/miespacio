<?php
/* Vista de Formulario con lista de selección de tipo de miembro */

/* @var $miembro app\models\Miembros; */
/* @var $tipos_miembros app\models\TiposMiembros */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$disable = $miembro->esPropietario;

?>

<?php $form = ActiveForm::begin() ?>

    <?= $form->field($miembro, 'tipo_id')->dropdownList([
            'Tipo de miembro'=>$tipos_miembros,

    ], ['disabled'=>$disable ])->label(false) ?>

<?php ActiveForm::end() ?>
