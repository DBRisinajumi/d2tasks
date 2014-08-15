<?php

/**
 * This is the model base class for the table "tstt_status".
 *
 * Columns in table "tstt_status" available as properties of the model:
 * @property integer $tstt_id
 * @property string $tstt_name
 * @property string $tstt_icon
 *
 * Relations of table "tstt_status" available as properties of the model:
 * @property TsthStatusHistory[] $tsthStatusHistories
 * @property TtskTask[] $ttskTasks
 */
abstract class BaseTsttStatus extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'tstt_status';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('tstt_name', 'required'),
                array('tstt_icon', 'default', 'setOnEmpty' => true, 'value' => null),
                array('tstt_name, tstt_icon', 'length', 'max' => 50),
                array('tstt_id, tstt_name, tstt_icon', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->tstt_name;
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
                'tsthStatusHistories' => array(self::HAS_MANY, 'TsthStatusHistory', 'tsth_tstt_id'),
                'ttskTasks' => array(self::HAS_MANY, 'TtskTask', 'ttsk_tstt_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'tstt_id' => Yii::t('D2tasksModule.model', 'Tstt'),
            'tstt_name' => Yii::t('D2tasksModule.model', 'Tstt Name'),
            'tstt_icon' => Yii::t('D2tasksModule.model', 'Tstt Icon'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.tstt_id', $this->tstt_id);
        $criteria->compare('t.tstt_name', $this->tstt_name, true);
        $criteria->compare('t.tstt_icon', $this->tstt_icon, true);


        return $criteria;

    }

}
