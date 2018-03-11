<?php

namespace app\controllers;

use app\models\Usuarios;
use app\models\UsuariosSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

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
     * Creates a new Usuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Usuarios([
            'scenario' => Usuarios::ESCENARIO_CREATE,
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash(
                'info',
                'Confirme su dirección de correo electrónico: ' . $model->email
            );

            $model->enviarCorreo($model->email);
            return $this->redirect(['site/login']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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
                                  electrónico. Ya ha sido registrado anteriormente.';
        }

        Yii::$app->session->setFlash(
            key($mensaje),
            $mensaje[key($mensaje)]
        );

        return $this->redirect(['site/login']);
    }

    /**
     * Updates an existing Usuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
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
