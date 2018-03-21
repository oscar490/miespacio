<?php

namespace app\controllers;

use app\models\ContactForm;
use app\models\EstablecerPasswordForm;
use app\models\LoginForm;
use app\models\SolicitarPasswordForm;
use app\models\DatosUsuarios;
use yii\db\Expression;
use app\models\Usuarios;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

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
     * Sube una imagen al servidor.
     * @return [type] [description]
     */
    public function actionUpload()
    {
        $model = new Usuarios();

        if (Yii::$app->request->isPost) {
            $model->imagen = UploadedFile::getInstance($model, 'imagen');
        }
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

            if ($usuario->token_acti === null) {
                $model->login();
                return $this->redirect(['equipos/gestionar-tableros']);
            }
            Yii::$app->session->setFlash(
                'error',
                'No puede iniciar sesión. Deberá activar su cuenta
                 accidiendo a su correo: ' . $usuario->email
            );
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionPrueba()
    {
        return $this->render('contenido-correo');
    }

    /**
     * Envía un correo con un enlace para cambiar
     * la contraseña. Mediante un formulario se indica
     * la dirección de correo al que mandar.
     * @return [type] [description]
     * @param null|mixed $email
     */
    public function actionSolicitarClave($email = null)
    {
        $model = new SolicitarPasswordForm([
            'email' => $email,
        ]);

        if ($email !== null && $model->validate()) {
            if ($model->enviarCorreo()) {
                $mensaje['info'] = 'Se ha enviado un correo electrónico a la dirección indicada.
                Realice el proceso indicado para establecer la contraseña.';

            } else {
                $mensaje['danger'] = 'No se ha podido enviar el correo electrónico
                a la dirección indicada.';

            }

            Yii::$app->session->setFlash(
                key($mensaje),
                $mensaje[key($mensaje)]
            );

        }

        return $this->render('gestionPassword', [
            'model' => $model,
            'accion' => $this->action->id,
        ]);
    }

    /**
     * Mediante un formulario, permite cambiar la contraseña.
     * Sólo permite cambiar la contraseña una vez.
     * @param  string $token Valor aleatorio del usuario.
     * @return [type]        [description]
     */
    public function actionEstablecerClave($token_clave = null)
    {

        $usuario = Usuarios::findOne(['token_clave' => $token_clave]);

        if ($usuario === null) {
            throw new NotFoundHttpException('Parámetro incorrecto');
        }
        $model = new EstablecerPasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $usuario->password = Yii::$app
                ->security->generatePasswordHash($model->password);
            $usuario->update_clave_at = new Expression('current_timestamp(0)');
            $usuario->save();

            Yii::$app->session->setFlash(
                'success',
                'Se ha establecido la nueva contraseña correctamente.'
            );

            return $this->redirect(['site/login']);
        }

        return $this->render('gestionPassword', [
            'model' => $model,
            'accion' => $this->action->id,
            'usuario'=>$usuario,
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
