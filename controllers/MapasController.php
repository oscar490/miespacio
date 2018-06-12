<?php

namespace app\controllers;

use Yii;
use app\models\Mapas;
use app\models\MapasSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Tarjetas;
use yii\filters\AccessControl;
use app\models\Miembros;

/**
 * MapasController implements the CRUD actions for Mapas model.
 */
class MapasController extends Controller
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

            'access'=> [
                'class'=>AccessControl::className(),
                'only'=>['update', 'create'],
                'rules'=>[
                    [
                        'allow'=>true,
                        'actions'=>['update', 'create'],
                        'roles'=>['@'],
                    ]
                ],

            ]
        ];
    }

    /**
     * Lists all Mapas models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MapasSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Mapas model.
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
     * Creates a new Mapas model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_tarjeta)
    {
        if (!ctype_digit($id_tarjeta)) {
            throw new NotFoundHttpException('Parámetro incorrecto');
        }

        $model = new Mapas([
            'latitud'=>40.4167754,
            'longitud'=>-3.7037901999999576,
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash(
                'success',
                'Se ha añadido una nueva ubicación a la tarjeta'
            );

            return $this->redirect(['update', 'id_tarjeta' => $model->tarjeta_id]);
        }

        $tarjeta = Tarjetas::findOne($id_tarjeta);

        return $this->render('update', [
            'model' => $model,
            'tarjeta'=>$tarjeta,
        ]);
    }

    /**
     * Updates an existing Mapas model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_tarjeta)
    {
        if (!ctype_digit($id_tarjeta)) {
            throw new NotFoundHttpException('Parámetro incorrecto');
            var_Dump('entra'); die();
        }

        $model = $this->findModel($id_tarjeta);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save();
            return $model->ubicacion;
        }

        return $this->render('update', [
            'model' => $model,
            'tarjeta'=>$model->tarjeta,
        ]);
    }

    /**
     * Deletes an existing Mapas model.
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
     * Finds the Mapas model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mapas the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mapas::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
