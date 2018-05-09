<?php

use yii\helpers\Html;
use app\components\MyHelpers;
use app\models\Equipos;


?>

<?php MyHelpers::modal_begin(
    'prueva',
    false,
    ['btn btn-success'],
    'modal_notificaciones'
) ?>
    <?= 'pepe' ?>
<?php MyHelpers::modal_end() ?>


<?php MyHelpers::modal_begin(
    '',
    false,
    '',
    'modal_create_equipo'
) ?>
    <?=
        $this->render('/equipos/create', [
            'equipo' => new Equipos(),
        ]);
    ?>

<?php MyHelpers::modal_end() ?>
