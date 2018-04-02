<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = 'Datos de cuenta';
?>
<div class="usuarios-update">

    <div class='panel panel-primary'>
        <div class='panel-heading'>
            <?=
                Html::tag(
                    'h4',
                    Html::tag(
                        'span',
                        '',
                        ['class'=>'glyphicon glyphicon-edit']
                    ) . ' ' . $this->title
                );
            ?>
        </div>
        <div class='panel-body'>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
