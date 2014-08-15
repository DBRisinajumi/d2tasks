<?php

/**
 * This is the model base class for the table "ttsk_task".
 *
 * Columns in table "ttsk_task" available as properties of the model:
 * @property string $ttsk_id
 * @property string $ttsk_ccmp_id
 * @property string $ttsk_name
 * @property string $ttsk_description
 * @property integer $ttsk_tstt_id
 *
 * Relations of table "ttsk_task" available as properties of the model:
 * @property TcmnCommunication[] $tcmnCommunications
 * @property TcmtComments[] $tcmtComments
 * @property TprsPersons[] $tprsPersons
 * @property TsthStatusHistory[] $tsthStatusHistories
 * @property TsttStatus $ttskTstt
 * @property CcmpCompany $ttskCcmp
 */
abstract class BaseTtskTask extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'ttsk_task';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('ttsk_ccmp_id, ttsk_name', 'required'),
                array('ttsk_description, ttsk_tstt_id', 'default', 'setOnEmpty' => true, 'value' => null),
                array('ttsk_tstt_id', 'numerical', 'integerOnly' => true),
                array('ttsk_ccmp_id', 'length', 'max' => 10),
                array('ttsk_name', 'length', 'max' => 256),
                array('ttsk_description', 'safe'),
                array('ttsk_id, ttsk_ccmp_id, ttsk_name, ttsk_description, ttsk_tstt_id', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->ttsk_ccmp_id;
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
                'tcmnCommunications' => array(self::HAS_MANY, 'TcmnCommunication', 'tcmn_ttsk_id'),
                'tcmtComments' => array(self::HAS_MANY, 'TcmtComments', 'tcmt_ttsk_id'),
                'tprsPersons' => array(self::HAS_MANY, 'TprsPersons', 'tprs_ttsk_id'),
                'tsthStatusHistories' => array(self::HAS_MANY, 'TsthStatusHistory', 'tsth_ttsk_id'),
                'ttskTstt' => array(self::BELONGS_TO, 'TsttStatus', 'ttsk_tstt_id'),
                'ttskCcmp' => array(self::BELONGS_TO, 'CcmpCompany', 'ttsk_ccmp_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'ttsk_id' => Yii::t('D2tasksModule.model', 'Ttsk'),
            'ttsk_ccmp_id' => Yii::t('D2tasksModule.model', 'Ttsk Ccmp'),
            'ttsk_name' => Yii::t('D2tasksModule.model', 'Ttsk Name'),
            'ttsk_description' => Yii::t('D2tasksModule.model', 'Ttsk Description'),
            'ttsk_tstt_id' => Yii::t('D2tasksModule.model', 'Ttsk Tstt'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.ttsk_id', $this->ttsk_id, true);
        $criteria->compare('t.ttsk_ccmp_id', $this->ttsk_ccmp_id);
        $criteria->compare('t.ttsk_name', $this->ttsk_name, true);
        $criteria->compare('t.ttsk_description', $this->ttsk_description, true);
        $criteria->compare('t.ttsk_tstt_id', $this->ttsk_tstt_id);


        return $criteria;

    }

}
