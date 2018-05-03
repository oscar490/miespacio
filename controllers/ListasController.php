<?php

namespace app\controllers;

use Yii;
use app\models\Listas;
use app\models\ListasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\Tarjetas;
use app\models\Adjuntos;
use app\models\Tableros;

/**
 * ListasController implements the CRUD actions for Listas model.
 */
class ListasController extends Controller
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
     * Lists all Listas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ListasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Listas model.
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
     * Creates a new Listas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionValidateAjax()
    {
        $model = new Listas();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

    }

    /**
     * Crea una nueva lista.
     * @return [type] [description]
     */
    public function actionCreate()
    {
        $model = new Listas();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return $this->renderAjax('/tableros/listas_tablero', [
                'model' => $model->tablero,
                'tarjeta' => new Tarjetas(),
                'adjunto' => new Adjuntos([
                    'scenario'=>Adjuntos::ESCENARIO_FILE
                ])
            ]);
        }

    }

    /**
     * Renderiza la vista de un tablero.
     * @param  [type] $id_tablero ID del tablero.
     * @return [type]             [description]
     */
    public function actionRenderListas($id_tablero)
    {
        return $this->renderAjax('/tableros/listas_tablero', [
            'model'=>Tableros::findOne($id_tablero),
            'tarjeta'=>new Tarjetas(),
            'adjunto'=>new Adjuntos([
                'scenario'=>Adjuntos::ESCENARIO_FILE
            ]),
        ]);
    }

    /**
     * Valida el formulario de modificación de la lista.
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

    /**
     * Modifica una lista mediante el uso de AJAX, renderiza
     * la vista completa de todas las listas del tablero.
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionUpdateAjax($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return $this->renderAjax('/tableros/listas_tablero', [
                'model'=>$model->tablero,
                'tarjeta'=>new Tarjetas(),
                'adjunto'=>new Adjuntos([
                    'scenario'=>Adjuntos::ESCENARIO_FILE
                ]),
            ]);
        }
    }

    /**
     * Deletes an existing Listas model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $tablero = $model->tablero;

        $model->delete();

        return $this->renderAjax('/tableros/listas_tablero', [
            'model'=>$tablero,
            'tarjeta'=>new Tarjetas(),
            'adjunto'=>new Adjuntos([
                'scenario'=>Adjuntos::ESCENARIO_FILE
            ]),
        ]);
    }

    /**
     * Finds the Listas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Listas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Listas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
