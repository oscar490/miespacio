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
 * @property Equipos $equipo
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
                ['equipo_id'],
                'filter',
                'filter'=>'intval',
            ],
            [['equipo_id'], 'integer'],
            [['denominacion'], 'string', 'max' => 255],
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
            'equipo_id' => 'Mover al equipo',
        ];
    }

    public function formName()
    {
        return '';
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
}
