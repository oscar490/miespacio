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

    public function actionRenderizarFormEnlace($id_tarjeta)
    {
        $tarjeta = Tarjetas::findOne($id_tarjeta);

        return $this->renderAjax('/adjuntos/create', [
            'model'=> new Adjuntos(),
            'tarjeta'=>$tarjeta,
        ]);
    }

    public function actionRenderContenido($id_adjunto)
    {
        $model = $this->findModel($id_adjunto);

        return $this->render('/tarjetas/vista_adjunto', [
            'adjunto'=>$model,
        ]);
    }

    public function actionCreate()
    {
        $model = new Adjuntos([
            'tipo_id'=>3
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return $this->renderAjax('/tarjetas/lista_adjuntos', [
                'model'=>$model->tarjeta,
            ]);
        }

    }

    public function actionUploadFile($id_tarjeta)
    {
        $model = new Adjuntos([
            'tarjeta_id'=>$id_tarjeta,
            'scenario'=>Adjuntos::ESCENARIO_FILE,
        ]);

        $model->archivo = UploadedFile::getInstance($model, 'archivo');

        Yii::$app->response->format = Response::FORMAT_JSON;
        $model->nombre = $model->archivo->name;

        //  Comprueba si ya existe el archivo adjuntado.
        if ((Adjuntos::findOne([
                'nombre'=>$model->nombre,
                'tarjeta_id'=>$id_tarjeta
            ])) !== null)
        {
                return false;
        }

        $model->tipo_id = $model->getConsultarTipo(
            Adjuntos::extraerTipo($model->archivo->type)
        );

        $model->save();

        //  Se sube a Dropbox.
        $upload = new UploadFiles([
            'nombre_archivo'=> 'adjunto' . $model->id . $model->tarjeta->id
                . '.' . $model->archivo->extension,
            'archivo' => $model->archivo,
        ]);
        $model->url_direccion = $upload->upload();
        $model->save();

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
        $model->tarjeta_id = Yii::$app->request->post('tarjeta_id');

        $model->save();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $this->renderAjax('/tarjetas/lista_adjuntos', [
            'model'=>$model->tarjeta,
        ]);
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
        $model = $this->findModel($id);
        $tarjeta = $model->tarjeta;

        $model->delete();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $this->renderAjax('/tarjetas/lista_adjuntos', [
            'model'=>$tarjeta,
        ]);


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
