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
use yii\db\Expression;

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

            return $this->renderAjax('/tableros/listas_tablero', [
                'model'=>$model->lista->tablero,
                'tarjeta' => new Tarjetas(),
                'adjunto'=>new Adjuntos(),
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

    }

    /**
     * Modifica los datos de la tarjeta y devuelve una renderización
     * del contenido de la tarjeta.
     * @param  [type] $id ID de la tarjeta.
     * @return [type]     [description]
     */
    public function actionUpdateAjax($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $model->save();

            return $this->renderAjax('descripcion_tarjeta', [
                'tarjeta'=>$model,
            ]);
        }
    }

    public function actionRenderFormFile($id)
    {
        $tarjeta = $this->findModel($id);

        return $this->renderAjax('form_file', [
            'model'=>new Adjuntos([
                'scenario'=>Adjuntos::ESCENARIO_FILE,
            ]),
            'tarjeta'=>$tarjeta,
        ]);
    }

    public function actionRenderListaAdjnutos($id_tarjeta)
    {
        $model = $this->findModel($id_tarjeta);

        return $this->renderAjax('lista_adjuntos', [
            'model'=>$model,
        ]);
    }

    /**
     * Modifica la lista a la que pertenece una tarjeta.
     * @param  int $id_tarjeta ID de la tarjeta
     * @return bool            True o false si se ha guardado
     *                         la modificación.
     */
    public function actionUpdateLista($id_tarjeta)
    {
        $model = $this->findModel($id_tarjeta);

        $model->lista_id = Yii::$app->request->post('lista_id');
        $model->created_at = new Expression('current_timestamp');
        Yii::$app->response->format = Response::FORMAT_JSON;

        return $model->save();
    }

    public function actionListaComentarios($id)
    {
        $model = $this->findModel($id);

        return $this->render('lista_completa_comentarios', [
            'todos_comentarios'=>$model->getComentarios(),
            'tarjeta'=>$model,
        ]);
    }

    /**
     * Muestra u oculta una tarjeta, de manera que si está oculta
     * sólo lo ve el propietario del tablero. En caso contrario, lo puede ver
     * también los miembros del equipo.
     * @param  integer $id Identificador de la tarjeta.
     * @return boolean     True o false si está oculta o no.
     */
    public function actionOcultar($id)
    {
        $model = $this->findModel($id);

        if ($model->esta_oculta) {
            $model->esta_oculta = false;

        } else {
            $model->esta_oculta = true;
        }

        $model->lista_id = Yii::$app->request->post('lista_id');
        $model->save();

        Yii::$app->response->format = Response::FORMAT_JSON;

        return $model->esta_oculta;
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
        $tablero = $this->findModel($id)->lista->tablero;

        $this->findModel($id)->delete();

        return $this->renderAjax('/tableros/listas_tablero', [
            'model'=>$tablero,
            'tarjeta' => new Tarjetas(),
            'adjunto'=>new Adjuntos(),
        ]);
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
