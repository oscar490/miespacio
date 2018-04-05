<?php

namespace app\models;

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\DatosUsuarios;
use yii\db\Expression;
use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id
 * @property string $nombre
 * @property string $password
 * @property string $email
 * @property string $token_acti
 * @property string $token_clave
 * @property string $auth_key
 *
 * @property DatosUsuarios[] $datosUsuarios
 * @property Equipos[] $equipos
 */
class Usuarios extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * Validación para el registro de nuevo usuario.
     * @var string
     */
    const ESCENARIO_CREATE = 'create';

    /**
     * Validación para el modificado del usuario.
     * @var string
     */
    const ESCENARIO_UPDATE = 'update';

    /**
     * Validación para el correo de envio para recuperación de password.
     * @var string
     */
    const ESCENARIO_CORREO_PASSWORD = 'correo-password';

    /**
     * Validación para establecer el password por recuperación.
     * @var string
     */
    const ESCENARIO_ESTABLECER_PASSWORD = 'establecer-password';

    /**
     * Constraseña a ingresar por segunda vez.
     * @var [type]
     */
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
                'on' => self::ESCENARIO_CREATE
            ],
            [
                ['password_repeat'],
                'compare',
                'compareAttribute' => 'password',
                'skipOnEmpty'=>false,
                'on' => [
                    self::ESCENARIO_CREATE,
                    self::ESCENARIO_UPDATE,
                    self::ESCENARIO_ESTABLECER_PASSWORD
                ]
            ],
            [
                ['email', 'nombre'],
                'required',
                'on'=>self::ESCENARIO_UPDATE,
            ],
            [
                ['email'],
                'email',
                'on' => [
                    self::ESCENARIO_CREATE,
                    self::ESCENARIO_UPDATE,
                    self::ESCENARIO_CORREO_PASSWORD,
                ]
            ],
            [
                ['email'],
                'required',
                'on'=>self::ESCENARIO_CORREO_PASSWORD,
            ],
            [
                ['email'],
                'exist',
                'targetAttribute'=>['email', 'email'],
                'targetClass'=>Usuarios::className(),
                'message'=>'Ese correo no existe, no pertenece a ningun usuario.',
                'on'=>self::ESCENARIO_CORREO_PASSWORD,
            ],
            [['nombre', 'password', 'email'], 'string', 'max' => 255],
            [
                ['nombre', 'email'],
                'unique',
                'message' => 'Ya existe un usuario con esa cuenta',
                'on' => self::ESCENARIO_CREATE,
            ],
            [
                ['password', 'password_repeat'],
                'required',
                'on'=>self::ESCENARIO_ESTABLECER_PASSWORD,
            ],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'password_repeat',
        ]);
    }

    /**
     * Modifica la contraseña del usuario y también la cifra.
     * @param [type] $password [description]
     */
    public function setPassword($password)
    {
        if ($password === '') {
            $this->password = $this->getOldAttribute('password');
        } else {
            $this->password = Yii::$app->security
                ->generatePasswordHash($password);
        }
    }


    public function formName()
    {
        return '';
    }

    /**
     * Devuelve true o false en caso de que la cuenta
     * del usuario esté activada.
     * @return [type] [description]
     */
    public function getCuentaActivada()
    {
        return $this->token_acti === null;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre de usuario',
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
                if ($this->isNewRecord || $this->scenario !== 'default') {
                    $this->setPassword($this->password);
                }

                if ($this->scenario === Usuarios::ESCENARIO_CREATE) {
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDatosUsuarios()
    {
        return $this->hasMany(DatosUsuarios::className(), ['usuario_id' => 'id'])->inverseOf('usuario');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipos()
    {
        return $this->hasMany(Equipos::className(), ['usuario_id' => 'id'])->inverseOf('usuario');
    }

    /**
     * Despues de registrarse el usuario, se añaden los datos del
     * usuario en la base de datos.
     * @param  boolean $insert true si se va a realizar un insert,
     *                         false en caso contrario.
     * @param  array   $changedAttributes valores antiguos antes de
     *                          guardar el modelo.
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            (new DatosUsuarios([
                'nombre_completo'=>mb_strtoupper($this->nombre),
                'url_imagen'=>'images/usuario.png',
                'usuario_id'=>$this->id,
            ]))->save();
        }

    }
}
