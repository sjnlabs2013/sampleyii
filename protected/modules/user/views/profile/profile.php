<?php $this->pageTitle=Yii::app()->name . ' - '.UserModule::t("Profile");
$this->breadcrumbs=array(
	UserModule::t("Profile"),
);
$this->menu=array(
	((UserModule::isAdmin())
		?array('label'=>UserModule::t('Manage Users'), 'url'=>array('/user/admin'))
		:array()),
    //array('label'=>UserModule::t('List User'), 'url'=>array('/user')),
    array('label'=>UserModule::t('Edit'), 'url'=>array('edit')),
    array('label'=>UserModule::t('Change password'), 'url'=>array('changepassword')),
    array('label'=>UserModule::t('Logout'), 'url'=>array('/user/logout')),
);

$profileFields=ProfileField::model()->forOwner()->sort()->findAll();

?>

<h1><?php echo UserModule::t('Profile'); ?></h1>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
<div class="success">
	<?php echo Yii::app()->user->getFlash('profileMessage'); ?>
</div>
<?php endif; ?>
<table class="dataGrid profile-dg">
	<tr>
            <th rowspan="13" style="width:100px;color:#FFF;vertical-align:top">
                <i class="fa fa-user" style="font-size:20em"></i>
            </th>
            <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('username')); ?></th>
	    <td><?php echo CHtml::encode($model->username); ?></td>
	</tr>
        
        
	<?php 
/*******************************************************************************
if ($profileFields) {
    foreach($profileFields as $field) {

			?>
	<tr>
        <th class="label"><?php echo CHtml::encode(UserModule::t($field->title)); ?></th>
    	<td><?php echo (($field->widgetView($profile))?$field->widgetView($profile):CHtml::encode((($field->range)?Profile::range($field->range,$profile->getAttribute($field->varname)):$profile->getAttribute($field->varname)))); ?></td>
	</tr>
			<?php

    }//$profile->getAttribute($field->varname)
}
/*******************************************************************************/
	?>
	<tr>
            <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
            <td><?php echo CHtml::encode($model->email); ?></td>
	</tr>

	<tr>
            <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('email')); ?></th>
	    <td><?php echo CHtml::encode($model->email); ?></td>
	</tr>
        
        <tr>
            <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('create_at')); ?></th>
            <td><?php echo $model->create_at; ?></td>
        </tr>
        
        <tr>
            <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('update_at')); ?></th>
            <?php /**<td><?php if(isset($profile->updated_on)){ echo $profile->updated_on; } ?></td> */ ?>
            <td><?php echo $model->update_at;  ?></td>
        </tr>
        <tr>
            <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('lastvisit_at')); ?></th>
            <td><?php echo $model->lastvisit_at; ?></td>
        </tr>
	
        <tr>
            <th class="label"><?php echo CHtml::encode($model->getAttributeLabel('status')); ?></th>
            <td><?php echo CHtml::encode(User::itemAlias("UserStatus",$model->status)); ?></td>
	</tr>	
 
</table>
