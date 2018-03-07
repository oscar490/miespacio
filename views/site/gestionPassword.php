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


<?= $this->render($accion, [
    'model'=>$model,
    ])?>
