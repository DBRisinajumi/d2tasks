<?php

if(!$ajax || $ajax == 'tcmt-comments-grid'){
    Yii::beginProfile('tcmt_ttsk_id.view.grid');
    
    
    $this->beginWidget('vendor.uldisn.ace.widgets.CJuiAceDialog',array(
        'id'=>'CommentDialog',
        'title' => Yii::t('D2tasksModule.model', 'Add Comment'),
        //'title_icon' => 'icon-warning-sign red',
        'options'=>array(
            'resizable' => true,
            'width'=>'auto',
            'height'=>'auto',        
            'modal' => true,
            'autoOpen'=>false,
            'onclose' => 'function(event, ui) {$("#ajax_form").html("");}'
        ),
    ));
    $tcmt_model = new TcmtComments;
    $tcmt_model->tcmt_ttsk_id = $modelMain->primaryKey;
    $form = $this->beginWidget('TbActiveForm', array(
        'id' => 'tcmt_notes_popup_form',
        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'htmlOptions' => array(
            'enctype' => ''
        )
    ));        
    echo $form->hiddenField($tcmt_model,'tcmt_ttsk_id');
?>
<div class="widget-box no-padding" id="ui_position_box">
    <div class="widget-main no-padding">
        <div class="form-horizontal">   
<?php
    echo $form->textArea($tcmt_model, 'tcmt_notes', array('rows' => 6, 'cols' => 80));    

?>
        </div>
        <div class="form-actions center no-margin">
            <?php
            /**
             * submit UI form, close it and change opener text
             */
            $ajax_submit_url = $this->createUrl('tcmtComments/ajaxAdd');
            $this->widget("bootstrap.widgets.TbButton", array(
                "label" => Yii::t("D2tasksModule.crud", "Save"),
                "icon" => "icon-thumbs-up icon-white",
                "id" => "submit_tcmt_notes_buttn",
                "size" => "btn-small",
                "type" => "primary",
                "htmlOptions" => array(
                    "onclick" => ' 
                    $.ajax({
                            type: "POST",
                            url: "' . $ajax_submit_url . '",
                            data: $("#tcmt_notes_popup_form").serialize(), // read and prepare all form fields
                            success: function(data) {
                            
                                //reload grid
                                $.fn.yiiGridView.update(\'tcmt-comments-grid\');
  
                                //get dialog id
                                var dialog_id= $("div.ui-dialog-content:visible").attr("id");
                                
                                //close dialog
                                $("#"+dialog_id).dialog("close");

                            }   
                    });                                 
                    ',
                ),
            ));
            ?>            
        </div>
    </div>
</div>
<?php            
    $this->endWidget();
    $this->endWidget('vendor.uldisn.ace.widgets.CJuiAceDialog');    
    
Yii::app()->clientScript->registerScript('ui_comment_popup', 
   '
       $(document ).on("click","#add_tcmt_comment",function() {
          $("#CommentDialog").dialog("open"); 
          return false;
       })   
   '    
);    
?>

<div class="table-header">
    <i class="icon-comments"></i>    
    <?=Yii::t('D2tasksModule.model', 'Tcmt Comments')?>
    <?php    
        
    $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'id' => 'add_tcmt_comment',
            'buttonType' => 'link', 
            'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'mini',
            'icon' => 'icon-plus',
            'htmlOptions' => array(
                'title' => Yii::t('D2tasksModule.model', 'Add Comment'),
                'data-toggle' => 'tooltip',
            ),                 
        )
    );        
    ?>
</div>
 
<?php 

    $model = new TcmtComments();
    $model->tcmt_ttsk_id = $modelMain->primaryKey;

    // render grid view
    $this->widget('TbGridView',
        array(
            'id' => 'tcmt-comments-grid',
            'dataProvider' => $model->search(),
            'template' => '{summary}{items}',
            'summaryText' => '&nbsp;',
            'htmlOptions' => array(
                'class' => 'rel-grid-view'
            ),            
            'columns' => array(
                array(
                'name' => 'tcmt_pprs_id',
                'value' => '$data->tcmtPprs->itemLabel',    
                'htmlOptions' => array(
                    'class' => 'span3',
                ),    
            ),
            array(
                'name' => 'tcmt_datetime',
                'htmlOptions' => array(
                    'class' => 'span3',
                ),                    
            ),
            array(
//                'class' => 'editable.EditableColumn',
                'name' => 'tcmt_notes',
//                'editable' => array(
//                    'type' => 'textarea',
//                    'url' => $this->createUrl('//d2tasks/tcmtComments/editableSaver'),
//                    //'placement' => 'right',
//                )
                'htmlOptions' => array(
                    'class' => 'span12',
                ),                    
            ),

            )
        )
    );
    ?>

<?php
    Yii::endProfile('TcmtComments.view.grid');
}    
?>

<?php
if(!$ajax || $ajax == 'tprs-persons-grid'){
    Yii::beginProfile('tprs_ttsk_id.view.grid');
?>

<div class="table-header">
    <i class="icon-user"></i>        
    <?=Yii::t('D2tasksModule.model', 'Tprs Persons')?>
    <?php    
        
    $this->widget(
        'bootstrap.widgets.TbButton',
        array(
            'buttonType' => 'ajaxButton', 
            'type' => 'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size' => 'mini',
            'icon' => 'icon-plus',
            'url' => array(
                '//d2tasks/tprsPersons/ajaxCreate',
                'field' => 'tprs_ttsk_id',
                'value' => $modelMain->primaryKey,
                'ajax' => 'tprs-persons-grid',
            ),
            'ajaxOptions' => array(
                    'success' => 'function(html) {$.fn.yiiGridView.update(\'tprs-persons-grid\');}'
                    ),
            'htmlOptions' => array(
                'title' => Yii::t('D2tasksModule.crud', 'Add new record'),
                'data-toggle' => 'tooltip',
            ),                 
        )
    );        
    ?>
</div>
 
<?php 

    if (empty($modelMain->tprsPersons)) {
        $model = new TprsPersons;
        $model->tprs_ttsk_id = $modelMain->primaryKey;
        $model->save();
        unset($model);
    } 
    
    $model = new TprsPersons();
    $model->tprs_ttsk_id = $modelMain->primaryKey;

    // render grid view

    $this->widget('TbGridView',
        array(
            'id' => 'tprs-persons-grid',
            'dataProvider' => $model->search(),
            'template' => '{summary}{items}',
            'summaryText' => '&nbsp;',
            'htmlOptions' => array(
                'class' => 'rel-grid-view'
            ),            
            'columns' => array(
                array(
                'class' => 'editable.EditableColumn',
                'name' => 'tprs_pprs_id',
                'editable' => array(
                    'type' => 'select',
                    'url' => $this->createUrl('//d2tasks/tprsPersons/editableSaver'),
                    'source' => CHtml::listData(PprsPerson::model()->getSysCompanyPersons(), 'pprs_id', 'itemLabel'),
                ),
                'htmlOptions' => array(
                    'class' => 'span6'
                ),                    
            ),
            array(
                'class' => 'editable.EditableColumn',
                'name' => 'tprs_notes',
                'editable' => array(
                    'type' => 'textarea',
                    'url' => $this->createUrl('//d2tasks/tprsPersons/editableSaver'),
                ),
               'htmlOptions' => array(
                        'class' => 'span12'
               ),                
            ),

                array(
                    'class' => 'TbButtonColumn',
                    'buttons' => array(
                        'view' => array('visible' => 'FALSE'),
                        'update' => array('visible' => 'FALSE'),
                        'delete' => array('visible' => 'Yii::app()->user->checkAccess("D2tasks.TtskTask.DeletetprsPersons")'),
                    ),
                    'deleteButtonUrl' => 'Yii::app()->controller->createUrl("/d2tasks/tprsPersons/delete", array("tprs_id" => $data->tprs_id))',
                    'deleteConfirmation'=>Yii::t('D2tasksModule.crud','Do you want to delete this item?'),   
                    'deleteButtonOptions'=>array('data-toggle'=>'tooltip'),       
                    'htmlOptions' => array(
                        'class' => 'span1'
                    ),
                ),
            )
        )
    );
    ?>

<?php
    Yii::endProfile('TprsPersons.view.grid');
}    
