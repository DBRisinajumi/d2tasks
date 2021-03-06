<?php

// auto-loading
Yii::setPathOfAlias('TtskTask', dirname(__FILE__));
Yii::import('TtskTask.*');

class TtskTask extends BaseTtskTask
{

    public $prev_ttsk_tstt_id = null;
    public $person_list;
    public $tcmn_date_range;
    
    public $ccmp_name;
    
    
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
        return (string) $this->ttsk_name;
    }

    public function behaviors() {
        
        $behaviors = parent::behaviors();
        
        //auditrail  
        if(isset(Yii::app()->getModule('d2tasks')->options['audittrail']) 
            && Yii::app()->getModule('d2tasks')->options['audittrail'])
        { 
            $behaviors = array_merge(
                $behaviors, array(
            'LoggableBehavior' => array(
                'class' => 'LoggableBehavior'
            ),
        ));            
        }
        
        return $behaviors;
    }

    public function rules()
    {
        return array_merge(
                parent::rules(),
                array(
                    array('ttsk_ccmp_id,ttsk_pprs_id','PprsOrCcmpRequired',Yii::t('D2tasksModule.model', 'Company or person is required')),
                    array('ttsk_ccmp_id, ttsk_name, ttsk_description, ttsk_tstt_id, person_list,tcmn_date_range', 'safe', 'on' => 'search_ext'),
                )    
        );
    }

    public function relations()
    {
        return array_merge(
            parent::relations(), array(
                'personList'=>array(self::STAT,  'TprsPersons', 'tprs_ttsk_id', 'select' => 'GROUP_CONCAT(concat(pprs_second_name," ",pprs_first_name) SEPARATOR ", ")','join'=>' inner join pprs_person on tprs_pprs_id = pprs_id'),                
                'minPlanDate'=>array(self::STAT,  'TcmnCommunication', 'tcmn_ttsk_id', 'select' => 'MIN(tcmn_datetime)','condition'=>'tcmn_tcst_id = 1'),                
            )
        );
    }    

    
    public function searchCriteria($criteria = null)
    {
        if (is_null($criteria)) {
            $criteria = new CDbCriteria;
        }

        if(!empty($this->person_list)){
            $criteria->join .= ' inner join tprs_persons  on ttsk_id = tprs_ttsk_id ';
            $criteria->compare('tprs_pprs_id', $this->person_list);
        }
        
         if(!empty($this->tcmn_date_range)){
            $criteria->join .= ' inner join tcmn_communication  on ttsk_id = tcmn_ttsk_id ';             
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
    
    public function PprsOrCcmpRequired(){
        if(empty($this->ttsk_ccmp_id) && empty($this->ttsk_pprs_id)){
            return false;
        }
        
        return true;
    }
    
    public function beforeSave() {
        
        if ($this->isNewRecord)
            $this->prev_ttsk_tstt_id = null;
        else {
            //remeber actual status
            $curr = self::findByPk($this->primaryKey);
            $this->prev_ttsk_tstt_id = $curr->ttsk_tstt_id;
        }    

        return parent::beforeSave();
    }    

    public function afterSave() {
        
        //registre status changes
        if(!empty($this->prev_ttsk_tstt_id) && $this->prev_ttsk_tstt_id != $this->ttsk_tstt_id){
            $tsth = new TsthStatusHistory();
            $tsth->tsth_ttsk_id = $this->primaryKey;
            $tsth->tsth_tstt_id = $this->ttsk_tstt_id;
            $tsth->save();
        }
        parent::afterSave();
    }
    
    protected function beforeFind() {

        $criteria = new CDbCriteria;
        $criteria->select .= ",ccmp_name ";
        $criteria->join .= " inner join ccmp_company on ttsk_ccmp_id = ccmp_id ";
        $criteria->compare('ccmp_sys_ccmp_id', Yii::app()->sysCompany->getActiveCompany());

        $this->dbCriteria->mergeWith($criteria);

        parent::beforeFind();
    }

    public function count($condition='',$params=array())
    {
        $criteria = new CDbCriteria;
        $criteria->join .= " inner join ccmp_company on ttsk_ccmp_id = ccmp_id ";
        $criteria->compare('ccmp_sys_ccmp_id', Yii::app()->sysCompany->getActiveCompany());

        $criteria->mergeWith($condition);
        
        return parent::count($criteria,$params);
    }    
    
}
