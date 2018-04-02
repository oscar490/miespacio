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
                <?= $this->render($accion, [
                    'model'=>$model,
                ])?>
            </div>
        </div>
    </div>
</div>
