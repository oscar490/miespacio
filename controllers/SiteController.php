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
use Spatie\Dropbox\Exceptions\BadRequest;
use app\models\UploadForm;

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
        $model = new LoginForm();

        return $this->render('index', [
            'model'=>$model,
        ]);
    }

    /**
     * Envia un correo electrónico a la Dirección
     * de un usuario. Según si la cuenta del usuario está activada,
     * se envía el correo de activación o el de recuperación de
     * contraseña en caso de olvido.
     * @param  integer $id_user ID del Usuario.
     */
    public function actionSendEmail($id_user)
    {
        $usuario = Usuarios::findOne($id_user);

        if ($usuario->cuentaActivada) {
            $direccion = ['site/solicitar-password'];
            $vista_correo = 'recuperar-password';
            $asunto = 'Recuperación de contraseña de ';
        } else {
            $direccion = ['site/login'];
            $vista_correo = 'activacion-cuenta';
            $asunto = 'Activación de cuenta de ';
        }

        $send = Yii::$app->mailer->compose($vista_correo, [
                'usuario'=>$usuario,
            ])
            ->setFrom([Yii::$app->params['adminEmail'] => Yii::$app->name])
            ->setTo($usuario->email)
            ->setSubject($asunto . Yii::$app->name)
            ->send();

        if (!$send) {
            Yii::$app->session->setFlash(
                'danger',
                'No se ha podido enviar el correo electrónico a la dirección indicada.'
            );
        }

        return $this->redirect($direccion);
    }

    /**
     * Inicia la sesión de usuario. Se comprueba si tiene la cuenta
     * activada.
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

            if ($usuario->cuentaActivada) {
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

    /**
     * Envía un correo con un enlace para cambiar
     * la contraseña. Mediante un formulario se indica
     * la dirección de correo al que mandar.
     * @return [type] [description]
     * @param null|mixed $email Dirección de correo electrónico
     */
    public function actionSolicitarPassword($email = null)
    {
        $model = new Usuarios([
            'email'=>$email,
            'scenario'=>Usuarios::ESCENARIO_CORREO_PASSWORD,
        ]);

        if ($email !== null && $model->validate()) {
            $usuario = Usuarios::findOne(['email'=>$model->email]);

            Yii::$app->session->setFlash(
                'info',
                'Se ha enviado un correo electrónico a la dirección indicada.
                 Realice el proceso indicado para establecer la contraseña.'
            );
            return $this->redirect(['site/send-email', 'id_user'=>$usuario->id]);
        }

        return $this->render('gestion-password', [
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
    public function actionEstablecerPassword($token_clave = null)
    {
        if (($model = Usuarios::findOne(['token_clave' => $token_clave])) === null) {
            throw new NotFoundHttpException('Parámetro incorrecto');
        }

        $model->scenario = Usuarios::ESCENARIO_ESTABLECER_PASSWORD;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash(
                'success',
                'Se ha establecido la nueva contraseña correctamente.'
            );
            return $this->redirect(['site/login']);
        }
        
        $model->password = '';
        return $this->render('gestion-password', [
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
