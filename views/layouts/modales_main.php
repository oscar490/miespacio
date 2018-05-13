<?php
/* Renderizado de modaldes */

use yii\helpers\Html;
use app\components\MyHelpers;
use app\models\Equipos;
use app\models\Usuarios;
use app\models\TablerosSearch;

$css = <<<EOT
    #modal_notificaciones > .modal-dialog {

    }
EOT;

$this->registerCss($css);

?>



<?php if (!Yii::$app->user->isGuest): ?>
    <!-- Modal de Notificaciones de Usuario -->
    <?php
        MyHelpers::modal_begin(
            MyHelpers::icon('glyphicon glyphicon-bell')
                . ' <strong>Notificaciones</strong>',
                false,
                ['btn btn-success'],
                'modal_notificaciones'
        );
    ?>
        <?= $this->render('/notificaciones/view', [
            'notificaciones'=>Usuarios::findOne(Yii::$app->user->id)
                ->getNotificaciones()

        ]) ?>

    <?php MyHelpers::modal_end() ?>
<?php endif; ?>



<!-- Modal de creación de nuevo equipo -->
<?php
    MyHelpers::modal_begin(
        '',
        false,
        '',
        'modal_create_equipo'
    )
?>
    <?=
        $this->render('/equipos/create', [
            'equipo' => new Equipos(),
        ]);
    ?>

<?php MyHelpers::modal_end() ?>

<?php
    MyHelpers::modal_begin(
        '',
        false,
        '',
        'modal_tableros_search'
    )
?>
    <?=
        $this->render('/tableros/search_tablero', [
            'search'=> new TablerosSearch(),
        ])
    ?>
<?php MyHelpers::modal_end() ?>
