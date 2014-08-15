<div class="crud-form">
    <?php  ?>    
    <?php
        Yii::app()->bootstrap->registerPackage('select2');
        Yii::app()->clientScript->registerScript('crud/variant/update','$("#ttsk-task-form select").select2();');


        $form=$this->beginWidget('TbActiveForm', array(
            'id' => 'ttsk-task-form',
            'enableAjaxValidation' => true,
            'enableClientValidation' => true,
            'htmlOptions' => array(
                'enctype' => ''
            )
        ));

        echo $form->errorSummary($model);
    ?>
    
    <div class="row">
        <div class="span5">
            <div class="form-horizontal">

                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php  ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2tasksModule.model', 'tooltip.ttsk_id')) != 'tooltip.ttsk_id')?$t:'' ?>'>
                                <?php
                            ;
                            echo $form->error($model,'ttsk_id')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'ttsk_ccmp_id') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2tasksModule.model', 'tooltip.ttsk_ccmp_id')) != 'tooltip.ttsk_ccmp_id')?$t:'' ?>'>
                                <?php
                            $this->widget(
                '\GtcRelation',
                array(
                    'model' => $model,
                    'relation' => 'ttskCcmp',
                    'fields' => 'itemLabel',
                    'allowEmpty' => true,
                    'style' => 'dropdownlist',
                    'htmlOptions' => array(
                        'checkAll' => 'all',
                        'class' => 'span11'
                        
                    ),
                )
                );
                            echo $form->error($model,'ttsk_ccmp_id')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'ttsk_name') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2tasksModule.model', 'tooltip.ttsk_name')) != 'tooltip.ttsk_name')?$t:'' ?>'>
                                <?php
                            echo $form->textField($model, 'ttsk_name', array('size' => 60, 'maxlength' => 256));
                            echo $form->error($model,'ttsk_name')
                            ?>                            </span>
                        </div>
                    </div>
                    <?php  ?>
                                    
                    <?php  ?>
                    <div class="control-group">
                        <div class='control-label'>
                            <?php echo $form->labelEx($model, 'ttsk_description') ?>
                        </div>
                        <div class='controls'>
                            <span class="tooltip-wrapper" data-toggle='tooltip' data-placement="right"
                                 title='<?php echo (($t = Yii::t('D2tasksModule.model', 'tooltip.ttsk_description')) != 'tooltip.ttsk_description')?$t:'' ?>'>
                                <?php
                            echo $form->textArea($model, 'ttsk_description', array('rows' => 6, 'cols' => 50));
                            echo $form->error($model,'ttsk_description')
                            ?>                            </span>
                        </div>
                    </div>
                
            </div>
        </div>
        <!-- main inputs -->

        
    </div>

    <p class="alert">
        
        <?php 
            echo Yii::t('D2tasksModule.crud','Fields with <span class="required">*</span> are required.');
                
            /**
             * @todo: We need the buttons inside the form, when a user hits <enter>
             */                
            echo ' '.CHtml::submitButton(Yii::t('D2tasksModule.crud', 'Save'), array(
                'class' => 'btn btn-primary',
                'style'=>'visibility: hidden;'                
            ));
                
        ?>
    </p>


    <?php $this->endWidget() ?>    <?php  ?></div> <!-- form -->
