<?php

namespace app\models;

use Yii;
use Spatie\Dropbox\Exceptions\BadRequest;
use yii\helpers\Html;

/**
 * This is the model class for table "equipos".
 *
 * @property int $id
 * @property string $denominacion
 * @property string $descripcion
 * @property int $propietario_id
 * @property string $url_imagen
 *
 * @property Usuarios $usuario
 * @property Tableros[] $tableros
 */
class Equipos extends \yii\db\ActiveRecord
{
    /**
     * Imágen del equipo.
     * @var [type]
     */
    public $imagen_equipo;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipos';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['denominacion', 'propietario_id'], 'required'],
            [['propietario_id'], 'default', 'value' => null],
            [['propietario_id'], 'integer'],
            [['denominacion', 'descripcion'], 'string', 'max' => 30],
            [
                ['denominacion', 'propietario_id'],
                'unique',
                'targetAttribute' => ['denominacion', 'propietario_id'],
                'message'=>'Ya existe un equipo con ese nombre',
            ],
            [
                ['propietario_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Usuarios::className(),
                'targetAttribute' => ['propietario_id' => 'id'],
            ],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'imagen_equipo'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'denominacion' => 'Nombre del equipo',
            'descripcion' => 'Descripción (opcional)',
            'propietario_id' => 'Usuario ID',
            'imagen_equipo'=>'Imágen de equipo'
        ];
    }

    /**
     * Devuelve un enlace a la vista del equipo.
     * @return [type] [description]
     */
    public function getEnlace()
    {
        return Html::a(
            $this->denominacion,
            ['equipos/view', 'id'=>$this->id]
        );
    }


    /**
     * Nombre del formulario.
     * @return [type] [description]
     */
    public function formName()
    {
        return '';
    }

    /**
     * Después de eliminarse el equipo, se elimina la imágen
     * del equipo.
     * @return [type] [description]
     */
    public function afterDelete()
    {
        $cliente = new \Spatie\Dropbox\Client(getenv('DROPBOX_TOKEN'));

        try {
            $cliente->delete(
                $this->id . Yii::$app->user->id . '.jpg'
            );
        } catch (BadRequest $e) {
        }
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'propietario_id'])->inverseOf('equipos');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTableros()
    {
        return $this->hasMany(Tableros::className(), ['equipo_id' => 'id'])->inverseOf('equipo');
    }

    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['id'=>'usuario_id'])
            ->via('miembros');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getMiembros()
    {
        return $this->hasMany(Miembros::className(), ['equipo_id' => 'id'])->inverseOf('equipo');
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (!$insert) {
            return false;
        }

        $this->url_imagen = 'images/equipo.png';
        $this->save();

        $miembro = new Miembros([
            'equipo_id'=>$this->id,
            'usuario_id'=>Yii::$app->user->id,
        ]);

        $miembro->save();




    }
}
