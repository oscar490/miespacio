<?php

namespace app\controllers;

use Yii;
use app\models\DatosUsuarios;
use app\models\DatosUsuariosSearch;
use yii\web\Controller;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
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
     * Displays a single DatosUsuarios model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $datos = $this->findModel($id);
        $cuenta = Usuarios::findOne(['id'=>$datos->usuario_id]);
        $cuenta->scenario = Usuarios::ESCENARIO_UPDATE;
        $cuenta->password = '';

        if ($datos->load(Yii::$app->request->post()) && $datos->save()) {
            return $this->redirect(['view', 'id' =>$id]);
        }

        if ($cuenta->load(Yii::$app->request->post()) && $cuenta->save()) {
            return $this->redirect(['view', 'id' =>$id]);
        }

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
