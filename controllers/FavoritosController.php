<?php

namespace app\controllers;

use Yii;
use app\models\Favoritos;
use app\models\FavoritosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use app\components\MyHelpers;

/**
 * FavoritosController implements the CRUD actions for Favoritos model.
 */
class FavoritosController extends Controller
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
     * Lists all Favoritos models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FavoritosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Favoritos model.
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
     * Añade o elimina un tablero como favorito.
     * @param  int $id_tablero ID del tablero.
     * @return bool            Si el tablero es favorito o no.
     */
    public function actionCambiarFavorito($id_tablero = null)
    {
        $model = Favoritos::findOne([
            'tablero_id'=>$id_tablero,
            'usuario_id'=>Yii::$app->user->id
        ]);

        if ($model === null) {
            $model = new Favoritos();
            $model->load(Yii::$app->request->post());
            $tablero = $model->tablero;
            $model->save();
            $mensaje = "Se ha añadido como tablero favorito";


        } else {
            $tablero = $model->tablero;
            $mensaje = "Se ha eliminado como tablero favorito";
            $model->delete();
        }

        MyHelpers::notification('success', $mensaje, 0);

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $tablero->esFavorito;


    }

    /**
     * Updates an existing Favoritos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
     * Deletes an existing Favoritos model.
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
     * Finds the Favoritos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Favoritos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Favoritos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
