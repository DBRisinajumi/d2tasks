<?php

/**
 * This is the model base class for the table "tcsh_comminication_status_history".
 *
 * Columns in table "tcsh_comminication_status_history" available as properties of the model:
 * @property string $tcsh_id
 * @property string $tcsh_tcmn_id
 * @property integer $tcsh_tcst_id
 * @property integer $tcsh_pprs_id
 * @property string $tcsh_datetime
 *
 * Relations of table "tcsh_comminication_status_history" available as properties of the model:
 * @property TcstCommunicationStatus $tcshTcst
 * @property TcmnCommunication $tcshTcmn
 * @property PprsPerson $tcshPprs
 */
abstract class BaseTcshComminicationStatusHistory extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'tcsh_comminication_status_history';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('tcsh_tcmn_id, tcsh_tcst_id, tcsh_pprs_id, tcsh_datetime', 'required'),
                array('tcsh_tcst_id, tcsh_pprs_id', 'numerical', 'integerOnly' => true),
                array('tcsh_tcmn_id', 'length', 'max' => 10),
                array('tcsh_id, tcsh_tcmn_id, tcsh_tcst_id, tcsh_pprs_id, tcsh_datetime', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->tcsh_tcmn_id;
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
                'tcshTcst' => array(self::BELONGS_TO, 'TcstCommunicationStatus', 'tcsh_tcst_id'),
                'tcshTcmn' => array(self::BELONGS_TO, 'TcmnCommunication', 'tcsh_tcmn_id'),
                'tcshPprs' => array(self::BELONGS_TO, 'PprsPerson', 'tcsh_pprs_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'tcsh_id' => Yii::t('D2tasksModule.model', 'Tcsh'),
            'tcsh_tcmn_id' => Yii::t('D2tasksModule.model', 'Tcsh Tcmn'),
            'tcsh_tcst_id' => Yii::t('D2tasksModule.model', 'Tcsh Tcst'),
            'tcsh_pprs_id' => Yii::t('D2tasksModule.model', 'Tcsh Pprs'),
            'tcsh_datetime' => Yii::t('D2tasksModule.model', 'Tcsh Datetime'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.tcsh_id', $this->tcsh_id, true);
        $criteria->compare('t.tcsh_tcmn_id', $this->tcsh_tcmn_id);
        $criteria->compare('t.tcsh_tcst_id', $this->tcsh_tcst_id);
        $criteria->compare('t.tcsh_pprs_id', $this->tcsh_pprs_id);
        $criteria->compare('t.tcsh_datetime', $this->tcsh_datetime, true);


        return $criteria;

    }

}
