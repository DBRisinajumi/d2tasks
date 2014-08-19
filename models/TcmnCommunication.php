<?php

// auto-loading
Yii::setPathOfAlias('TcmnCommunication', dirname(__FILE__));
Yii::import('TcmnCommunication.*');

class TcmnCommunication extends BaseTcmnCommunication
{
    
     public $task_name;
     public $tcmn_date_range;

    // Add your model-specific methods here. This file will not be overriden by gtc except you force it.
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function init()
    {
        return parent::init();
    }
    
    public function getItemLabel()
    {
        return parent::getItemLabel();
    }

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            array()
        );
    }

    public function rules()
    {
        return array_merge(
            parent::rules(),
            array(
                array('task_name,tcmn_date_range', 'safe', 'on'=>'search'),
            )
        );
    }

    public function attributeLabels()
    {
        return array_merge(
            parent::attributeLabels(),
            array(
                'task_name' => Yii::t('D2tasksModule.model', 'Task Name')
                )
        );
    }    
    
    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        if(!empty($this->task_name)){
            $criteria->join .= ' inner join ttsk_task  on tcmn_ttsk_id = ttsk_id ';
            $criteria->compare('ttsk_name', $this->task_name,true);
        }
        
        if(!empty($this->tcmn_date_range)){
            $criteria->AddCondition("tcmn_datetime >= '".substr($this->tcmn_date_range,0,10)."'");
            $criteria->AddCondition("tcmn_datetime <= '".substr($this->tcmn_date_range,-10)."'");    
            
        }        

        return parent::searchCriteria($criteria);

    }       
    
    public function search($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }
        
        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $this->searchCriteria($criteria),
        ));
    }

}
