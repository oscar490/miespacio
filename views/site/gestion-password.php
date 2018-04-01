<?php
/* Restablecer constraseña del usuario por correo electrónico */

/* @var $model app\models\Usuarios */
/* @var $accion yii\base\Action */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Restablecer su contraseña';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class='row'>
    <div class='col-md-6 col-md-offset-3'>
        <div class='panel panel-primary'>
            <!-- Título de contenido -->
            <div class='panel-heading'>
                <?=
                    Html::tag(
                        'h4',
                        Html::tag(
                            'span',
                            '',
                            ['class'=>'glyphicon glyphicon-pencil']
                        ) . ' ' .
                        Html::tag(
                            'strong',
                            $this->title
                        )
                    )
                ?>
            </div>
            <div class='panel-body'>
                <!-- Contenido -->
                <?php if (isset($usuario) && $usuario->updatePassword): ?>
                    <?=
                        Html::tag(
                            'p',
                            'Parece que este enlace de restablecimiento de contraseña
                             ya no se puede utilizar. Significa que nos has enviado
                             otra solicitud de restablecimiento de contraseña'
                        );
                    ?>
                <?php else: ?>
                    <?= $this->render($accion, [
                        'model'=>$model,
                    ])?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
