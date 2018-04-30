<?php

namespace app\controllers;

use Yii;
use app\models\Adjuntos;
use app\models\AdjuntosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\web\UploadedFile;
use app\models\UploadFiles;
use app\models\Tarjetas;

/**
 * AdjuntosController implements the CRUD actions for Adjuntos model.
 */
class AdjuntosController extends Controller
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
     * Lists all Adjuntos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdjuntosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Adjuntos model.
     * @param integer $id
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
     * Creates a new Adjuntos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionValidateAjax()
    {
        $model = new Adjuntos();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

    }

    public function actionCreate()
    {
        $model = new Adjuntos();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return $this->renderAjax('/tarjetas/lista_adjuntos', [
                'model'=>$model->tarjeta,
            ]);
        }

    }

    public function actionUploadFile($id_tarjeta)
    {
        $model = new Adjuntos();
        $model->archivo = UploadedFile::getInstance($model, 'archivo');

        $upload = new UploadFiles();
        $upload->nombre_archivo = $model->archivo->name;
        $upload->archivo = $model->archivo;

        $model->nombre = $upload->nombre_archivo;
        $model->url_direccion = $upload->upload();
        $model->tarjeta_id = $id_tarjeta;

        $model->save();
        Yii::$app->response->format = Response::FORMAT_JSON;

        return $this->renderAjax('/tarjetas/lista_adjuntos', [
            'model'=>Tarjetas::findOne($id_tarjeta),
        ]);
    }

    /**
     * Updates an existing Adjuntos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

    }

    public function actionUpdateAjax($id)
    {
        $model = $this->findModel($id);

        $model->nombre = Yii::$app->request->post('nombre');
        $model->url_direccion = Yii::$app->request->post('url_direccion');
        $model->tarjeta_id = Yii::$app->request->post('tarjeta_id');

        if ($model->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->renderAjax('/tarjetas/lista_adjuntos', [
                'model'=>$model->tarjeta,
            ]);
        }
    }

    /**
     * Deletes an existing Adjuntos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return $this->findModel($id)->delete();
        }


    }

    /**
     * Finds the Adjuntos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Adjuntos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Adjuntos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
