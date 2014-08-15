<?php

/**
 * This is the model base class for the table "tcmt_comments".
 *
 * Columns in table "tcmt_comments" available as properties of the model:
 * @property string $tcmt_id
 * @property string $tcmt_ttsk_id
 * @property integer $tcmt_pprs_id
 * @property string $tcmt_datetime
 * @property string $tcmt_notes
 *
 * Relations of table "tcmt_comments" available as properties of the model:
 * @property PprsPerson $tcmtPprs
 * @property TtskTask $tcmtTtsk
 */
abstract class BaseTcmtComments extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'tcmt_comments';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('tcmt_ttsk_id', 'required'),
                array('tcmt_pprs_id, tcmt_datetime, tcmt_notes', 'default', 'setOnEmpty' => true, 'value' => null),
                array('tcmt_pprs_id', 'numerical', 'integerOnly' => true),
                array('tcmt_ttsk_id', 'length', 'max' => 10),
                array('tcmt_datetime, tcmt_notes', 'safe'),
                array('tcmt_id, tcmt_ttsk_id, tcmt_pprs_id, tcmt_datetime, tcmt_notes', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->tcmt_ttsk_id;
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
                'tcmtPprs' => array(self::BELONGS_TO, 'PprsPerson', 'tcmt_pprs_id'),
                'tcmtTtsk' => array(self::BELONGS_TO, 'TtskTask', 'tcmt_ttsk_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'tcmt_id' => Yii::t('D2tasksModule.model', 'Tcmt'),
            'tcmt_ttsk_id' => Yii::t('D2tasksModule.model', 'Tcmt Ttsk'),
            'tcmt_pprs_id' => Yii::t('D2tasksModule.model', 'Tcmt Pprs'),
            'tcmt_datetime' => Yii::t('D2tasksModule.model', 'Tcmt Datetime'),
            'tcmt_notes' => Yii::t('D2tasksModule.model', 'Tcmt Notes'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.tcmt_id', $this->tcmt_id, true);
        $criteria->compare('t.tcmt_ttsk_id', $this->tcmt_ttsk_id);
        $criteria->compare('t.tcmt_pprs_id', $this->tcmt_pprs_id);
        $criteria->compare('t.tcmt_datetime', $this->tcmt_datetime, true);
        $criteria->compare('t.tcmt_notes', $this->tcmt_notes, true);


        return $criteria;

    }

}
