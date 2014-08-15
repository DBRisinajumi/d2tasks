<?php
$this->setPageTitle(Yii::t('D2tasksModule.model', 'Task details: ') . $model->getItemLabel());
$cancel_buton = $this->widget("bootstrap.widgets.TbButton", array(
    #"label"=>Yii::t("D2tasksModule.crud","Cancel"),
    "icon" => "chevron-left",
    "size" => "large",
    "url" => (isset($_GET["returnUrl"])) ? $_GET["returnUrl"] : array("{$this->id}/admin"),
    "visible" => (Yii::app()->user->checkAccess("D2tasks.TtskTask.*") || Yii::app()->user->checkAccess("D2tasks.TtskTask.View")),
    "htmlOptions" => array(
        "class" => "search-button",
        "data-toggle" => "tooltip",
        "title" => Yii::t("D2tasksModule.crud", "Back"),
    )
        ), true);
?>

<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <div class="btn-group"><?php echo $cancel_buton; ?></div>
        <div class="btn-group">
            <h1>
                <i class="icon-tasks"></i>
                <?php echo Yii::t('D2tasksModule.model', 'Task details'); ?>
            </h1>
        </div>
        <div class="btn-group">
            <?php
//            $this->widget("bootstrap.widgets.TbButton", array(
//                "label" => Yii::t("D2tasksModule.crud", "Delete"),
//                "type" => "danger",
//                "icon" => "icon-trash icon-white",
//                "size" => "large",
//                "htmlOptions" => array(
//                    "submit" => array("delete", "ttsk_id" => $model->{$model->tableSchema->primaryKey}, "returnUrl" => (Yii::app()->request->getParam("returnUrl")) ? Yii::app()->request->getParam("returnUrl") : $this->createUrl("admin")),
//                    "confirm" => Yii::t("D2tasksModule.crud", "Do you want to delete this item?")
//                ),
//                "visible" => (Yii::app()->request->getParam("ttsk_id")) && (Yii::app()->user->checkAccess("D2tasks.TtskTask.*") || Yii::app()->user->checkAccess("D2tasks.TtskTask.Delete"))
//            ));
            ?>
        </div>
    </div>
</div>



<div class="row">
    <div class="span4">

<?php
$this->widget(
        'TbDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'ttsk_ccmp_id',
            'type' => 'raw',
            'value' => $this->widget(
                    'EditableField', array(
                'model' => $model,
                'type' => 'select',
                'url' => $this->createUrl('/d2tasks/ttskTask/editableSaver'),
                'source' => CHtml::listData(CcmpCompany::model()->findAll(array('limit' => 1000)), 'ccmp_id', 'itemLabel'),
                'attribute' => 'ttsk_ccmp_id',
                    //'placement' => 'right',
                    ), true
            )
        ),
        array(
            'name' => 'ttsk_name',
            'type' => 'raw',
            'value' => $this->widget(
                    'EditableField', array(
                'model' => $model,
                'attribute' => 'ttsk_name',
                'url' => $this->createUrl('/d2tasks/ttskTask/editableSaver'),
                    ), true
            )
        ),
        array(
            'name' => 'ttsk_description',
            'type' => 'raw',
            'value' => $this->widget(
                    'EditableField', array(
                'model' => $model,
                'attribute' => 'ttsk_description',
                'url' => $this->createUrl('/d2tasks/ttskTask/editableSaver'),
                    ), true
            )
        ),
        array(
            'name' => 'ttsk_tstt_id',
            'type' => 'raw',
            'value' => $this->widget(
                    'EditableField', 
                    array(
                        'model' => $model,
                        'type' => 'select',
                        'url' => $this->createUrl('/d2tasks/ttskTask/editableSaver'),
                        'source' => CHtml::listData(TsttStatus::model()->findAll(array('limit' => 1000)), 'tstt_id', 'itemLabel'),
                        'attribute' => 'ttsk_tstt_id',
                        'success' => 'function(response, newValue) { 
                                        $.fn.yiiGridView.update(\'tsth-status-history-grid\');
                                      }',                        
                    //'placement' => 'right',
                    ), 
                    true
            )
        ),
    ),
));
$this->renderPartial('_tsth_grid',array('model'=>$model));

?>
        
        
    </div>

<div class="span8">
        <?php $this->renderPartial('_view-relations_grids', array('modelMain' => $model, 'ajax' => false,)); ?>    
    </div>
</div>

<?php
 
Yii::app()->clientScript->registerCss('rel_grid',' 
        .rel-grid-view div.summary {line-height: 0;}
        ');     

Yii::beginProfile('tcmn_ttsk_id.view.grid');
?>

<div class="table-header">
    <?=Yii::t('D2tasksModule.model', 'Tcmn Communication')?>
    <?php    
        
    $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'buttonType' => 'ajaxButton', 
            'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'mini',
            'icon' => 'icon-plus',
            'url' => array(
                '//d2tasks/tcmnCommunication/ajaxCreate',
                'field' => 'tcmn_ttsk_id',
                'value' => $model->primaryKey,
                'ajax' => 'tcmn-communication-grid',
            ),
            'ajaxOptions' => array(
                    'success' => 'function(html) {$.fn.yiiGridView.update(\'tcmn-communication-grid\');}'
                    ),
            'htmlOptions' => array(
                'title' => Yii::t('D2tasksModule.crud', 'Add new record'),
                'data-toggle' => 'tooltip',
            ),                 
        )
    );        
    ?>
</div>
<div class="row">
<?php 

if (empty($model->tcmnCommunications)) {
    $tcmn_model = new TcmnCommunication;
    $tcmn_model->tcmn_ttsk_id = $model->primaryKey;
    $tcmn_model->save();
    unset($tcmn_model);
} 
    
$this->renderPartial('_tcmn_grid',array('model'=>$model));
Yii::endProfile('TcmnCommunication.view.grid');

?>
</div>
<?php echo $cancel_buton; ?>