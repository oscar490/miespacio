<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notificaciones".
 *
 * @property int $id
 * @property string $contenido
 * @property int $miembro_id
 * @property string $created_at
 * @property string $view_at
 *
 * @property Usuarios $usuario
 */
class Notificaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notificaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['miembro_id'], 'required'],
            [['miembro_id'], 'default', 'value' => null],
            [['miembro_id'], 'integer'],
            [['created_at'], 'safe'],
            [['contenido'], 'string', 'max' => 255],
            [
                ['miembro_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Miembros::className(),
                'targetAttribute' => ['miembro_id' => 'id']
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
            'contenido' => 'Contenido',
            'created_at' => 'Created At',
        ];
    }

    public function getObservada()
    {
        return !$this->view_at === null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMiembro()
    {
        return $this->hasOne(Miembros::className(), ['id' => 'miembro_id'])
            ->inverseOf('notificaciones');
    }

    public function getTablero()
    {
        return $this->hasOne(Tableros::className(), ['id'=>'tablero_id'])
            ->inverseOf('notificaciones');
    }

    public function getNotificaciones()
    {
        return $this->hasMany(Notificaciones::className(), ['tablero_id'=>'id'])
            ->inverseOf('tablero');
    }
}
