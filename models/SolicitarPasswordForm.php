<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\Url;

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
            [['email'], 'comprobarExistencia'],
        ];
    }

    /**
     * Comprueba si el correo que se envia al servidor, para
     * realizar la operación de restablecer contraseña, existe.
     * @param  string $attribute Atributo que se valida
     * @param  [type] $params    [description]
     * @param  [type] $validator Validador
     * @return [type]            [description]
     */
    public function comprobarExistencia($attribute, $params, $validator)
    {
        $usuario = Usuarios::find()
            ->where(['email' => $this->$attribute])->one();

        if ($usuario === null) {
            $this->addError($attribute, 'Ese correo no existe, no pertenece a ningun usuario.');
        }
    }

    /**
     * Devuelve un enlace que redirecciona a otra
     * página para restablecer la contraseña.
     * @return [type] [description]
     */
    public function getEnlaceRecuperacion()
    {
        $token_email = Usuarios::findOne(['email' => $this->email])
            ->token_clave;

        return Html::a(
            'Haga click aqui para comenzar el proceso de recuperación de contraseña',
            Url::to(['site/establecer-clave', 'token' => $token_email], true)
        );
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Correo electróńico',
        ];
    }

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
            ->setFrom(\Yii::$app->params['adminEmail'])
            ->setTo($this->email)
            ->setSubject('Recuperación de contraseña')
            ->setHtmlBody($this->enlaceRecuperacion)
            ->send();
    }
}
