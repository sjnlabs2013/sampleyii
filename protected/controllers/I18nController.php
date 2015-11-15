<?php

class I18nController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';
	public $defaultAction = 'admin';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			//'accessControl', // perform access control for CRUD operations
			//'postOnly + delete', // we only allow deletion via POST request
			'rights'
		);
	}
        
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$source=new I18nSourceMessage('search');
                $translated=new I18nTranslatedMessage('search');
                
		$source->unsetAttributes();  // clear any default values
		$translated->unsetAttributes();  // clear any default values              
               
		if(isset($_GET['I18nSourceMessage'])){
			$source->attributes=$_GET['I18nSourceMessage'];
                        
                        if($source->id>0){
                            
                            echo "Source Id: {$source->id}";
                            $translated->id = $source->id;
                        }
		}
                
                //Default
                //$translated->id = -1;
                
		if(isset($_GET['I18nTranslatedMessage'])){
			$translated->attributes=$_GET['I18nTranslatedMessage'];
                        
		}              
                
                

		$this->render('admin',array(
			'model'=>$source,
			'detail'=>$translated,
		));
	}
        
        public function actionCreate($id=0){
		$model=new I18nSourceMessage;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);
                
                if($id>0){
                    $clone = $this->loadModel($id);
                    $model->category = $clone->category;
                } else {
                    $model->category = 'app';
                }

		if(isset($_POST['I18nSourceMessage']))
		{
			$model->attributes=$_POST['I18nSourceMessage'];
			if($model->save()){
				if(isset($_POST['savencreate'])){
					$this->redirect(array('create','id'=>$model->id));
				} else if(isset($_POST['savenedit'])){
					$this->redirect(array('update','id'=>$model->id));
				} else {
					$this->redirect(array('admin'));
				}
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
        }
        
        public function actionUpdate($id){
		$model=$this->loadModel($id);
                
                $translations = $model->i18nTranslatedMessages;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['I18nSourceMessage']))
		{
			$model->attributes=$_POST['I18nSourceMessage'];
			if($model->save()){
				if(isset($_POST['savencreate'])){
					$this->redirect(array('create','id'=>$model->id));
				} else if(isset($_POST['savenedit'])){
					$this->redirect(array('update','id'=>$model->id));
				} else {
					$this->redirect(array('admin'));
				}
			}
		}

		$this->render('update',array(
			'model'=>$model,
                        'translations'=>$translations
		));
        }
        
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Timezone the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=I18nSourceMessage::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Timezone $model the model to be validated
	 */
	protected function performAjaxValidation($models)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='i18-form')
		{
			echo CActiveForm::validate($models);
			Yii::app()->end();
		}
	}
}
