<?php

/* @ $token_acti app\models\Usuarios */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<?=
    Html::a(
        'Haga click aqui para comenzar el proceso de recuperación de contraseña',
        Url::to(['site/establecer-password', 'token_clave' => $usuario->token_clave], true)
    );
?>
