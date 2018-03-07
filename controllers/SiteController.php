<?php

namespace app\controllers;

use app\models\ContactForm;
use app\models\EstablecerPasswordForm;
use app\models\LoginForm;
use app\models\RecuperarPasswordForm;
use app\models\Usuarios;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $usuario = Usuarios::findOne(['nombre' => $model->username]);

            if ($usuario->token === null) {
                $model->login();
                return $this->goBack();
            }
            Yii::$app->session->setFlash(
                'error',
                'No puede iniciar sesión. Deberá activar su cuenta accidiendo a su correo: ' . $usuario->email
            );
            return $this->redirect(['site/login']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Envía un correo con un enlace para cambiar
     * la contraseña.
     * @return [type] [description]
     * @param null|mixed $email
     */
    public function actionCambiarClave($email = null)
    {
        $model = new RecuperarPasswordForm([
            'email' => $email,
        ]);

        if ($email !== null && $model->validate()) {
            $model->enviarCorreo();
            Yii::$app->session->setFlash(
                'info',
                'Se ha enviador un correo electrónico a la dirección indicada. Realice el proceso
                indicado para establecer la contraseña.'
            );
        }

        return $this->render('cambiarPasswordCorreo', [
            'model' => $model,
        ]);
    }

    /**
     * Mediante un formulario, permite cambiar la contraseña.
     * @param  string $token Valor aleatorio del usuario.
     * @return [type]        [description]
     */
    public function actionEstablecerClave($token = null)
    {
        $model = new EstablecerPasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $usuario = Usuarios::findOne(['token_clave' => $token]);
            $usuario->password = Yii::$app
                ->security->generatePasswordHash($model->password);
            $usuario->save();
        }

        return $this->render('establecerPasswordUsuario.php', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
