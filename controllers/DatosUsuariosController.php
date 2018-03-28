<?php

namespace app\controllers;

use Yii;
use app\models\DatosUsuarios;
use app\models\DatosUsuariosSearch;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\Usuarios;

/**
 * DatosUsuariosController implements the CRUD actions for DatosUsuarios model.
 */
class DatosUsuariosController extends Controller
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
     * Lists all DatosUsuarios models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DatosUsuariosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra los datos de la cuenta y perfil del usuario. También
     * permite modificar los datos de la cuenta del usuario.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        $datos = $this->findModel(Yii::$app->user->id);
        $cuenta = Usuarios::findOne(['id'=>$datos->usuario_id]);
        $cuenta->scenario = Usuarios::ESCENARIO_UPDATE;

        if ($cuenta->load(Yii::$app->request->post()) && $cuenta->save()) {
            Yii::$app->session->setFlash(
                'success',
                'Se han modificado los datos de la cuenta correctamente'
            );
            return $this->redirect(['view']);
        }

        $cuenta->password = '';
        return $this->render('view', [
            'datos' => $datos,
            'cuenta'=>$cuenta,
        ]);
    }

    /**
     * Creates a new DatosUsuarios model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DatosUsuarios();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing DatosUsuarios model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
    */
    public function actionUpdate($id)
    {
        $datos = $this->findModel($id);

        if ($datos->load(Yii::$app->request->post())) {
            $datos->imagen = UploadedFile::getInstance($datos, 'imagen');

            $datos->save();
            $datos->upload();
            Yii::$app->session->setFlash(
                'success',
                'Se han modificado los datos de perfil correctamente'
            );
            return $this->redirect(['view']);
        }

        return $this->render('view', [
            'datos' => $datos,
        ]);
    }



    /**
     * Deletes an existing DatosUsuarios model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DatosUsuarios model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DatosUsuarios the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DatosUsuarios::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
