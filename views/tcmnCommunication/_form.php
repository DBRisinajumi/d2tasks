<div class="form-horizontal">
    <?php
    //Yii::app()->bootstrap->registerPackage('select2');
    //Yii::app()->clientScript->registerScript('crud/variant/update', '$("#tcmn-communication-form select").select2();');

    $form = $this->beginWidget('TbActiveForm', array(
        'id' => 'tcmn-communication-form',
//        'enableAjaxValidation' => true,
        'enableClientValidation' => true,
        'htmlOptions' => array(
            'enctype' => ''
        )
    ));

    echo $form->hiddenField($model, 'tcmn_ttsk_id');
    echo CHtml::hiddenField('ajax', 'submit_form');
    echo $form->errorSummary($model);
    
    //set first project manager as task manager
    $managers = $ttsk_model->tprsPersons;
    if(!empty($managers)){
        foreach($managers as $manager){
            $model->tcmn_pprs_id = $manager->tprs_pprs_id;
            break;
        }
    }
    ?>

    
    

        
    <div class="control-group">
        <div class='control-label'>

        </div>
        <div class='controls'>
            
            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                  title='<?php echo (($t = Yii::t('D2tasksModule.model', 'tooltip.tcmn_id')) != 'tooltip.tcmn_id') ? $t : '' ?>'>
                      <?php
                      ;
                      echo $form->error($model, 'tcmn_id')
                      ?>                            </span>
        </div>
    </div>
    <div class="control-group">
            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                  title='<?php echo (($t = Yii::t('D2tasksModule.model', 'tooltip.tcmn_task')) != 'tooltip.tcmn_task') ? $t : '' ?>'>
<?php
echo $form->labelEx($model, 'tcmn_task');
echo $form->textArea($model, 'tcmn_task', array('rows' => 3, 'cols' => 50,'class' => 'span6'));
echo $form->error($model, 'tcmn_task')
?>                            </span>        
        
    </div>    
    <div class="control-group">
        <div class='control-label'>
            <?php echo $form->labelEx($model, 'tcmn_pprs_id') ?>
        </div>
        <div class='controls'>
            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                  title='<?php echo (($t = Yii::t('D2tasksModule.model', 'tooltip.tcmn_pprs_id')) != 'tooltip.tcmn_pprs_id') ? $t : '' ?>'>
                      <?php
                      echo $form->dropDownList(
                                $model,
                                'tcmn_pprs_id',
                                CHtml::listData(PprsPerson::model()->getSysCompanyPersons(), 'pprs_id', 'itemLabel'),
                                array(
                                    'class' => 'span3'
                                )
                            );
                      echo $form->error($model, 'tcmn_pprs_id')
                      ?>                            </span>
        </div>
    </div>

    <div class="control-group">
        <div class='control-label'>
            <?php echo $form->labelEx($model, 'tcmn_client_pprs_id') ?>
        </div>
        <div class='controls'>
            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                  title='<?php echo (($t = Yii::t('D2tasksModule.model', 'tooltip.tcmn_client_pprs_id')) != 'tooltip.tcmn_client_pprs_id') ? $t : '' ?>'>
                      <?php
                      echo $form->dropDownList(
                                $model,
                                'tcmn_client_pprs_id',
                                CHtml::listData(PprsPerson::model()->getCompanyPersons($ttsk_model->ttsk_ccmp_id), 'pprs_id', 'itemLabel'),
                                array(
                                    'class' => 'span3'
                                )
                              );
                      echo $form->error($model, 'tcmn_client_pprs_id')
                      ?>                            </span>
        </div>
    </div>

    <div class="control-group">
        <div class='control-label'>
<?php echo $form->labelEx($model, 'tcmn_tcst_id') ?>
        </div>
        <div class='controls'>
            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                  title='<?php echo (($t = Yii::t('D2tasksModule.model', 'tooltip.tcmn_tcst_id')) != 'tooltip.tcmn_tcst_id') ? $t : '' ?>'>
                <?php
                echo $form->dropDownList(
                        $model,
                        'tcmn_tcst_id',
                        CHtml::listData(TcstCommunicationStatus::model()->findAll(), 'tcst_id', 'itemLabel'),
                        array(
                            'class' => 'span3'
                        ));
                echo $form->error($model, 'tcmn_tcst_id')
                ?>                            
            </span>
        </div>
    </div>

    <div class="control-group">
        <div class='control-label'>
    <?php echo $form->labelEx($model, 'tcmn_datetime') ?>
        </div>
        <div class='controls'>
            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                  title='<?php echo (($t = Yii::t('D2tasksModule.model', 'tooltip.tcmn_datetime')) != 'tooltip.tcmn_datetime') ? $t : '' ?>'>
<?php
                    $this->widget('TbDateTimePicker', array(
                        'model' => $model,
                        'attribute' => 'tcmn_datetime',
                        'htmlOptions' => array(
                            'size' => 16,
                        //'class' => 'input-small'
                        ),
                        'options' => array(
                            'autoclose' => true,
                            'todayHighlight' => true,
                            'showButtonPanel' => true,
                            'changeYear' => true,
                            'format' => 'yyyy-mm-dd HH:mm',
                        ),
                            )
                    );
               echo $form->error($model, 'tcmn_datetime')
?>                            </span>
        </div>
    </div>

    <div class="control-group">
        <div class='control-label'>
    <?php echo $form->labelEx($model, 'tcmn_tmed_id') ?>
        </div>
        <div class='controls'>
            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                  title='<?php echo (($t = Yii::t('D2tasksModule.model', 'tooltip.tcmn_tmed_id')) != 'tooltip.tcmn_tmed_id') ? $t : '' ?>'>
<?php
$this->widget(
        '\GtcRelation', array(
    'model' => $model,
    'relation' => 'tcmnTmed',
    'fields' => 'itemLabel',
    'allowEmpty' => true,
    'style' => 'dropdownlist',
    'htmlOptions' => array(
        'checkAll' => 'all',
        'class' => 'span3',
     ),
        )
);
echo $form->error($model, 'tcmn_tmed_id')
?>                            </span>
        </div>
    </div>

    <div class="alert alert-warning">

    <?php
    echo Yii::t('D2tasksModule.crud', 'Fields with <span class="required">*</span> are required.');
    ?>
    </div>
    <div class="control-group center">
        <?php
        /**
         * submit UI form, close it and change opener text
         */
        $ajax_submit_url = $this->createUrl('//d2tasks/tcmnCommunication/create');
        $this->widget("bootstrap.widgets.TbButton", array(
            "label" => Yii::t("D2tasksModule.crud", "Save"),
            "icon" => "icon-thumbs-up icon-white",
            "id" => "ajax_form_submit_buttn",
            "size" => "small",
            "type" => "primary",
            "htmlOptions" => array(
                "onclick" => ' 
                    $.ajax({
                            type: "POST",
                            url: "' . $ajax_submit_url . '",
                            data: $("#tcmn-communication-form").serialize(), // read and prepare all form fields
                            success: function(data) {
                                if (data)
                                {
                                    $("#tcmn_create_form_html").html(data);
                                }
                                else
                                {
                                    $.fn.yiiGridView.update(\'tcmn-communication-grid\');                                
                                    setTimeout(\'$("#tcmn_create_form").dialog("close") \',500);
                                }


                            }   
                    });                                 
                    ',
            ),
        ));
        ?>

    </div>    

        <?php $this->endWidget() ?>
</div>