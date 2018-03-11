<?php

namespace app\models;

use yii\helpers\Html;
use yii\helpers\Url;
use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $nombre
 * @property string $password
 * @property string $email
 */
class Usuarios extends \yii\db\ActiveRecord implements IdentityInterface
{
    const ESCENARIO_CREATE = 'create';

    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['nombre', 'password', 'email', 'password_repeat'],
                'required',
                'on' => self::ESCENARIO_CREATE,
            ],
            [
                ['password_repeat'],
                'compare',
                'compareAttribute' => 'password',
                'on' => self::ESCENARIO_CREATE,
            ],
            [
                ['email'],
                'email',
                'on' => self::ESCENARIO_CREATE,
            ],
            [['nombre', 'password', 'email'], 'string', 'max' => 255],
            [
                ['nombre'],
                'unique',
                'message' => 'Ya existe un usuario con ese nombre.',
                'on' => self::ESCENARIO_CREATE,
            ],
            [
                ['email'],
                'unique',
                'message'=>'Ya existe un usuario con esa dirección de correo',
                'on'=>self::ESCENARIO_CREATE,
            ],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['password_repeat']);
    }

    
    /**
     * Devuelve un enlace para la validación por correo.
     * @return [type] [description]
     */
    public function getEnlaceValidacion()
    {
        return Html::a(
            'Haz click aquí para confirmar esta dirección de correo electrónico',
            Url::to(['usuarios/validar-correo', 'token' => $this->token], true)
        );
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'password' => 'Contraseña',
            'password_repeat' => 'Confirmar contraseña',
            'email' => 'Correo electrónico',
        ];
    }

    /**
     * Cifra la clave del usuario y se guarda ya cifrada en la base de
     * datos. También genera un token aleatorio para el usuario registrado.
     * Se realiza antes de insertar el usuario en la base de datos. También
     * genera token aleatorio para el cambio de contraseña.
     * @param  bool $insert Confirma si se va a realiar un insert o update.
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->password = \Yii::$app
                    ->security->generatePasswordHash($this->password);
                $this->token_acti = \Yii::$app
                    ->security->generateRandomString();
                $this->token_clave = \Yii::$app
                    ->security->generateRandomString();
            }
            return true;
        }
        return false;
    }

    /**
     * Envia un correo electrónico a una dirección.
     * @param  string $direccion Dirección de receptor
     *                           de correo electrónico.
     * @return [type]            [description]
     */
    public function enviarCorreo($direccion)
    {
        Yii::$app->mailer->compose('contenido-correo', [
                'token_acti'=>$this->token_acti
            ])
            ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
            ->setTo($direccion)
            ->setSubject(
                'Nueva direccíon de correo electrónico de ' . Yii::$app->name
            )
            ->send();
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }



    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($auth_key)
    {
        return $this->authKey === $auth_key;
    }

    /**
     * Validates password.
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return \Yii::$app->security->validatePassword($password, $this->password);
    }
}
