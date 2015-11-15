<?php
/* @var $this I18nController */
/* @var $model I18nSourceMessage */
/* @var $model I18nTranslatedMessage */

$this->breadcrumbs=array(
	'i18n'=>array('admin'),
	'Create',
);

$this->menu=array(
	array('label'=>'Manage i18n', 'url'=>array('admin')),
);
?>

<h1>Create i18n</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'translations'=>$translations)); ?>