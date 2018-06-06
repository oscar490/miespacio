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
 * @property string $created_at
 * @property bool $esta_oculta
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
            [['esta_oculta'], 'safe'],
            [['denominacion'], 'string', 'max' => 40],
            [['descripcion'], 'string', 'max' => 200],
            [['descripcion'], 'default'],
            [['denominacion', 'descripcion'], function ($attribute, $params, $validator) {
                $tablero = $this->lista->tablero;

                $miembro = Miembros::find()
                    ->where([
                        'usuario_id'=>Yii::$app->user->id,
                        'equipo_id'=>$tablero->equipo->id,
                    ])->one();

                if (!$miembro->esPropietario && $this->esta_oculta) {
                    $this->addError($attribute, 'Esta tarjeta se encuentra en estado de oculta');
                }
            }],
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

    /**
     * Devuelve true o false en caso si tiene o no descripción.
     * @return [type] [description]
     */
    public function getContieneDescripcion()
    {
        return $this->descripcion !== null;
    }

    public function getContieneAdjuntos()
    {
        return !empty($this->getAdjuntos()->all());
    }

    public function formName()
    {
        return '';
    }

    public function getContieneMapa()
    {
        return $this->mapas !== null;
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

    /**
    * @return \yii\db\ActiveQuery
    */
    public function getComentarios()
    {
        return $this->hasMany(Comentarios::className(), ['tarjeta_id' => 'id'])
            ->inverseOf('tarjeta');
    }

    public function afterDelete()
    {
        $equipo = $this->lista->tablero->equipo;

        $miembro = $equipo->getMiembros()
            ->where([
                'usuario_id'=>Yii::$app->user->id
            ])->one();

        (new Notificaciones([
            'contenido'=>"ha eliminado la tarjeta <strong>$this->denominacion</strong>",
            'miembro_id'=>$miembro->id,
            'tablero_id'=>$this->lista->tablero->id,
        ]))->save();
    }

    /**
     * Crea una notificación al crear o modificar una tarjeta.
     * @param  [type] $insert            [description]
     * @param  [type] $changedAttributes [description]
     * @return [type]                    [description]
     */
    public function afterSave($insert, $changedAttributes)
    {
        $lista_nueva = $this->lista;

        if (!$insert) { //  Update
            $contenido = "ha modificado las propiedades" .
                " de la tarjeta <storng>$this->denominacion</storng>";

            $lista_antigua = $changedAttributes['lista_id'];


            if ($lista_antigua !== $this->lista->id) {
                $contenido = "ha movido la tarjeta <strong>$this->denominacion</strong>" .
                    " a la lista <storng>$lista_nueva->denominacion</storng>.";
            }

        } else {   //   Insert
            $contenido = "ha creado la tarjeta <strong>$this->denominacion</strong>" .
                " en la lista <strong>$lista_nueva->denominacion</strong>.";
        }

        $equipo = $this->lista->tablero->equipo;

        $miembro = $equipo->getMiembros()
            ->where([
                'usuario_id'=>Yii::$app->user->id,
            ])->one();

        (new Notificaciones([
            'contenido'=>$contenido,
            'miembro_id'=>$miembro->id,
            'tablero_id'=>$this->lista->tablero->id,
        ]))->save();


    }
    /**
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMapas()
    {
          return $this->hasOne(Mapas::className(), ['tarjeta_id' => 'id'])
            ->inverseOf('tarjeta');
    }


}
