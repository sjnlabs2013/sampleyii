<?php 
$this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Registration");

$this->breadcrumbs=array(
	UserModule::t("Registration"),
);
?>

<h1><?php echo UserModule::t("Registration"); ?></h1>

<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>

<div class="form">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'registration-form',
	'enableAjaxValidation'=>true,
	'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
	'clientOptions'=>array(
            'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
	<?php //echo $form->errorSummary(array($model,$profile)); ?>
	<?php echo $form->errorSummary(array($model,$profile,$org)); ?>
	
	<div class="row">
	<?php echo $form->labelEx($model,'username'); ?>
	<?php echo $form->textField($model,'username',array('placeholder'=>'Username','autocomplete'=>'off')); ?>
	<?php echo $form->error($model,'username'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'password'); ?>
	<?php echo $form->passwordField($model,'password',array('placeholder'=>'Password')); ?>
	<?php echo $form->error($model,'password'); ?>
	<?php echo $form->error($model,'password'); ?>
        <?php /** <?php echo CHtml::ajaxButton('Auto Gen', $this->createUrl('genkey'), 
                array('success'=>'js:function(result){ '
                    . '$(".password-helper").html("New Password:  "+result+""); '
                    . '$("#'.CHtml::activeId($model,'password').'").val(result); '
                    . '$("#'.CHtml::activeId($model,'verifyPassword').'").val(result); '
                    . '}')); ?>    
        <span class="password-helper"></span> */ ?>
	<p class="hint password-hint">
	<?php echo UserModule::t("Minimal password length 6 symbols."); ?>
	</p>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'verifyPassword'); ?>
	<?php echo $form->passwordField($model,'verifyPassword',array('placeholder'=>'Repeat Password')); ?>
	<?php echo $form->error($model,'verifyPassword'); ?>
	</div>
	
	<div class="row">
	<?php echo $form->labelEx($model,'email'); ?>
	<?php echo $form->textField($model,'email',array('placeholder'=>'Email','autocomplete'=>'off')); ?>
	<?php echo $form->error($model,'email'); ?>
	</div>
	
<?php 
/*******************************************************************************
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="row">
		<?php echo $form->labelEx($profile,$field->varname); ?>
		<?php 
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->range) {
			echo $form->dropDownList($profile,$field->varname,Profile::range($field->range));
		} elseif ($field->field_type=="TEXT") {
			echo$form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textField($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		 ?>
		<?php echo $form->error($profile,$field->varname); ?>
	</div>	
			<?php
			}
		}
*******************************************************************************/
?>
        
	<div class="row">
		<?php echo $form->labelEx($model,'firstname'); ?>
		<?php echo $form->textField($model,'firstname',array('size'=>60,'maxlength'=>200,'placeholder'=>'Firstname','autocomplete'=>'off')); ?>
		<?php echo $form->error($model,'firstname'); ?>
	</div>     
        
	<div class="row">
		<?php echo $form->labelEx($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('size'=>60,'maxlength'=>200,'placeholder'=>'Lastname','autocomplete'=>'off')); ?>
		<?php echo $form->error($model,'lastname'); ?>
	</div>
            
	<div class="row">
		<?php echo $form->labelEx($model,'timezone'); ?>
		<?php echo $form->dropDownList($model,'timezone',
                        $this->getTimezones(),
                        array(
                            'prompt'=>'--Select Timezone--',
                            'options'=>array(Yii::app()->params['default_timezone']=>array('selected'=>true))
                        )); ?>
		<?php echo $form->error($model,'timezone'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'service'); ?>
		<?php echo $form->dropDownList($model,'service',
                        array(1=>'Individual',2=>'Organisation'),
                        array('prompt'=>'--Select Service--')); ?>
                <?php echo $form->hiddenField($model,'organisation_id'); ?>
		<?php echo $form->error($model,'service'); ?>
	</div>   
        
	<div id="organisation_section" class="row">
		<?php echo CHtml::label('Organisation','Organisation[name]'); ?>
		<?php echo $form->textField($org,'name',array('maxlength'=>200,'placeholder'=>'Organisation Name','autocomplete'=>'off')); ?>
		<?php echo $form->error($org,'name'); ?>
	</div>         
        
	<?php if (UserModule::doCaptcha('registration')): ?>
	<div class="row captcha">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		
		<?php $this->widget('CCaptcha',array('buttonLabel'=>'<i class="fa fa-refresh fa-2x"></i>')); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		<?php echo $form->error($model,'verifyCode'); ?>
		
		<p class="hint"><?php echo UserModule::t("Please enter the letters as they are shown in the image above."); ?>
		<br/><?php echo UserModule::t("Letters are not case-sensitive."); ?></p>
	</div>
	<?php endif; ?>
	
	<div class="row submit">
		<?php echo CHtml::submitButton(UserModule::t("Register")); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
<?php endif; ?>

<?php
//if (!Yii::app()->request->isPostRequest){
//    Yii::app()->clientScript->registerScript(
//        'initCaptcha',
//        '$(".captcha a").trigger("click");',
//        CClientScript::POS_READY
//    );
//}

?>

<script>
    $(document).ready(function(){
        $('#<?php echo CHtml::activeId($model,'service')?>')
                .on('change',showOrgFields)
                .trigger('change');
    });
    
    
    function showOrgFields(){
        var id = $('#<?php echo CHtml::activeId($model,'service')?>').val();
        $('#<?php echo CHtml::activeId($org,'group_name')?>').val('');
        if(id==2){
            $('#organisation_section').show();
        } else {
            $('#organisation_section').hide();        
        }
    }
</script>
