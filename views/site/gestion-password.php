<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Restablecer su contraseña de MiEspacio';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='row'>
    <div class='col-md-6 col-md-offset-3'>
        <h2>
            <strong>
                <?= Html::encode($this->title) ?>
            </strong>
        </h2>
    </div>
</div>

<?php if (isset($usuario) && $usuario->update_clave_at !== null): ?>
    <br>
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <?=
                Html::tag(
                    'p',
                    'Parece que este enlace de restablecimiento de contraseña
                     ya no se puede utilizar. Significa que nos has enviado
                     otra solicitud de restablecimiento de contraseña'
                );
            ?>
        </div>
    </div>
<?php else: ?>
    <?= $this->render($accion, [
        'model'=>$model,
    ])?>
<?php endif; ?>
