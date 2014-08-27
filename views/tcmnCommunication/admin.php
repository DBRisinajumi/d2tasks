<?php
if(!$ajax){
$this->setPageTitle(Yii::t('D2tasksModule.model', 'Tasks'));
Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    filter_TcmnCommunication_tcmn_date_range_init();
   }
");
?>

<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <div class="btn-group">
        <?php 
        $this->widget('bootstrap.widgets.TbButton', array(
             'label'=>Yii::t('D2tasksModule.crud','Create'),
             'icon'=>'icon-plus',
             'size'=>'large',
             'type'=>'success',
             'url'=>array('create'),
             'visible'=>(Yii::app()->user->checkAccess('D2tasks.TcmnCommunication.*') || Yii::app()->user->checkAccess('D2tasks.TcmnCommunication.Create'))
        ));  
        ?>
</div>
        <div class="btn-group">
            <h1>
                 <i class="icon-ticket"></i>     
                <?php echo Yii::t('D2tasksModule.model', 'Tasks');?>
            </h1>
        </div>
    </div>
</div>

<?php Yii::beginProfile('TcmnCommunication.view.grid'); 
}
$this->widget('TbGridView',
    array(
        'id' => 'tcmn-communication-grid',
        'dataProvider' => $model->search(),
        'filter' => $model,
        #'responsiveTable' => true,
        'rowCssClassExpression' => '$data->tcmnTcst->tcst_css_class',
        'template' => '{summary}{pager}{items}{pager}',
        'pager' => array(
            'class' => 'TbPager',
            'displayFirstAndLast' => true,
        ),
        'afterAjaxUpdate' => 'reinstallDatePicker', 
        'columns' => array(
            array(
                'header' => Yii::t('D2tasksModule.model', 'Client'),
                'value' => '$data->tcmnTtsk->ttskCcmp->itemLabel',
                'name' => 'tcmn_ttsk_id',
                'filter' => CHtml::listData(CcmpCompany::model()->findAll(array('order'=>'ccmp_name')), 'ccmp_id', 'itemLabel'),
            ),
            array(
                'header' => Yii::t('D2tasksModule.model', 'Project'),
                'name' => 'task_name',
                'value' => '$data->tcmnTtsk->ttsk_name',
                //'filter'=> CHtml::activeTextField($model, 'varFullname'),
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_pprs_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2tasks/tcmnCommunication/editableSaver'),
                    'source' => CHtml::listData(PprsPerson::model()->findAll(array('limit' => 1000)), 'pprs_id', 'itemLabel'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_client_pprs_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2tasks/tcmnCommunication/editableSaver'),
                    'source' => CHtml::listData(PprsPerson::model()->findAll(array('limit' => 1000)), 'pprs_id', 'itemLabel'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_task',
                'editable' => array(
                    'type' => 'textarea',
                    'url' => $this->createUrl('/d2tasks/tcmnCommunication/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_result',
                'editable' => array(
                    'type' => 'textarea',
                    'url' => $this->createUrl('/d2tasks/tcmnCommunication/editableSaver'),
                    //'placement' => 'right',
                )
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_tcst_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2tasks/tcmnCommunication/editableSaver'),
                    'source' => CHtml::listData(TcstCommunicationStatus::model()->findAll(array('limit' => 1000)), 'tcst_id', 'itemLabel'),
                    //'placement' => 'right',
                ),
                'filter'=> CHtml::listData(TcstCommunicationStatus::model()->findAll(array('limit' => 1000)), 'tcst_id', 'itemLabel'),
            ),
            array(
//                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_datetime',
//                'editable' => array(
//                    'type' => 'date',
//                    'url' => $this->createUrl('/d2tasks/tcmnCommunication/editableSaver'),
//                    //'placement' => 'right',
//                ),
                'filter' => $this->widget('vendor.dbrisinajumi.DbrLib.widgets.TbFilterDateRangePicker', 
                     array(
                        'model' => $model,
                        'attribute' => 'tcmn_date_range',
                        'options' => array(
                            'ranges' => array('today','yesterday','this_week','last_week','this_month','last_month','this_year'),
                        ) 
                    ), TRUE ),                
            ),

            array(
                'class' => 'editable.EditableColumn',
                'name' => 'tcmn_tmed_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('/d2tasks/tcmnCommunication/editableSaver'),
                    'source' => CHtml::listData(TmedMedia::model()->findAll(array('limit' => 1000)), 'tmed_id', 'itemLabel'),
                    //'placement' => 'right',
                ),
                'filter' => CHtml::listData(TmedMedia::model()->findAll(array('limit' => 1000)), 'tmed_id', 'itemLabel'),
            ),


            array(
                'class' => 'TbButtonColumn',
                'buttons' => array(
                    'view' => array('visible' => 'Yii::app()->user->checkAccess("D2tasks.TcmnCommunication.View")'),
                    'update' => array('visible' => 'FALSE'),
                    'delete' => array('visible' => 'FALSE'),
                ),
                'viewButtonUrl' => 'Yii::app()->controller->createUrl("ttskTask/view", array("ttsk_id" => $data->tcmn_ttsk_id))',
                'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("tcmn_id" => $data->tcmn_id))',
                'deleteConfirmation'=>Yii::t('D2tasksModule.crud','Do you want to delete this item?'),                    
                'viewButtonOptions'=>array('data-toggle'=>'tooltip'),   
                'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),   
            ),
        )
    )
);

if(!$ajax){
    Yii::endProfile('TcmnCommunication.view.grid');
}