<?php

namespace app\controllers;

use Yii;
use app\models\Miembros;
use app\models\MiembrosSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\Usuarios;
use app\models\UsuariosSearch;
use app\components\MyHelpers;


/**
 * MiembrosController implements the CRUD actions for Miembros model.
 */
class MiembrosController extends Controller
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
     * Lists all Miembros models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MiembrosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Miembros model.
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
     * Creates a new Miembros model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Miembros();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            MyHelpers::notification(
                'success',
                'Se ha añadido al equipo correctamente',
                0
            );
            
            return $this->renderAjax('/equipos/miembros', [
                'miembros' => new ActiveDataProvider([
                    'query'=>Usuarios::find()
                        ->joinWith('miembros')
                        ->where(['equipo_id'=>$model->equipo_id])
                        ->orderBy(['created_at'=>SORT_DESC])
                ]),
                'model'=>$model->equipo,
                'usuario_search'=>new UsuariosSearch(),
            ]);
        }


    }

    /**
     * Updates an existing Miembros model.
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
     * Deletes an existing Miembros model.
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
     * Finds the Miembros model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Miembros the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Miembros::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
