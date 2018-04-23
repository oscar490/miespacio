<?php

namespace app\models;

use Yii;
use app\models\Adjuntos;

/**
 * This is the model class for table "tarjetas".
 *
 * @property int $id
 * @property string $denominacion
 * @property string $descripcion
 * @property int $lista_id
 *
 * @property Adjuntos[] $adjuntos
 * @property Listas $lista
 */
class Tarjetas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tarjetas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['denominacion', 'lista_id'], 'required'],
            [['lista_id'], 'integer'],
            [['denominacion', 'descripcion'], 'string', 'max' => 255],
            [
                ['denominacion', 'lista_id'],
                'unique',
                'targetAttribute' => ['denominacion', 'lista_id'],
                'message'=>'Ya existe una tarjeta con ese nombre.',
            ],
            [
                ['lista_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Listas::className(),
                'targetAttribute' => ['lista_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'denominacion' => 'Nombre de la tarjeta',
        ];
    }

    public function formName()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLista()
    {
        return $this->hasOne(Listas::className(), ['id' => 'lista_id'])->inverseOf('tarjetas');
    }

    /**
    *  @return \yii\db\ActiveQuery
    */
    public function getAdjuntos()
    {
        return $this->hasMany(Adjuntos::className(), ['tarjeta_id' => 'id'])->inverseOf('tarjeta');
    }


}
