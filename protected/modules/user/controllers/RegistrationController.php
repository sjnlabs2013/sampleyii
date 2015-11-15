<?php

class RegistrationController extends Controller
{
	public $defaultAction = 'registration';
	
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CCaptchaAction',
                                //'backColor'=>0xFFFFFF,
                                //'testLimit'=>3,
                                'transparent'=>true,
                                //'minLength'=>3,
                                //'maxLength'=>4,
                                //'foreColor'=>'0x2F40A0',
                                //'width'=>133,
                                //'height'=>50,
			),
		);
	}
	/**
	 * Registration user
	 */
	public function actionRegistration() {
            $model = new RegistrationForm;
            $profile=new Profile;
            $profile->regMode = true;
            
            $org = new Organisation;

            // ajax validator
            //if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
            //{
            //        echo UActiveForm::validate(array($model,$profile));
            //        Yii::app()->end();
            //}
            
            if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form') {
                if($_POST['RegistrationForm']['service']==2){
////////////////////////////////////////////////////////////////////////////////

//$name = trim($org->name);
$name = trim($_POST['Organisation']['name']);
$exOrgCount = Organisation::model()->count('name=:param_name',array(':param_name'=>$name));

if($exOrgCount>0){
    $org->validatorList->add(CValidator::createValidator('unique', $org, 'name', array('message'=>Yii::t('app','Group Name already exists'))));
} else if(strlen($name)==0){
    $org->validatorList->add(CValidator::createValidator('required', $org, 'name', array('message'=>Yii::t('app','Group Name canot be blank'))));    
}
////////////////////////////////////////////////////////////////////////////////                    

                    echo UActiveForm::validate(array($model,$profile,$org));
                    Yii::app()->end();
                } else {
                    echo UActiveForm::validate(array($model,$profile));
                    Yii::app()->end();
                }

            }
			
            if (Yii::app()->user->id) {
                $this->redirect(Yii::app()->controller->module->profileUrl);
            } else {
                if(isset($_POST['RegistrationForm'])) {
                                $model->attributes=$_POST['RegistrationForm'];
                                $profile->attributes=((isset($_POST['Profile'])?$_POST['Profile']:array()));

                                $valid = $model->validate();
                                $valid = $profile->validate() && $valid;
                                
                                if($_POST['RegistrationForm']['service']==2){
                                    $org->name = trim($_POST['Organisation']['name']);
                                    $valid = $org->validate() && $valid;
                                }
 
                                //if($model->validate()&&$profile->validate())
                                if($valid)
                                {
                                    $soucePassword = $model->password;
                                    $model->activkey=UserModule::encrypting(microtime().$model->password);
                                    $model->password=UserModule::encrypting($model->password);
                                    $model->verifyPassword=UserModule::encrypting($model->verifyPassword);
                                    $model->superuser=0;
                                    $model->status=((Yii::app()->controller->module->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);

                                    
                                    $orgDuplicateCheck=false; $flag=true;
                                    
                                    $role='Authenticated';                                 
                                                                        
                                    if($model->service==1){
                                        $orgDuplicateCheck = true;
                                        $role='Individual';
                                        
                                    } else if($model->service==2 && isset($_POST['Organisation']['name'])){
                                        $org->name = trim($_POST['Organisation']['name']);
                                        $flag = Organisation::model()->exists('name=:param_name_check',array(':param_name_check'=>$org->name));
                                        if(!$flag){$orgDuplicateCheck=true;}
                                        $role='Org_Admin';
                                        
                                    } else {
                                        //$org->validatorList->add(CValidator::createValidator('unique', $org, 'name', array('message'=>Yii::t('app','Group Name Already Exists'))));
                                        $org->validate();
                                        Yii::app()->user->setFlash('registration',UserModule::t("Group Name already exists"));
                                    }
                                        
                                        
                                    if($orgDuplicateCheck){
                                        
                                        if ($model->save()) {
                                                $profile->user_id=$model->id;
                                                $profile->firstname = $model->firstname;
                                                $profile->lastname = $model->lastname;
                                                $profile->save();
                                                $this->assignRole($model->id, $role);
                                      
                                                //If Service=2 ~ Organisation Save New (Non-Existent) Organisation
                                                if(!$flag){
                                                    $org->created_by = $model->id;
                                                    $org->type = 'Other';
                                                    //$org->timestamp_create = date('Y-m-d H:i:s');
                                                    if($org->save()){
                                                        
                                                        
                                                        $model->organisation_id = $org->id;
                                                        $model->organisation_administrator = 1;
                                                        $model->save(false);
                                                        
                                                        try {
                                                        //Create Organisation Group 
                                                        $group = new Group;
                                                        $group->group_name = $org->name;
                                                        $group->parent_group_id = 0;
                                                        $group->organisation_id = $org->id;
                                                        $group->timestamp_created = date('Y-m-d H:i":');
                                                        $group->save(false);                                                        
                                                        
                                                        $groupMember = new GroupMember;
                                                        $groupMember->group_id = $group->group_id;
                                                        $groupMember->user_id = $model->id;
                                                        $groupMember->manager_flag = 1;
                                                        //$groupMember->created_by = 0;
                                                        //$groupMember->timestamp_created = date('Y-m-d H:i:s');
                                                        $groupMember->save(false);
                                                        
                                                        } catch(Exception $ex) {
                                                            Yii::log($ex->getMessage(), 'error', 'Custom');
                                                        }
                                                        
                                                        
                                                    } else {
                                                        Yii::app()->user->setFlash('registration',UserModule::t("Oop! Soemthing Went Wrong"));
                                                    }
                                                }

                                                if (Yii::app()->controller->module->sendActivationMail) {
                                                        $activation_url = $this->createAbsoluteUrl('/user/activation/activation',array("activkey" => $model->activkey, "email" => $model->email));
                                                        UserModule::sendMail($model->email,UserModule::t("You registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t("Please activate your account by going to {activation_url}",array('{activation_url}'=>$activation_url)));
                                                }

                                                if ((Yii::app()->controller->module->loginNotActiv||(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false))&&Yii::app()->controller->module->autoLogin) {
                                                                $identity=new UserIdentity($model->username,$soucePassword);
                                                                $identity->authenticate();
                                                                Yii::app()->user->login($identity,0);
                                                                $this->redirect(Yii::app()->controller->module->returnUrl);
                                                } else {
                                                        if (!Yii::app()->controller->module->activeAfterRegister&&!Yii::app()->controller->module->sendActivationMail) {
                                                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Contact Admin to activate your account."));
                                                        } elseif(Yii::app()->controller->module->activeAfterRegister&&Yii::app()->controller->module->sendActivationMail==false) {
                                                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please {{login}}.",array('{{login}}'=>CHtml::link(UserModule::t('Login'),Yii::app()->controller->module->loginUrl))));
                                                        } elseif(Yii::app()->controller->module->loginNotActiv) {
                                                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email to login."));
                                                        } else {
                                                                //Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your email."));
                                                                Yii::app()->user->setFlash('registration',UserModule::t("Thank you for your registration. Please check your spam/junk folder if you email is not in inbox."));
                                                        }
                                                        $this->refresh();
                                                }
                                        }
                                        
                                    }
                                        
                                } else { 
                                    $profile->validate();                                     
                                }
                        }
                    $this->render('/user/registration',array('model'=>$model,'profile'=>$profile, 'org'=>$org));
            }
	}
}