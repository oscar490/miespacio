<?php

namespace app\controllers;

use Yii;
use app\models\Tarjetas;
use app\models\TarjetasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\Adjuntos;

/**
 * TarjetasController implements the CRUD actions for Tarjetas model.
 */
class TarjetasController extends Controller
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
     * Lists all Tarjetas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TarjetasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tarjetas model.
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
     * Creates a new Tarjetas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tarjetas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->renderAjax('/tableros/vista_tarjetas', [
                'model'=>$model->lista,
            ]);
        }

    }

    public function actionValidateAjax()
    {
        $model = new Tarjetas();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * Updates an existing Tarjetas model.
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

        $model->load(Yii::$app->request->post());
        $model->save();

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionUpdateAjax($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->save();

            return $this->renderAjax('view', [
                'model'=>$model,
                'adjunto'=>new Adjuntos()
            ]);
        }
    }

    public function actionRenderUpdate($id)
    {
        $model = $this->findModel($id);

        return $this->renderAjax('update', [
            'model'=>$model,
        ]);
    }

    /**
     * Deletes an existing Tarjetas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $tablero = $this->findModel($id)->tablero;

        $this->findModel($id)->delete();

        return $this->redirect(['tableros/view', 'id'=>$tablero->id]);
    }

    /**
     * Finds the Tarjetas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tarjetas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tarjetas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
