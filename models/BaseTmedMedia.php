<?php

/**
 * This is the model base class for the table "tmed_media".
 *
 * Columns in table "tmed_media" available as properties of the model:
 * @property integer $tmed_id
 * @property string $tmed_name
 * @property string $tmed_icon
 *
 * Relations of table "tmed_media" available as properties of the model:
 * @property TcmnCommunication[] $tcmnCommunications
 */
abstract class BaseTmedMedia extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'tmed_media';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('tmed_name', 'required'),
                array('tmed_icon', 'default', 'setOnEmpty' => true, 'value' => null),
                array('tmed_name, tmed_icon', 'length', 'max' => 50),
                array('tmed_id, tmed_name, tmed_icon', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->tmed_name;
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(), array(
                'savedRelated' => array(
                    'class' => '\GtcSaveRelationsBehavior'
                )
            )
        );
    }

    public function relations()
    {
        return array_merge(
            parent::relations(), array(
                'tcmnCommunications' => array(self::HAS_MANY, 'TcmnCommunication', 'tcmn_tmed_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'tmed_id' => Yii::t('D2tasksModule.model', 'Tmed'),
            'tmed_name' => Yii::t('D2tasksModule.model', 'Tmed Name'),
            'tmed_icon' => Yii::t('D2tasksModule.model', 'Tmed Icon'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.tmed_id', $this->tmed_id);
        $criteria->compare('t.tmed_name', $this->tmed_name, true);
        $criteria->compare('t.tmed_icon', $this->tmed_icon, true);


        return $criteria;

    }

}
