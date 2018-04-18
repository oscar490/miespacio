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
use yii\web\UploadedFile;
use app\models\UploadFiles;

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
     * Se muestran los equipos junto con sus tableros creados.
     * @param integer $id_equipo El identificador del equipo.
     * @return mixed
     */
    public function actionGestionarTableros()
    {
        //  Equipos creados por el usuario logeado.
        $equipos = new ActiveDataProvider([
            'query'=>Equipos::find()
                ->where(['usuario_id'=>Yii::$app->user->id]),
            'sort'=>[
                'defaultOrder'=>['created_at'=>SORT_DESC],
            ],
        ]);

        return $this->render('gestionar', [
            'equipos' => $equipos,
            'tablero_crear'=> new Tableros(),
            'equipo'=> new Equipos(),
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
            'url_imagen'=>'images/equipo.png'
        ]);

        if (Yii::$app->request->isAjax && $equipo->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($equipo);
        }

        if ($equipo->load(Yii::$app->request->post()) && $equipo->save()) {
            return $this->redirect(['view', 'id' => $equipo->id]);
        }

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
     * Cambia la imágen del equipo usando ajax.
     * @param  integer $id ID del equipo.
     * @return string      Direccíon de enlace de la imágen.
     */
    public function actionUpdateImagen($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->imagen_equipo = UploadedFile::getInstance($model, 'imagen_equipo');
        }

        $subida = new UploadFiles([
            'nombre_archivo'=> $model->id . $model->usuario->id . '.jpg',
            'archivo' => $model->imagen_equipo,
        ]);

        $url = $subida->upload();
        $model->url_imagen = $url;
        $model->save(false);

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $url;
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

        Yii::$app->session->setFlash(
            'success',
            'Se ha eliminado el equipo correctamente.'
        );
        return $this->redirect(['gestionar-tableros']);
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
