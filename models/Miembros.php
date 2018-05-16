<?php

namespace app\models;

use Yii;
use app\models\Email;

/**
 * This is the model class for table "miembros".
 *
 * @property int $id
 * @property int $usuario_id
 * @property int $tipo_id
 * @property int $equipo_id
 * @property string $created_at
 *
 * @property Tableros $tablero
 * @property Usuarios $usuario
 */
class Miembros extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'miembros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario_id', 'equipo_id'], 'required'],
            [['usuario_id', 'equipo_id'], 'default', 'value' => null],
            [['usuario_id', 'equipo_id'], 'integer'],
            [['created_at'], 'safe'],
            [['equipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Equipos::className(), 'targetAttribute' => ['equipo_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::className(), 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'usuario_id' => 'Usuario ID',
            'equipo_id' => 'Tablero ID',
            'created_at' => 'Created At',
        ];
    }

    public function formName()
    {
        return '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEquipo()
    {
        return $this->hasOne(Equipos::className(), ['id' => 'equipo_id'])->inverseOf('miembros');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::className(), ['id' => 'usuario_id'])->inverseOf('miembros');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getNotificaciones()
    {
        return $this->hasMany(Notificaciones::className(), ['miembro_id' => 'id'])
            ->inverseOf('miembro');
    }

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getTipo()
    {
        return $this->hasOne(TiposMiembros::className(), ['id' => 'tipo_id'])
            ->inverseOf('miembros');
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($this->usuario->id === Yii::$app->user->id) {
            return false;
        }

        $enlace = $this->equipo->enlace;

        (new Email([
            'asunto'=>'Añadido como miembro de un equipo',
            'direccion'=>$this->usuario->email,
            'contenido'=>'usuario-miembro',
            'options_view'=>['equipo'=>$this->equipo],
        ]))->send();

        (new Notificaciones([
            'contenido'=>"te ha añadido al equipo $enlace",
            'miembro_id'=>$this->id
        ]))->save();

    }
}
