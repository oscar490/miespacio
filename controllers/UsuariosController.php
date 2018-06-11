<?php
/**
 * Implementación de acciones sobre el Usuario.
 */
namespace app\controllers;

use Yii;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\db\Expression;
use app\models\DatosUsuarios;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\Equipos;
use app\models\Email;

/**
 * UsuariosController implements the CRUD actions for Usuarios model.
 */
class UsuariosController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Usuarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsuariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Usuarios model.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Crea un nuevo usuario. Si se ha creado correctamente, redirecciona
     * a la página de login y se envía al usuario un correo de activación
     * de cuenta.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new Usuarios([
            'scenario' => Usuarios::ESCENARIO_CREATE,
        ]);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash(
                'info',
                'Confirme su dirección de correo electrónico: ' . $model->email
            );

            (new Email([
                'asunto'=>'Activación de cuenta',
                'direccion'=>$model->email,
                'contenido'=>'activacion-cuenta',
                'options_view'=>['usuario'=>$model]
            ]))->send();

            return $this->redirect(['site/login']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
    * Updates an existing Usuarios model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id
    * @return mixed
    * @throws NotFoundHttpException if the model cannot be found
    */
   public function actionUpdate($id)
   {
       $model = $this->findModel($id);
       $model->scenario = Usuarios::ESCENARIO_UPDATE;

       if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
           Yii::$app->response->format = Response::FORMAT_JSON;
           return ActiveForm::validate($model);
        }

       if ($model->load(Yii::$app->request->post()) && $model->save()) {
           Yii::$app->session->setFlash(
               'success',
               'Se han modificado los datos de la cuenta correctamente'
           );
           return $this->redirect(['datos-usuarios/view']);
       }
   }

    /**
     * Se encarga de validar el correo electrónico del usuario.
     * Compruba si ya se ha validado anteriormente, notificando
     * con un mensaje en caso de que si.
     * @param  [type] $token_acti Valores aleatorios que pertenecen
     *                            al usuario que se registra.
     * @return redirect           Redirección al formulario de inicio
     *                            de sesión.
     */
    public function actionValidarCorreo($token_acti)
    {
        if (($usuario = Usuarios::findOne(['token_acti'=>$token_acti])) !== null) {
            $usuario->token_acti = null;
            $usuario->save();

            $mensaje['success'] = 'Dirección de correo electrónico confirmada
                                   con éxito, ya puede iniciar sesión.';
        } else {
            $mensaje['danger'] = 'No se puede confirmar la dirección de correo
                                  electrónico. Ya ha sido confirmado anteriormente.';
        }

        Yii::$app->session->setFlash(
            key($mensaje),
            $mensaje[key($mensaje)]
        );

        return $this->redirect(['site/login']);
    }

    /**
     * Realiza la búsqueda de un usuario.
     * @param  integer $id_equipo ID del equipo.
     * @return [type]            Renderización de la lista de
     *                           miembros del equipo.
     */
    public function actionSearch($id_equipo)
    {
        $searchModel = new UsuariosSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->renderAjax('/equipos/lista_miembros', [
            'miembros'=>$dataProvider,
            'model'=>Equipos::findOne($id_equipo),
        ]);
    }


    /**
     * Deletes an existing Usuarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Usuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Usuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Usuarios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
