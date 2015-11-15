<?php
/* @var $this GroupController */
/* @var $model Group */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'i18n-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php echo $form->textField($model,'category',array('size'=>20,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'message'); ?>
		<?php echo $form->textArea($model,'message',array('rows'=>6, 'cols'=>50, 'style'=>'width:560px;height:35px')); ?>
		<?php echo $form->error($model,'message'); ?>
	</div>
        
        <fieldset>
        <legend>Translation(s)</legend>
        <div class="translation-section">
            
            <div class="header"></div>
            <div class="data-item">
                <?php 
                foreach((array)$translations as $translation){
                    $this->renderPartial('_translation', array('model'=>$translation));
                }
                ?>
            </div>
            <div>
                <a href="javascript:void(0);"></a>
            </div>
            
        </div>
        </fieldset>
            
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create & Edit' : 'Save & Edit' , array('name'=>'savenedit')); ?>
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create & Create Another' : 'Save & Create Another' , array('name'=>'savencreate')); ?>
		<?php echo CHtml::resetButton('Reset'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->