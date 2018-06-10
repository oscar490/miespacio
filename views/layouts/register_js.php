<?php
/* Proceso de iteraciones con JavaScript */

use yii\helpers\Url;

$this->registerJsFile(
    '/js/main.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '/js/jquery.cookie.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '/js/google_login.js'
);




if (!Yii::$app->user->isGuest) {
    $img = $datosUsuario->url_imagen;
    $num_notifi = Yii::$app->user->identity
        ->getNotificaciones()
        ->where([
            'view_at'=>null,
            'tablero_id'=>null,
        ])
        ->count();

    $num_mensajes_nuevos = Yii::$app->user->identity
        ->getMensajes0()
        ->where(['view_at'=>null])
        ->count();

    $url_observar = Url::to([
        'notificaciones/observar',
        'id_usuario'=>Yii::$app->user->id
    ]);

    $user_name = Yii::$app->user->identity->nombre;

    $this->registerJs("
        $(document).ready(function() {
            $('img.logo-nav').attr('src', '$img');

            indicarNotificaciones('$num_notifi', '$url_observar');
            iniciarGestionVentanas(400, 400, 80, '$user_name');
            indicarMensajes('$num_mensajes_nuevos');

        })
    ");
}
?>
