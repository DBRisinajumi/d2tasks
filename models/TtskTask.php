<?php

// auto-loading
Yii::setPathOfAlias('TtskTask', dirname(__FILE__));
Yii::import('TtskTask.*');

class TtskTask extends BaseTtskTask
{

    public $prev_ttsk_tstt_id = null;
    public $person_list;
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
        return (string) $this->ttsk_name;
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
    
}
