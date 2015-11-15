<?php

/* 
 * This work is done by Jerome Nicholas 
 * J@  * 
 */

?>


<div class="row">
    <div class="column">
        <?php echo $model->language ?>
    </div>
    <div class="column">
        <?php echo CHtml::activeTextArea($model,'translation',
                array(
                    'name'=>'I18nTranslatedMessage['.$model->language.'][translation]', 'style'=>'width:600px;height:50px')); ?>
        <?php echo CHtml::error($model,'translation'); ?>
    </div>
    <div class="column">
        <a href="javascript:void(0);" onclick="removeTranslation(<?php echo $model->id?>,$(this))"><i class="fa fa-times-circle fa-2x"></i></a>
    </div>
    
</div>
<div class="clear clearfix"></div>