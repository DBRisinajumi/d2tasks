<?php
if (!$ajax) {
    $this->setPageTitle(Yii::t('D2tasksModule.model', 'Projects list'));
    Yii::app()->clientScript->registerScript('re-install-date-picker', "
        function reinstallDatePicker(id, data) {
            filter_TtskTask_tcmn_date_range_init();
           }
");
    ?>

    <div class="clearfix">
        <div class="btn-toolbar pull-left">
            <div class="btn-group">
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => Yii::t('D2tasksModule.crud', 'Create'),
                    'icon' => 'icon-plus',
                    'size' => 'large',
                    'type' => 'success',
                    'url' => array('create'),
                    'visible' => (Yii::app()->user->checkAccess('D2tasks.TtskTask.*') || Yii::app()->user->checkAccess('D2tasks.TtskTask.Create'))
                ));
                ?>
            </div>
            <div class="btn-group">
                <h1>
                    <i class="icon-tasks"></i>
                    <?php echo Yii::t('D2tasksModule.model', 'Projects'); ?>            </h1>
            </div>
        </div>
    </div>

    <?php


Yii::beginProfile('TtskTask.view.grid');
}
$this->widget('TbGridView', array(
    'id' => 'ttsk-task-grid',
    'dataProvider' => $model->search(),
    'filter' => $model,
    #'responsiveTable' => true,
    'template' => '{summary}{pager}{items}{pager}',
    'pager' => array(
        'class' => 'TbPager',
        'displayFirstAndLast' => true,
    ),
    'afterAjaxUpdate' => 'reinstallDatePicker',
    'columns' => array(
        array(
            'header' => Yii::t('D2tasksModule.model', 'Client'),
            'name' => 'ttsk_ccmp_id',
            'value' => '$data->ttskCcmp->ccmp_name',
            'filter' => CHtml::listData(CcmpCompany::model()->findAll(array('order'=>'ccmp_name')), 'ccmp_id', 'itemLabel'),            
        ),
        array(
            'name' => 'ttsk_name',
        ),
        array(
            'name' => 'ttsk_description',
        ),
        array(
            //'class' => 'editable.EditableColumn',
            'name' => 'ttsk_tstt_id',
            'value' => '$data->ttskTstt->itemLabel',
//                'editable' => array(
//                    'type' => 'select',
//                    'url' => $this->createUrl('/d2tasks/ttskTask/editableSaver'),
//                    'source' => CHtml::listData(TsttStatus::model()->findAll(array('limit' => 1000)), 'tstt_id', 'itemLabel'),
//                    //'placement' => 'right',
//                ),
            'filter' => CHtml::listData(TsttStatus::model()->findAll(array('limit' => 1000)), 'tstt_id', 'itemLabel'),
        ),
        array(
            'header' => Yii::t('D2tasksModule.model', 'Person'),
            'name' => 'person_list',
            'value' => '$data->personList',
            'filter' => CHtml::listData(PprsPerson::model()->getSysCompanyPersons(), 'pprs_id', 'itemLabel'),
        ),
        array(
            'header' => Yii::t('D2tasksModule.model', 'Communication Plan Date'),
            'value' => '$data->minPlanDate',
            'filter' => $this->widget('vendor.dbrisinajumi.DbrLib.widgets.TbFilterDateRangePicker', array(
                'model' => $model,
                'attribute' => 'tcmn_date_range',
                'options' => array(
                    'ranges' => array('today', 'yesterday', 'this_week', 'last_week', 'this_month', 'last_month', 'this_year'),
                )
                    ), TRUE),
        ),
        array(
            'class' => 'TbButtonColumn',
            'buttons' => array(
                'view' => array('visible' => 'Yii::app()->user->checkAccess("D2tasks.TtskTask.View")'),
                'update' => array('visible' => 'FALSE'),
                //'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2tasks.TtskTask.Delete")'),
                'delete' => array('visible' => 'FALSE'),
            ),
            'viewButtonUrl' => 'Yii::app()->controller->createUrl("view", array("ttsk_id" => $data->ttsk_id))',
            'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete", array("ttsk_id" => $data->ttsk_id))',
            'deleteConfirmation' => Yii::t('D2tasksModule.crud', 'Do you want to delete this item?'),
            'viewButtonOptions' => array('data-toggle' => 'tooltip'),
            'deleteButtonOptions' => array('data-toggle' => 'tooltip'),
        ),
    )
        )
);
if (!$ajax) {
    Yii::endProfile('TtskTask.view.grid');
}    
