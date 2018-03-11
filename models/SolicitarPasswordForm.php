<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Usuarios;

/**
 * Modelo para gestionar el formulario de Recuperación de contraseña. En
 * dicho formulario se debe indicar el correo a donde se enviará las
 * instrucciones para cambiar la contraseña del usuario.
 */
class SolicitarPasswordForm extends Model
{
    /**
     * Dirección de correo.
     * @var string
     */
    public $email;

    /**
     * Reglas de validación.
     * @return [type] [description]
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
            [
                ['email'],
                'exist',
                'targetAttribute'=>['email', 'email'],
                'targetClass'=>Usuarios::className(),
                'message'=>'Ese correo no existe, no pertenece a ningun usuario.',
            ],
        ];
    }

    /**
     * Devuelve un enlace que redirecciona a otra
     * página para restablecer la contraseña.
     * @return [type] [description]
     */
    public function getEnlaceRecuperacion()
    {
        $token = Usuarios::findOne(['email' => $this->email])
            ->token_clave;

        return Html::a(
            'Haga click aqui para comenzar el proceso de recuperación de contraseña',
            Url::to(['site/establecer-clave', 'token_clave' => $token], true)
        );
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Correo electróńico',
        ];
    }

    /**
     * Redefinición del nombre del formulario.
     * @return string Nombre del formulario.
     */
    public function formName()
    {
        return '';
    }

    /**
     * Envia un correo a la dirección indicada
     * en el formulario para realizar la modificación
     * de la contraseña.
     * @return [type] [description]
     */
    public function enviarCorreo()
    {
        return Yii::$app->mailer->compose()
            ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
            ->setTo($this->email)
            ->setSubject('Recuperación de contraseña')
            ->setHtmlBody($this->enlaceRecuperacion)
            ->send();
    }
}
