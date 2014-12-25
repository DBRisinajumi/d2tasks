<?php
$can_edit = Yii::app()->user->checkAccess("D2tasks.TtskTask.Update") 
        || Yii::app()->user->checkAccess("D2tasks.TtskTask.*") ;

$this->setPageTitle(Yii::t('D2tasksModule.model', 'Project details') . ': ' . $model->getItemLabel());
$cancel_buton = $this->widget("bootstrap.widgets.TbButton", array(
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
                <?php echo Yii::t('D2tasksModule.model', 'Project details'); ?>
            </h1>
        </div>
        <div class="btn-group">
            <?php
                $module_name = $this->module->id;
                if(Yii::app()->user->checkAccess("audittrail") 
                        && isset($this->module->options['audittrail']) 
                        && $this->module->options['audittrail']
                ){        
                    Yii::import('audittrail.*');
                    $this->widget("vendor.dbrisinajumi.audittrail.widgets.AudittrailViewTbButton",array(
                        'model_name' => get_class($model),
                        'model_id' => $model->getPrimaryKey(),
                    ));                        
                }          
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
        'TbAceDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'name' => 'ttsk_name',
            'type' => 'raw',
            'value' => $this->widget(
                'EditableField', array(
                    'model' => $model,
                    'attribute' => 'ttsk_name',
                    'url' => $this->createUrl('/d2tasks/ttskTask/editableSaver'),
                    'apply' => $can_edit,                    
                ), true
            )
        ),        
        array(
            'name' => 'ttsk_ccmp_id',
            'type' => 'raw',
            'value' => $can_edit?$this->widget(
                'EditableField', array(
                    'model' => $model,
                    'type' => 'select',
                    'url' => $this->createUrl('/d2tasks/ttskTask/editableSaver'),
                    'source' => CHtml::listData(CcmpCompany::model()->findAll(array('limit' => 1000)), 'ccmp_id', 'itemLabel'),
                    'attribute' => 'ttsk_ccmp_id',

                ), true
            ):$model->ttskCcmp->itemLabel,
            'value_id' => $model->ttsk_ccmp_id,
            'external_link' => array('/d2company/ccmpCompany/updateExtended','ccmp_id'=>$model->ttsk_ccmp_id),
            'external_title' => Yii::t("D2tasksModule.model",'Show Company Data'),                    
        ),

        array(
            'name' => 'ttsk_pprs_id',
            'type' => 'raw',
            'value' => $can_edit?$this->widget(
                'EditableField', array(
                    'model' => $model,
                    'type' => 'select',
                    'url' => $this->createUrl('/d2tasks/ttskTask/editableSaver'),
                    'source' => CHtml::listData(PprsPerson::model()->getSysCompanyPersons(), 'pprs_id', 'itemLabel'),
                    'attribute' => 'ttsk_pprs_id',

                ), true
            ):$model->ttskCcmp->itemLabel,
            'value_id' => $model->ttsk_pprs_id,
            'external_link' => array('/d2person/pprsPerson/view','pprs_id'=>$model->ttsk_pprs_id),
            'external_title' => Yii::t("D2tasksModule.model",'Show Person Data'),                    
        ),

        array(
            'name' => 'ttsk_description',
            'type' => 'raw',
            'value' => $this->widget(
                'EditableField', array(
                    'model' => $model,
                    'attribute' => 'ttsk_description',
                    'url' => $this->createUrl('/d2tasks/ttskTask/editableSaver'),
                    'apply' => $can_edit,
                ), true
            ).' - '
        ),
        array(
            'name' => 'ttsk_tstt_id',
            'type' => 'raw',
            'value' => $can_edit?$this->widget(
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
            ):(!empty($model->ttsk_tstt_id)?$model->ttskTstt->itemLabel:'&nbsp;')
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
if(Yii::app()->user->checkAccess("D2tasks.TcmtComments.View")){ 
    Yii::app()->clientScript->registerCss('rel_grid',' 
            .rel-grid-view div.summary {line-height: 0;}
            ');     
?>

<div class="table-header">
    <i class="icon-ticket"></i>        
    <?=Yii::t('D2tasksModule.model', 'Tasks')?>
    <?php    
    //idejas: http://www.yiiframework.com/wiki/145/cjuidialog-for-create-new-model/    
    if(Yii::app()->user->checkAccess("D2tasks.TcmtComments.Create")){ 
        $this->widget(
            'bootstrap.widgets.TbButton',
            array(
                'id' => 'button_create_tcmn',
                'buttonType' => 'link', 
                'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size' => 'mini',
                'icon' => 'icon-plus',
                'htmlOptions' => array(
                    'title' => Yii::t('D2tasksModule.crud', 'Add new record'),
                    'data-toggle' => 'tooltip',
                    'onclick'=>'js:{popupTcmnCreateForm(); $("#tcmn_create_form").dialog("open");}',
                ),                 
            )
        );        
    }
    ?>
</div>
<div class="row">
<?php 

$this->beginWidget('vendor.uldisn.ace.widgets.CJuiAceDialog',array(
    'id'=>'tcmn_create_form',
    'title' => Yii::t('D2tasksModule.model', 'Add Task'),
    //'title_icon' => 'icon-warning-sign red',
    'options'=>array(
        'resizable' => true,
        'width'=>'auto',
        'height'=>'auto',        
        'modal' => true,
        'autoOpen'=>false,
        'onclose' => 'function(event, ui) { 
                            $.fn.yiiGridView.update(\'tcmn-communication-grid\');
                                      }
                      '
    ),
));
?><div id="tcmn_create_form_html"></div><?php
$this->endWidget('vendor.uldisn.ace.widgets.CJuiAceDialog');    

    Yii::app()->clientScript->registerScript('tcmn_create_form_ajax', 
       '
           function popupTcmnCreateForm(){
            ' .
            CHtml::ajax(array(
                        'url'=>array(
                                '//d2tasks/tcmnCommunication/create',
                        ),
                        'data'=> "js:$(this).serialize()",
                        'type'=>'post',
                        'data'=>array(
                            'ajax' => 'tcmn-communication-grid',
                            'tcmn_ttsk_id'=>$model->primaryKey,
                            ),
                        'success'=>"function(data)
                        {
                            $('#tcmn_create_form_html').html(data);
                        } ",
                        ))        
            . '         
           }

       ',
       CClientScript::POS_END

    );
    Yii::beginProfile('TcmnCommunication.view.grid');
    $this->renderPartial('_tcmn_grid',array('model'=>$model));
    Yii::endProfile('TcmnCommunication.view.grid');
    ?></div><?php
    
}
?>
<?php 
$cancel_buton = $this->widget("bootstrap.widgets.TbButton", array(
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
echo $cancel_buton;