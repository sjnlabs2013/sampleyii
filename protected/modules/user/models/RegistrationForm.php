<?php
/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * user registration form data. It is used by the 'registration' action of 'UserController'.
 */
class RegistrationForm extends User {
	public $verifyPassword;
	public $verifyCode;
	
	public function rules() {
		$rules = array(
			//array('username, password, verifyPassword, email', 'required'),
			array('username, password, verifyPassword, email, timezone, service', 'required'),
                    
			//array('username', 'length', 'max'=>20, 'min' => 3,'message' => UserModule::t("Incorrect username (length between 3 and 20 characters).")),
			//array('username', 'length', 'max'=>255, 'min' => 8,'message' => UserModule::t("Incorrect username (length between 8 and 20 characters).")),
			array('username', 'length', 'max'=>255, 'min' => 3,'message' => UserModule::t("Minimum 3 Characters).")),
                    
			//array('password', 'length', 'max'=>128, 'min' => 4,'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
			//array('password', 'length', 'max'=>512, 'min' => 10,'message' => UserModule::t("Incorrect password (minimal length 10 symbols).")),
			array('password', 'length', 'max'=>512, 'min' => 6,'message' => UserModule::t("Minimum 6 Characters")),
                    
			array('email', 'email'),
			array('username', 'unique', 'message' => UserModule::t("This user's name already exists.")),
			array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
			//array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retype Password is incorrect.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => UserModule::t("Incorrect symbols (A-z0-9).")),
			//array('username', 'match', 'pattern' => '/^[A-Za-z0-9._+@]+$/u','message' => UserModule::t("Incorrect symbols! Only (A-z0-9._+@) Allowed.")),
                    
                        array('timezone', 'length', 'max'=>100),
                        array('firstname, lastname', 'length', 'max'=>200),
                        array('service, visible_to_public, organisation_id, organisation_administrator', 'numerical', 'integerOnly'=>true),
                        array('verifyCode', 'safe'),
                    
		);
		if (!(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')) {
			array_push($rules,array('verifyCode', 'captcha', 'allowEmpty'=>!UserModule::doCaptcha('registration')));
		}
		
		array_push($rules,array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retype Password is incorrect.")));
		return $rules;
	}
	
}