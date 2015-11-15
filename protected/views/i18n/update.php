<?php
/* @var $this I18nController */
/* @var $model I18nSourceMessage */
/* @var $model I18nTranslatedMessage */

$this->breadcrumbs=array(
	'i18n'=>array('admin'),
	'Update',
);

$this->menu=array(
	array('label'=>'Create i18n', 'url'=>array('create')),
	array('label'=>'Manage i18n', 'url'=>array('admin')),
);
?>

<h1>Update i18n <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model,'translations'=>$translations)); ?>