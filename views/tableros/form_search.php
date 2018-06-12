<?php
/* Vista de formulario de búsqueda de tableros */

/* @var $search app\models\TablerosSearch */
use yii\widgets\ActiveForm;


?>

<?php $form = ActiveForm::begin([
    'id'=>'search_tablero'
]) ?>

    <?=
        $form->field($search, 'denominacion')->textinput([
            'placeholder'=>'Buscar tableros por nombre...'
        ])->label('Nombre a búscar: ');
    ?>

<?php ActiveForm::end() ?>
