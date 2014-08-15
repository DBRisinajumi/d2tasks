<?php

/**
 * This is the model base class for the table "tprs_persons".
 *
 * Columns in table "tprs_persons" available as properties of the model:
 * @property string $tprs_id
 * @property string $tprs_ttsk_id
 * @property integer $tprs_pprs_id
 * @property string $tprs_notes
 *
 * Relations of table "tprs_persons" available as properties of the model:
 * @property PprsPerson $tprsPprs
 * @property TtskTask $tprsTtsk
 */
abstract class BaseTprsPersons extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'tprs_persons';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('tprs_ttsk_id', 'required'),
                array('tprs_pprs_id, tprs_notes', 'default', 'setOnEmpty' => true, 'value' => null),
                array('tprs_pprs_id', 'numerical', 'integerOnly' => true),
                array('tprs_ttsk_id', 'length', 'max' => 10),
                array('tprs_notes', 'safe'),
                array('tprs_id, tprs_ttsk_id, tprs_pprs_id, tprs_notes', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->tprs_ttsk_id;
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
                'tprsPprs' => array(self::BELONGS_TO, 'PprsPerson', 'tprs_pprs_id'),
                'tprsTtsk' => array(self::BELONGS_TO, 'TtskTask', 'tprs_ttsk_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'tprs_id' => Yii::t('D2tasksModule.model', 'Tprs'),
            'tprs_ttsk_id' => Yii::t('D2tasksModule.model', 'Tprs Ttsk'),
            'tprs_pprs_id' => Yii::t('D2tasksModule.model', 'Tprs Pprs'),
            'tprs_notes' => Yii::t('D2tasksModule.model', 'Ttsk Notes'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.tprs_id', $this->tprs_id, true);
        $criteria->compare('t.tprs_ttsk_id', $this->tprs_ttsk_id);
        $criteria->compare('t.tprs_pprs_id', $this->tprs_pprs_id);
        $criteria->compare('t.tprs_notes', $this->tprs_notes, true);


        return $criteria;

    }

}
