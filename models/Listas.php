<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "listas".
 *
 * @property int $id
 * @property string $denominacion
 * @property int $tablero_id
 *
 * @property Tableros $tablero
 * @property Tarjetas[] $tarjetas
 */
class Listas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'listas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['denominacion', 'tablero_id'], 'required'],
            [['tablero_id'], 'default', 'value' => null],
            [['tablero_id'], 'integer'],
            [['denominacion'], 'string', 'max' => 30],
            [
                ['denominacion', 'tablero_id'],
                'unique',
                'targetAttribute' => ['denominacion', 'tablero_id'],
                'message' => 'Ya existe una lista con ese título'
            ],
            [['tablero_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tableros::className(), 'targetAttribute' => ['tablero_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'denominacion' => 'Título',
            'tablero_id' => 'Tablero ID',
        ];
    }

    public function formName()
    {
        return '';
    }

    /**
     * Devuelve true o false en caso si contiene o no
     * tarjetas.
     * @return [type] [description]
     */
    public function getContieneTarjetas()
    {
        return !empty($this->getTarjetas()->all());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTablero()
    {
        return $this->hasOne(Tableros::className(), ['id' => 'tablero_id'])->inverseOf('listas');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTarjetas()
    {
        return $this->hasMany(Tarjetas::className(), ['lista_id' => 'id'])->inverseOf('lista');
    }

    /**
     * Cada vez que se crea una nueva lista, o se modifica, se crea una
     * una notificación.
     * @param  bool $insert            True si es insert, false si es update.
     * @param  array $changedAttributes Atributos cambiados.
     */
    public function afterSave($insert, $changedAttributes)
    {
        if (!$insert) { //  Update
            $antiguo = $changedAttributes['denominacion'];
            $nuevo = $this->denominacion;

            $contenido = "ha cambiado el nombre de la lista," .
                " de <strong>$antiguo</strong> a <strong>$nuevo</strong>";
        }

        if ($insert) { // Insert
            $contenido = "ha creado la lista" .
            " <strong>$this->denominacion</strong>";

        }

        $miembro = Miembros::find()
            ->where([
                'usuario_id'=>Yii::$app->user->id,
                'equipo_id'=>$this->tablero->equipo->id,
            ])->one();

        (new Notificaciones([
            'contenido'=>$contenido,
            'miembro_id'=>$miembro->id,
            'tablero_id'=>$this->tablero->id,
        ]))->save();
    }

    /**
     * Cuando se elimina una lista, se crea una notificación.
     * @return [type] [description]
     */
    public function afterDelete()
    {
        //  Delete
        $miembro = Miembros::find()
            ->where([
                'usuario_id'=>Yii::$app->user->id,
                'equipo_id'=>$this->tablero->equipo->id,
            ])->one();

        (new Notificaciones([
            'contenido'=>"ha eliminado la lista <strong>$this->denominacion</strong>",
            'miembro_id'=>$miembro->id,
            'tablero_id'=>$this->tablero->id,
        ]))->save();
    }
}
