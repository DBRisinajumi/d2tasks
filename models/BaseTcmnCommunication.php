<?php

/**
 * This is the model base class for the table "tcmn_communication".
 *
 * Columns in table "tcmn_communication" available as properties of the model:
 * @property string $tcmn_id
 * @property string $tcmn_ttsk_id
 * @property integer $tcmn_pprs_id
 * @property integer $tcmn_client_pprs_id
 * @property string $tcmn_task
 * @property string $tcmn_result
 * @property integer $tcmn_tcst_id
 * @property string $tcmn_datetime
 * @property integer $tcmn_tmed_id
 *
 * Relations of table "tcmn_communication" available as properties of the model:
 * @property TtskTask $tcmnTtsk
 * @property PprsPerson $tcmnPprs
 * @property PprsPerson $tcmnClientPprs
 * @property TcstCommunicationStatus $tcmnTcst
 * @property TmedMedia $tcmnTmed
 * @property TcshComminicationStatusHistory[] $tcshComminicationStatusHistories
 */
abstract class BaseTcmnCommunication extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'tcmn_communication';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('tcmn_ttsk_id, tcmn_task, tcmn_tcst_id, tcmn_datetime', 'required'),
                array('tcmn_pprs_id, tcmn_client_pprs_id, tcmn_result, tcmn_tmed_id', 'default', 'setOnEmpty' => true, 'value' => null),
                array('tcmn_pprs_id, tcmn_client_pprs_id, tcmn_tcst_id, tcmn_tmed_id', 'numerical', 'integerOnly' => true),
                array('tcmn_ttsk_id', 'length', 'max' => 10),
                array('tcmn_result', 'safe'),
                array('tcmn_id, tcmn_ttsk_id, tcmn_pprs_id, tcmn_client_pprs_id, tcmn_task, tcmn_result, tcmn_tcst_id, tcmn_datetime, tcmn_tmed_id', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->tcmn_ttsk_id;
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
                'tcmnTtsk' => array(self::BELONGS_TO, 'TtskTask', 'tcmn_ttsk_id'),
                'tcmnPprs' => array(self::BELONGS_TO, 'PprsPerson', 'tcmn_pprs_id'),
                'tcmnClientPprs' => array(self::BELONGS_TO, 'PprsPerson', 'tcmn_client_pprs_id'),
                'tcmnTcst' => array(self::BELONGS_TO, 'TcstCommunicationStatus', 'tcmn_tcst_id'),
                'tcmnTmed' => array(self::BELONGS_TO, 'TmedMedia', 'tcmn_tmed_id'),
                'tcshComminicationStatusHistories' => array(self::HAS_MANY, 'TcshComminicationStatusHistory', 'tcsh_tcmn_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'tcmn_id' => Yii::t('D2tasksModule.model', 'Tcmn'),
            'tcmn_ttsk_id' => Yii::t('D2tasksModule.model', 'Tcmn Ttsk'),
            'tcmn_pprs_id' => Yii::t('D2tasksModule.model', 'Tcmn Pprs'),
            'tcmn_client_pprs_id' => Yii::t('D2tasksModule.model', 'Tcmn Client Pprs'),
            'tcmn_task' => Yii::t('D2tasksModule.model', 'Tcmn Task'),
            'tcmn_result' => Yii::t('D2tasksModule.model', 'Tcmn Result'),
            'tcmn_tcst_id' => Yii::t('D2tasksModule.model', 'Tcmn Tcst'),
            'tcmn_datetime' => Yii::t('D2tasksModule.model', 'Tcmn Datetime'),
            'tcmn_tmed_id' => Yii::t('D2tasksModule.model', 'Tcmn Tmed'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.tcmn_id', $this->tcmn_id, true);
        $criteria->compare('t.tcmn_ttsk_id', $this->tcmn_ttsk_id);
        $criteria->compare('t.tcmn_pprs_id', $this->tcmn_pprs_id);
        $criteria->compare('t.tcmn_client_pprs_id', $this->tcmn_client_pprs_id);
        $criteria->compare('t.tcmn_task', $this->tcmn_task, true);
        $criteria->compare('t.tcmn_result', $this->tcmn_result, true);
        $criteria->compare('t.tcmn_tcst_id', $this->tcmn_tcst_id);
        $criteria->compare('t.tcmn_datetime', $this->tcmn_datetime, true);
        $criteria->compare('t.tcmn_tmed_id', $this->tcmn_tmed_id);


        return $criteria;

    }

}
