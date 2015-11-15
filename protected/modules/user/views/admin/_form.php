<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>

	<div class="row">

		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username',
                        array(
                            'size'=>30,
                            'maxlength'=>255,
                            'placeholder'=>CHtml::encode($model->getAttributeLabel('username'))
                        )); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',
                        array(
                            'size'=>30,
                            'maxlength'=>255,
                            'placeholder'=>CHtml::encode($model->getAttributeLabel('email'))
                        )); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>30,'maxlength'=>512)); ?>
            
                <?php echo CHtml::ajaxButton('Auto Gen', $this->createUrl('registration/genkey'), 
                        array('success'=>'js:function(result){ '
                            . '$(".password-helper").html("New Password:  "+result+""); '
                            . '$("#'.CHtml::activeId($model,'password').'").val(result); '
                            . '}')); ?>    
                <span class="password-helper"></span>
                <p class="hint password-hint">
                <?php echo UserModule::t("Minimal password length 6 symbols."); ?>
                </p>    
		<?php echo $form->error($model,'password'); ?>
	</div>        

	<div class="row">
		<?php echo $form->labelEx($model,'superuser'); ?>
		<?php echo $form->dropDownList($model,'superuser',User::itemAlias('AdminStatus')); ?>
		<?php echo $form->error($model,'superuser'); ?>
	</div>        

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status',User::itemAlias('UserStatus')); ?>
		<?php echo $form->error($model,'status'); ?>
        </div>

<?php 
/******************************************************************************/
$profileFields=$profile->getFields();
if ($profileFields) {
    foreach($profileFields as $field) {
                            
?>
<div class="row">
<?php 
    echo $form->labelEx($profile,$field->varname);  

    if ($widgetEdit = $field->widgetEdit($profile)) {
            echo $widgetEdit;
    } elseif ($field->range) {
            echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
    } elseif ($field->field_type=="TEXT") {
            echo CHtml::activeTextArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
    } else {
            echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
    }               

    echo $form->error($profile,$field->varname); 
?>
</div>
    <?php
    }
}
/*******************************************************************************/
?>
        
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? UserModule::t('Create') : UserModule::t('Save')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
    $(document).ready(function(){
        $('#<?php echo CHtml::activeId($model,'service')?>')
                .on('change',showOrgFields)
                .trigger('change');
    });
    
    
    function showOrgFields(){
        //var option = $('#<?php echo CHtml::activeId($model,'service')?> option:selected').text();
        var id = $('#<?php echo CHtml::activeId($model,'service')?>').val();
        
        //if(option==='Organisation'){
        if(id==2){
            $('#organisation_id_section').show();
            $('#organisation_administrator_section').show();
        } else {
            $('#organisation_id_section').hide();
            $('#organisation_administrator_section').hide();            
        }
    }
</script>