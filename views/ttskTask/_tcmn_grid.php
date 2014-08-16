<?php
    $tcmn_model = new TcmnCommunication();
    $tcmn_model->tcmn_ttsk_id = $model->primaryKey;

    // render grid view
    $this->widget('TbGridView',
        array(
            'id' => 'tcmn-communication-grid',
            'dataProvider' => $tcmn_model->search(),
            'template' => '{summary}{items}',
            'summaryText' => '&nbsp;',
            'htmlOptions' => array(
                'class' => 'rel-grid-view'
            ),            
            'columns' => array(
                array(
                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_pprs_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2tasks/tcmnCommunication/editableSaver'),
                    'source' => CHtml::listData(PprsPerson::model()->getSysCompanyPersons(), 'pprs_id', 'itemLabel'),
                    'placement' => 'right',
                    'htmlOptions' => array(
                        'class' => 'span6'
                    ),
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_client_pprs_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2tasks/tcmnCommunication/editableSaver'),
                    'source' => CHtml::listData(PprsPerson::model()->getCompanyPersons($model->ttsk_ccmp_id), 'pprs_id', 'itemLabel'),
                    'htmlOptions' => array(
                        'class' => 'span6'
                    ),                    
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_task',
                'editable' => array(
                    'type' => 'textarea',
                    'url' => $this->createUrl('//d2tasks/tcmnCommunication/editableSaver'),
                    'htmlOptions' => array(
                        'class' => 'span10'
                    ),                                
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_result',
                'editable' => array(
                    'type' => 'textarea',
                    'url' => $this->createUrl('//d2tasks/tcmnCommunication/editableSaver'),
                    'htmlOptions' => array(
                        'class' => 'span10'
                    ),                                       
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_tcst_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2tasks/tcmnCommunication/editableSaver'),
                    'source' => CHtml::listData(TcstCommunicationStatus::model()->findAll(array('limit' => 1000)), 'tcst_id', 'itemLabel'),
                    'htmlOptions' => array(
                        'class' => 'span3'
                    ),                    
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'TbEditableColumn',
                'name' => 'tcmn_date',
                'editable' => array(
                    //'type'        => 'combodate',
                    'url' => $this->createUrl('//d2tasks/tcmnCommunication/editableSaver'),
                    //'viewformat'  => 'YYYY-MM-DD HH', //in this format date is displayed
                    //'template' => 'YYYY-MM-DD HH', //template for dropdowns
                    //'combodate' => array('minYear' => date('Y')-1, 'maxYear' => date('Y')+1),                     
                    'options' => array(
                        'datepicker' => array(
                            'language' => 'en',
                            ),
                        
                    ),
                    

                ),
                'htmlOptions' => array(
                        'class' => 'span5'
                ),                    
                
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_tmed_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2tasks/tcmnCommunication/editableSaver'),
                    'source' => CHtml::listData(TmedMedia::model()->findAll(array('limit' => 1000)), 'tmed_id', 'itemLabel'),
                    'htmlOptions' => array(
                        'class' => 'span3'
                    ),                    
                    //'placement' => 'right',
                )
            ),

                array(
                    'class' => 'TbButtonColumn',
                    'buttons' => array(
                        'view' => array('visible' => 'FALSE'),
                        'update' => array('visible' => 'FALSE'),
                        'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2tasks.TtskTask.DeletetcmnCommunications")'),
                    ),
                    'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2tasks/tcmnCommunication/delete", array("tcmn_id" => $data->tcmn_id))',
                    'deleteConfirmation'=>Yii::t('D2tasksModule.crud','Do you want to delete this item?'),   
                    'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),                    
                    'htmlOptions' => array(
                        'class' => 'span1'
                    ),                                       
                ),
            )
        )
    );
