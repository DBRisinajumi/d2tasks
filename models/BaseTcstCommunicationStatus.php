<?php

/**
 * This is the model base class for the table "tcst_communication_status".
 *
 * Columns in table "tcst_communication_status" available as properties of the model:
 * @property integer $tcst_id
 * @property string $tcst_name
 * @property string $tcst_icon
 *
 * Relations of table "tcst_communication_status" available as properties of the model:
 * @property TcmnCommunication[] $tcmnCommunications
 * @property TcshComminicationStatusHistory[] $tcshComminicationStatusHistories
 */
abstract class BaseTcstCommunicationStatus extends CActiveRecord
{

    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'tcst_communication_status';
    }

    public function rules()
    {
        return array_merge(
            parent::rules(), array(
                array('tcst_name, tcst_icon', 'default', 'setOnEmpty' => true, 'value' => null),
                array('tcst_name, tcst_icon', 'length', 'max' => 50),
                array('tcst_id, tcst_name, tcst_icon', 'safe', 'on' => 'search'),
            )
        );
    }

    public function getItemLabel()
    {
        return (string) $this->tcst_name;
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
                'tcmnCommunications' => array(self::HAS_MANY, 'TcmnCommunication', 'tcmn_tcst_id'),
                'tcshComminicationStatusHistories' => array(self::HAS_MANY, 'TcshComminicationStatusHistory', 'tcsh_tcst_id'),
            )
        );
    }

    public function attributeLabels()
    {
        return array(
            'tcst_id' => Yii::t('D2tasksModule.model', 'Tcst'),
            'tcst_name' => Yii::t('D2tasksModule.model', 'Tcst Name'),
            'tcst_icon' => Yii::t('D2tasksModule.model', 'Tcst Icon'),
        );
    }

    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        $criteria->compare('t.tcst_id', $this->tcst_id);
        $criteria->compare('t.tcst_name', $this->tcst_name, true);
        $criteria->compare('t.tcst_icon', $this->tcst_icon, true);


        return $criteria;

    }

}
