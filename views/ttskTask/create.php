<?php
$this->setPageTitle(Yii::t('D2tasksModule.model', 'Create New Project'));

$cancel_buton = $this->widget("bootstrap.widgets.TbButton", array(
    #"label"=>Yii::t("D2tasksModule.crud","Cancel"),
    "icon"=>"chevron-left",
    "size"=>"large",
    "url"=>(isset($_GET["returnUrl"]))?$_GET["returnUrl"]:array("{$this->id}/admin"),
    "visible"=>(Yii::app()->user->checkAccess("D2tasks.TtskTask.*") || Yii::app()->user->checkAccess("D2tasks.TtskTask.View")),
    "htmlOptions"=>array(
                    "class"=>"search-button",
                    "data-toggle"=>"tooltip",
                    "title"=>Yii::t("D2tasksModule.crud","Cancel"),
                )
 ),true);
    
?>
<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <div class="btn-group"><?php echo $cancel_buton;?></div>
        <div class="btn-group">
            <h1>
                <i class="icon-tasks"></i>
                <?php echo Yii::t('D2tasksModule.model','Create New Project');?>            </h1>
        </div>
    </div>
</div>

<?php $this->renderPartial('_form', array('model' => $model, 'buttons' => 'create')); ?>
<div class="clearfix">
    <div class="btn-toolbar pull-left">
        <div class="btn-group"><?php echo $cancel_buton;?></div>
        <div class="btn-group">
            
                <?php  
                    $this->widget("bootstrap.widgets.TbButton", array(
                       "label"=>Yii::t("D2tasksModule.crud","Save"),
                       "icon"=>"icon-thumbs-up icon-white",
                       "size"=>"large",
                       "type"=>"primary",
                       "htmlOptions"=> array(
                            "onclick"=>"$('.crud-form form').submit();",
                       ),
                       "visible"=> (Yii::app()->user->checkAccess("D2tasks.TtskTask.*") || Yii::app()->user->checkAccess("D2tasks.TtskTask.View"))
                    )); 
                    ?>
                  
        </div>
    </div>
</div>