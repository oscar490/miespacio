<?php

namespace app\controllers;

use Yii;
use app\models\Tableros;
use app\models\Equipos;
use app\models\Tarjetas;
use app\models\Listas;
use app\models\Adjuntos;
use app\models\TablerosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\web\Response;

/**
 * TablerosController implements the CRUD actions for Tableros model.
 */
class TablerosController extends Controller
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
     * Lists all Tableros models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TablerosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra el contenido de un tablero.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $equipos = Equipos::find()
            ->select(['denominacion'])
            ->indexBy('id')
            ->column();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'equipos'=>$equipos,
            'tarjeta' => new Tarjetas(),
            'lista' => new Listas(),
            'adjunto'=>new Adjuntos([
                'scenario'=>Adjuntos::ESCENARIO_FILE,
            ]),
        ]);
    }

    /**
     * Renderiza el contenido de un tablero.
     * @param  int $id ID del tablero.
     * @return [type]     [description]
     */
    public function actionRenderContenido($id)
    {
        $model = $this->findModel($id);

        return $this->renderAjax('listas_tablero', [
            'model'=>$model,
            'tarjeta' => new Tarjetas(),
            'adjunto'=>new Adjuntos(),
        ]);
    }

    /**
     * Renderiza una vista de los tableros de un equipo.
     * pertenecen a un equipo.
     * @param  integer $id_equipo Identificador del equipo.
     * @return [type]            [description]
     */
    public function actionDevolverTableros($id_equipo)
    {
        $tableros = Tableros::find()
            ->where(['equipo_id'=>$id_equipo]);

        return $this->renderAjax('tableros_lista', [
            'tableros'=>$tableros,
        ]);
    }

    /**
     * Creates a new Tableros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tableros();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

    }

    /**
     * Updates an existing Tableros model.
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

    }

    /**
     * Deletes an existing Tableros model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash(
            'success',
            'Se ha eliminado el tablero correctamente'
        );

        return $this->redirect(['equipos/gestionar-tableros']);
    }

    /**
     * Finds the Tableros model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tableros the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tableros::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
