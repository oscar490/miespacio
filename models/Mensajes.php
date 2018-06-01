<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mensajes".
 *
 * @property int $id
 * @property string $asunto
 * @property string $contenido
 * @property int $emisor
 * @property int $receptor
 * @property string $created_at
 * @property string $view_at
 *
 * @property Usuarios $emisor0
 * @property Usuarios $receptor0
 */
class Mensajes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mensajes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contenido', 'emisor', 'receptor'], 'required'],
            [['emisor', 'receptor'], 'default', 'value' => null],
            [['emisor', 'receptor'], 'integer'],
            [['created_at', 'view_at'], 'safe'],
            [['asunto'], 'string', 'max' => 20],
            [['contenido'], 'string', 'max' => 255],
            [['emisor'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['emisor' => 'id']],
            [['receptor'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['receptor' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'asunto' => 'Asunto',
            'contenido' => 'Contenido',
            'emisor' => 'Emisor',
            'receptor' => 'Receptor',
            'created_at' => 'Created At',
            'view_at' => 'View At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmisor()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'emisor'])->inverseOf('mensajes');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReceptor()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'receptor'])->inverseOf('mensajes0');
    }
}
