<?php
    $can_edit = (boolean)Yii::app()->user->checkAccess("D2tasks.TcmnCommunication.Update");  
    $bft = (!$can_edit)?'false':'true';
    
    $tcmn_model = new TcmnCommunication();
    $tcmn_model->tcmn_ttsk_id = $model->primaryKey;

    // render grid view
    $this->widget('TbGridView',
        array(
            'id' => 'tcmn-communication-grid',
            'dataProvider' => $tcmn_model->search(),
            'template' => '{summary}{items}',
             'rowCssClassExpression' => '$data->tcmnTcst->tcst_css_class',
            'summaryText' => '&nbsp;',
            'htmlOptions' => array(
                'class' => 'rel-grid-view'
            ),            
            'columns' => array(
                array(
                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_pprs_id',
                'value' => !$can_edit?'!empty($data->tcmn_pprs_id)?$data->tcmnPprs->itemLabel:" - "':'' ,   
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2tasks/tcmnCommunication/editableSaver'),
                    'source' => CHtml::listData(PprsPerson::model()->getSysCompanyPersons(), 'pprs_id', 'itemLabel'),
                    'placement' => 'right',
                    'apply' => $can_edit,
                ),
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_client_pprs_id',
                'value' => !$can_edit?'!empty($data->tcmn_client_pprs_id)?$data->tcmnClientPprs->itemLabel:" - "':'' ,                   
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2tasks/tcmnCommunication/editableSaver'),
                    'source' => CHtml::listData(PprsPerson::model()->getCompanyPersons($model->ttsk_ccmp_id), 'pprs_id', 'itemLabel'),
                    'apply' => $can_edit,                    
                ),
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_task',
                'editable' => array(
                    'type' => 'textarea',
                    'url' => $this->createUrl('//d2tasks/tcmnCommunication/editableSaver'),
                    'apply' => $can_edit,     
                ),    
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_result',
                'editable' => array(
                    'type' => 'textarea',
                    'url' => $this->createUrl('//d2tasks/tcmnCommunication/editableSaver'),
                    'apply' => $can_edit,                    
                ),
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_tcst_id',
                'value' => '!empty($data->tcmn_tcst_id)?$data->tcmnTcst->itemLabel:" - "' ,                   
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2tasks/tcmnCommunication/editableSaver'),
                    'source' => CHtml::listData(TcstCommunicationStatus::model()->findAll(), 'tcst_id', 'itemLabel'),
                    'apply' => $can_edit,                    
                ),
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_datetime',
                'editable' => array(
                    'type'        => 'datetime',
                    'url' => $this->createUrl('//d2tasks/tcmnCommunication/editableSaver'),
                    'apply' => $can_edit,                    
                ),
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_tmed_id',
                'value' => '!empty($data->tcmn_tmed_id)?$data->tcmnTmed->itemLabel:" - "',
                'type' => 'raw',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2tasks/tcmnCommunication/editableSaver'),
                    'source' => CHtml::listData(TmedMedia::model()->findAll(array('limit' => 1000)), 'tmed_id', 'itemLabel'),
                    'apply' => $can_edit,
                ),
            ),

//                array(
//                    'class' => 'TbButtonColumn',
//                    'buttons' => array(
//                        'view' => array('visible' => 'FALSE'),
//                        'update' => array('visible' => 'FALSE'),
//                        'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2tasks.TtskTask.DeletetcmnCommunications")'),
//                    ),
//                    'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2tasks/tcmnCommunication/delete", array("tcmn_id" => $data->tcmn_id))',
//                    'deleteConfirmation'=>Yii::t('D2tasksModule.crud','Do you want to delete this item?'),   
//                    'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),                    
//                    'htmlOptions' => array(
//                        'class' => 'span1'
//                    ),                                       
//                ),
            )
        )
    );
