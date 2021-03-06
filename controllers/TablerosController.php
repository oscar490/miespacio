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
use app\models\TiposVisibilidad;
use yii\filters\AccessControl;
use app\models\Notificaciones;

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
            'access'=>[
                'class'=>AccessControl::className(),
                'only'=>['view'],
                'rules'=>[
                    [
                        'allow'=>true,
                        'actions'=>['view'],
                        'roles'=>['@'],
                        'matchCallback'=>function($rule, $action) {

                            $tablero = $this->findModel(
                                Yii::$app->request->get('id')
                            );

                            $miembro = $tablero->equipo
                                ->getMiembros()
                                ->where(['usuario_id'=>Yii::$app->user->id])
                                ->one();

                            return $miembro !== null &&
                                (!$tablero->esPrivado || $miembro->equipo
                                    ->propietario_id === Yii::$app->user->id);

                        }
                    ]
                ],
            ]
        ];
    }

    /**
     * Lists all Tableros models.
     * @return mixed
     */
    public function actionSearch()
    {
        $searchModel = new TablerosSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $busqueda = $searchModel->denominacion;

        return $this->renderAjax('lista_tableros_encontrados', [
            'dataProvider' => $dataProvider,
            'busqueda'=>$busqueda,
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
            ->where(['propietario_id'=>Yii::$app->user->id])
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
     * Renderización de la página.
     * @param  int $id ID del tablero
     * @return [type]     [description]
     */
    public function actionRefrescar($id)
    {
        $model = $this->findModel($id);

        return $this->renderAjax('listas_tablero', [
            'model' => $model,
            'tarjeta' => new Tarjetas(),
            'adjunto' => new Adjuntos([
                'scenario'=>Adjuntos::ESCENARIO_FILE
            ])
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
            'adjunto'=>new Adjuntos([
                'scenario'=>Adjuntos::ESCENARIO_FILE
            ]),
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

    public function actionViewNotificaciones($id_tablero = null)
    {

        if ($id_tablero !== null) {
            $query = $this->findModel($id_tablero)
                ->getNotificaciones();

        } else {
            $query = Notificaciones::find()
                ->where([
                    'miembro_id'=>Yii::$app->user->id,
                    'tablero_id' => null,
                ]);
        }

        return $this->render('/notificaciones/notificaciones_tablero', [
            'query_mas_notificaciones'=>$query,
            'action'=>$this->action->id,
        ]);

    }

    /**
     * Renderia en contenido de búsqueda de tableros.
     * @return [type] [description]
     */
    public function actionLoadContent()
    {
        return $this->renderAjax('search_tablero', [
            'search'=>new TablerosSearch(),
        ]);
    }

    /**
     * Renderiza, por ajax, una vista de las notificaciones
     * de un tablero.
     * @param  integer $id ID del tablero.
     * @return [type]     Renderización de notificaciones
     *                    de un tablero.
     */
    public function actionRecargarActividades($id)
    {
        $model = $this->findModel($id);

        return $this->renderAjax('/notificaciones/lista_notificaciones', [
            'notificaciones'=>$model->getNotificaciones(),
            'id_tablero'=>$model->id,
        ]);
    }

    /**
     * Cambia la visibilidad del tablero.
     * @param  int $id ID del tablero;
     * @return [type]     [description]
     */
    public function actionChangedVisibilidad($id)
    {
        $model = $this->findModel($id);

        if ($model->visibilidad->id === 1) {
            $model->visibilidad_id = 2;

        } else {
            $model->visibilidad_id = 1;
        }

        $model->save();

        return $model->visibilidad->id;
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

            Yii::$app->session->setFlash(
                'success',
                'Se han modificado los datos correctamente'
            );

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
