<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Restablecer su contraseña de MiEspacio';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='row'>
    <div class='col-md-6 col-md-offset-3'>
        <h1>
            <strong>
                <?= Html::encode($this->title) ?>
            </strong>
        </h1>
        <?=
            Html::tag(
                'p',
                'Envíe su dirección de correo electrónico y le reenviaremos
                 un enlace para restablecer su contraseña'
            );
        ?>
    </div>
</div>
<br>
<?php $form = ActiveForm::begin([
    'method'=>'get',
]) ?>

    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <?= $form->field($model, 'email') ?>
        </div>
    </div>

    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <?= Html::submitButton('Enviar', ['class'=>'btn btn-success']) ?>
        </div>
    </div>


<?php ActiveForm::end() ?>
