<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tableros".
 *
 * @property int $id
 * @property string $denominacion
 * @property int $equipo_id
 *
 * @property Listas[] $listas
 * @property Favoritos[] $favoritos
 * @property Equipos $equipo
 * @property TiposVisibilidad $visibilidad
 */
class Tableros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tableros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['denominacion', 'equipo_id'], 'required'],
            [['equipo_id'], 'default', 'value' => null],
            [
                ['equipo_id', 'visibilidad_id'],
                'filter',
                'filter'=>'intval',
            ],
            [['equipo_id'], 'integer'],
            [['denominacion'], 'string', 'max' => 40 ],
            [
                ['denominacion', 'equipo_id'],
                'unique',
                'targetAttribute' => ['denominacion', 'equipo_id'],
                'message'=>'Ya existe un tablero con ese nombre.',
            ],
            [
                ['equipo_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Equipos::className(),
                'targetAttribute' => ['equipo_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'denominacion' => 'Nombre del tablero',
            'equipo_id' => 'Equipo',
        ];
    }

    public function formName()
    {
        return '';
    }

    /**
     * Comprueba si el tablero es favorito o no.
     * @return bool True en caso que si, false en caso contrario.
     */
    public function getEsFavorito()
    {
        $favorita = Favoritos::find()
            ->where([
                'usuario_id'=>Yii::$app->user->id,
                'tablero_id'=>$this->id
            ])->one();

        return $favorita !== null;
    }

    /**
     * Comprueba si el tablero contiene alguna lista creada,
     * devolviendo true en caso de que si o false en caso
     * contrario.
     * @return boolean True si tiene listas creadas, false en
     *                 caso contrario
     */
    public function getContieneListas()
    {
        return count($this->getListas()->all()) !== 0;
    }

    /**
     * Comprueba si el tablero es privado o público.
     * @return bool True si es privado y false en caso contrario.
     */
    public function getEsPrivado()
    {
        return $this->visibilidad_id === 1;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipo()
    {
        return $this->hasOne(Equipos::className(), ['id' => 'equipo_id'])->inverseOf('tableros');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getListas()
    {
       return $this->hasMany(Listas::className(), ['tablero_id' => 'id'])->inverseOf('tablero');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getMiembros()
    {
        return $this->hasMany(Miembros::className(), ['equipo_id' => 'id'])
            ->via('equipo');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getFavoritos()
    {
       return $this->hasMany(Favoritos::className(), ['tablero_id' => 'id'])
        ->inverseOf('tablero');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisibilidad()
    {
        return $this->hasOne(TiposVisibilidad::className(), ['id'=>'visibilidad_id'])
            ->inverseOf('tableros');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotificaciones()
    {
        return $this->hasMany(Notificaciones::className(), ['tablero_id'=>'id'])
            ->inverseOf('tablero');
    }
}
