<?php
Yii::import('application.extensions.jtoggleswitch.JToggleSwitch');
?>

<div class="form">
    
<?php 
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'test-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
));
?>
    
<p class="note">Fields with <span class="required">*</span> are required.</p>    
    
<div class="row">

<div class="column">
<?php 
$this->widget('JToggleSwitch', array(
                'name' => 'field',     
                'value' => 1,     
                'selected' => -1,
                'data'=>array(100=>'A',200=>'B',300=>'C'),    
                'htmlOptions'=>array('autocomplete'=>'off'),
      ));
?>
</div>
    
<?php /** 
<div class="column">
<?php 
$this->widget('JToggleSwitch', array(
                'type' => 'switch-light', 
                'scheme' => 'switch-candy-blue'
      ));
?>   
</div> */ ?>
    
</div>


<div class="row buttons">
        <?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <?php echo CHtml::submitButton('Save'); ?>
</div>
    
<?php $this->endWidget(); ?>

</div><!-- form -->