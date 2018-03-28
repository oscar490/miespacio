<?php

namespace app\controllers;

use Yii;
use app\models\Equipos;
use app\models\EquiposSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;
use yii\web\Response;
use app\models\Tableros;
use yii\filters\AccessControl;
use app\models\UploadForm;

/**
 * EquiposController implements the CRUD actions for Equipos model.
 */
class EquiposController extends Controller
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
                'only'=>['gestionar-tableros'],
                'rules'=>[
                    [
                        'allow'=>true,
                        'actions'=>['gestionar-tableros'],
                        'roles'=>['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Se muestran los tableros creados en cada equipo. Se permite poder crear
     * un tablero nuevo o un nuevo equipo.
     * @param integer $id_equipo El identificador del equipo.
     * @return mixed
     */
    public function actionGestionarTableros($id_equipo = null)
    {
        //  Equipos creados por el usuario logeado.
        $equipos = new ActiveDataProvider([
            'query'=>Equipos::find()
                ->where(['usuario_id'=>Yii::$app->user->id]),
            'sort'=>[
                'defaultOrder'=>['created_at'=>SORT_ASC],
            ],
        ]);

        //  Modelo para crear un nuevo tablero.
        $tablero_crear = new Tableros([
            'equipo_id'=>$id_equipo,
        ]);

        //  Validación del modelo del tablero, por ajax.
        if (Yii::$app->request->isAjax && $tablero_crear->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($tablero_crear);
        }

        //  Validación y guardado del modelo tablero. Sin ajax.
        if ($tablero_crear->load(Yii::$app->request->post()) && $tablero_crear->save()) {
            return $this->redirect(['tableros/view', 'id'=>$tablero_crear->id]);
        }

        return $this->render('gestionar', [
            'equipos' => $equipos,
            'tablero_crear'=> $tablero_crear,
            //  Modelo para crear un nuevo equipo.
            'equipo_crear'=> new Equipos(),
        ]);
    }

    /**
     * Muestra el contenido de un equipo pasándole el
     * id del equipo por parámetro.
     * @param integer $id ID del Equipo.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!ctype_digit($id)) {
            throw new NotFoundHttpException('Parámetro incorrecto.');
        }

        //  Modelo de subida de archivos.
        $archivo_subir = new UploadForm;

        //  Tableros del equipo.
        $tableros = new ActiveDataProvider([
            'query'=>Tableros::find()
                ->where(['equipo_id'=>$id]),
        ]);

        //  Modelo de tablero.
        $tablero_crear = new Tableros();

        return $this->render('view', [
            'model' => $this->findModel($id),
            'tableros'=>$tableros,
            'tablero_crear'=>$tablero_crear,
            'archivo_subir'=>$archivo_subir,
        ]);
    }

    /**
     * Crea tanto un nuevo equipo como un nuevo tablero. En caso de que se cree,
     * se redireccionar a la vista de ellos.
     * @return mixed
     */
    public function actionCreate()
    {
        //  Modelo para craar un nuevo equipo.
        $equipo = new Equipos([
            'usuario_id'=>Yii::$app->user->id,
        ]);

        //  Mostrar tableros de un equipo.
        $tablerosLista = Tableros::find()
            ->where(['equipo_id'=>Equipos::find()
                ->where(['usuario_id'=>Yii::$app->user->id])
                ->scalar()]);

        //  Mostrar lista desplegable de equipos creados.
        $equipos = Equipos::find()
            ->select(['denominacion'])
            ->indexBy('id')
            ->where(['usuario_id'=>Yii::$app->user->id])
            ->orderBy(['created_at'=>SORT_ASC])
            ->column();

        if (Yii::$app->request->isAjax && $equipo->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($equipo);
        }

        if ($equipo->load(Yii::$app->request->post()) && $equipo->save()) {
            return $this->redirect(['view', 'id' => $equipo->id]);
        }

        return $this->render('create', [
            'equipo' => $equipo,
            'equipos'=>$equipos,
            'tablerosLista'=>$tablerosLista,
            //  Modelo para crear un nuevo tablero.
            'tablero'=> new Tableros(),
        ]);
    }

    /**
     * Updates an existing Equipos model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!ctype_digit($id)) {
            throw new NotFoundHttpException('Parámetro incorrecto.');
        }
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash(
                'success',
                'Se ha guardado la última modificación correctamente.'
            );
            return $this->redirect(['view', 'id' => $model->id]);
        }

    }

    /**
     * Deletes an existing Equipos model.
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
     * Finds the Equipos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Equipos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Equipos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
