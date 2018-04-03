<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Usuarios */

$this->title = 'Registrarse';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class='usuarios-create'>
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    <?=
                        Html::tag(
                            'h3',
                            Html::tag(
                                'span',
                                '',
                                ['class'=>'glyphicon glyphicon-registration-mark']
                            ) . ' ' .
                            Html::tag(
                                'strong',
                                $this->title
                            )
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
    </div>
</div>
