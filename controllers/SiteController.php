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

    public function actionPrueba()
    {
        return $this->render('contenido-email');
    }

    /**
     * Envía un correo con un enlace para cambiar
     * la contraseña. MEdiante un formulario se indica
     * la dirección de correo al que mandar.
     * @return [type] [description]
     * @param null|mixed $email
     */
    public function actionCambiarClave($email = null)
    {
        $model = new RecuperarPasswordForm([
            'email' => $email,
        ]);

        if ($email !== null && $model->validate()) {
            if ($model->enviarCorreo()) {
                Yii::$app->session->setFlash(
                    'info',
                    'Se ha enviado un correo electrónico a la dirección indicada. Realice el proceso
                    indicado para establecer la contraseña.'
                );
            } else {
                Yii::$app->session->setFlash(
                    'danger',
                    'No se ha podido enviar el correo electrónico a la dirección indicada.'
                );
            }
        }

        return $this->render('gestionPassword', [
            'model' => $model,
            'accion' => $this->action->id,
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

            $usuario->token_clave = null;
            $usuario->save();
        }

        return $this->render('gestionPassword', [
            'model' => $model,
            'accion' => $this->action->id,
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
