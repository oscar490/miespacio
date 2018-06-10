<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Usuarios;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 */
class LoginForm extends Model
{
    const ESCENARIO_GOOGLE_LOGIN = 'google_login';

    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required', 'on'=>'default'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            [
                ['username'],
                'required',
                'on'=>self::ESCENARIO_GOOGLE_LOGIN,
            ],

            [
                ['username'],
                'exist',
                'targetClass'=>Usuarios::className(),
                'targetAttribute'=>['username'=>'nombre'],
                'message'=>'No existe un usuario con ese nombre',

            ],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],

            ['username', 'validateCuenta'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Nombre de usuario o contraseña incorrecta');
            }
        }
    }

    /**
     * Valida si la cuenta del usuario está activada o no.
     * @param  string $attribute  El atributo que se está validando.
     * @param  array  $params     the additional name-value pairs given in the rule
     */
    public function validateCuenta($attribute, $params)
    {
        $usuario = Usuarios::findOne(['nombre'=>$this->username]);

        if (!$usuario->cuentaActivada) {
            $this->addError(
                $attribute,
                'No puede iniciar sesión, deberá activar su cuenta por correo: '
                . $usuario->email
            );
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]].
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = Usuarios::findOne(['nombre' => $this->username]);
        }

        return $this->_user;
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Nombre de usuario',
            'password' => 'Contraseña',
            'rememberMe' => 'Recordar sesión',
        ];
    }
}
