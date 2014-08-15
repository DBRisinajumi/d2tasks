<?php

/**
 * This is the model base class for the table "tsth_status_history".
 *
 * Columns in table "tsth_status_history" available as properties of the model:
 * @property string $tsth_id
 * @property string $tsth_ttsk_id
 * @property integer $tsth_tstt_id
 * @property integer $tsth_pprs_id
 * @property string $tsth_datetime
 *
 * Relations of table "tsth_status_history" available as properties of the model:
 * @property TsttStatus $tsthTstt
 * @property PprsPerson $tsthPprs
 * @property TtskTask $tsthTtsk
 */
abstract class BaseTsthStatusHistory extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'tsth_status_history';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('tsth_ttsk_id', 'required'),
                array('tsth_tstt_id, tsth_pprs_id, tsth_datetime', 'default', 'setOnEmpty' => true, 'value' => null),
                array('tsth_tstt_id, tsth_pprs_id', 'numerical', 'integerOnly' => true),
                array('tsth_ttsk_id', 'length', 'max' => 10),
                array('tsth_datetime', 'safe'),
                array('tsth_id, tsth_ttsk_id, tsth_tstt_id, tsth_pprs_id, tsth_datetime', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->tsth_ttsk_id;
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
                'tsthTstt' => array(self::BELONGS_TO, 'TsttStatus', 'tsth_tstt_id'),
                'tsthPprs' => array(self::BELONGS_TO, 'PprsPerson', 'tsth_pprs_id'),
                'tsthTtsk' => array(self::BELONGS_TO, 'TtskTask', 'tsth_ttsk_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'tsth_id' => Yii::t('D2tasksModule.model', 'Tsth'),
            'tsth_ttsk_id' => Yii::t('D2tasksModule.model', 'Tsth Ttsk'),
            'tsth_tstt_id' => Yii::t('D2tasksModule.model', 'Tsth Tstt'),
            'tsth_pprs_id' => Yii::t('D2tasksModule.model', 'Tsth Pprs'),
            'tsth_datetime' => Yii::t('D2tasksModule.model', 'Tsth Datetime'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.tsth_id', $this->tsth_id, true);
        $criteria->compare('t.tsth_ttsk_id', $this->tsth_ttsk_id);
        $criteria->compare('t.tsth_tstt_id', $this->tsth_tstt_id);
        $criteria->compare('t.tsth_pprs_id', $this->tsth_pprs_id);
        $criteria->compare('t.tsth_datetime', $this->tsth_datetime, true);


        return $criteria;

    }

}
