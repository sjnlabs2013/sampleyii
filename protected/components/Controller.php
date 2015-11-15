<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends RController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        
        public function init(){
            parent::init();
            $app = Yii::app();
            if (isset($_GET['lang'])) {
                $app->language = $_GET['lang'];
                $app->session['lang'] = $app->language;
            } else if (isset($app->session['lang'])) {
                $app->language = $app->session['lang'];
            }
            
            $this->breadcrumbs=array('Home'=>Yii::app()->homeUrl);
            
        }        
        
	public function checkRoleAvailability($checkRole){
            $available = false;
            
            if(!Yii::app()->user->isGuest){
                $auth = Yii::app()->authManager;
                $currUserId = Yii::app()->user->id;	//echo $currUserId.'<br/>';
                $roles = $auth->getRoles($currUserId);
                
                foreach($roles as $role){ 
                    if($role->name==$checkRole){ $available = $available || true; } 
                }
            
            }
            return $available;
	}
        
	public function visibilityMenuItem($controllerId='', $action=''){ 
            $user = Yii::app()->getUser(); 
            $setAccess = false;
            
            if(!Yii::app()->user->isGuest){
                if($action == ''){ 
                    $setAccess = $user->checkAccess($controllerId.'.*'); 
                } else { 
                    $setAccess = $user->checkAccess($controllerId.'.'.$action); 
                }
            }
            return $setAccess;
	} 
        
        public function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }      
        
        public function actionGenKey($length=10){
            echo $this->generateKey();
        }
        
        public function generateKey()
        {
            $random_bytes = openssl_random_pseudo_bytes(9);
            $random_string = mysql_escape_string(str_replace(array(1 => "+",2 => "/"), array(1 => "-", 2 => "_"), base64_encode($random_bytes)));
            return $random_string;
        }
        
        public function assignRole($userId=0,$role='Guest'){
            $auth = Yii::app()->authManager;            
            if($userId==0&&(
                    $this->checkRoleAvailability('Admin')
                    ||$this->checkRoleAvailability('SysAdmin')
                    ||$this->checkRoleAvailability('Org_Admin')
                    )){ 
                $userId=Yii::app()->user->id; }
            $auth->assign( $role, $userId);
        }
        
        public function getRoles($userId=null){
            $auth = Yii::app()->authManager;
            $roles = $auth->getRoles($userId);
            $list = array();
            //$roles = array_keys($auth->getRoles($userId));
            foreach($roles as $name=>$caithitem){ $list[$name]=$name; }
            return $list;
        }        
        
        public function loadUser($id=0){
            return Yii::app()->getModule('user')->user($id);
        }         
        
        public function sendMailMessage($to,$subject='',$message='',$type='normal')
        {

            $from = Yii::app()->params['postmasterEmail'];

            // To send HTML mail, the Content-type header must be set
            if($type=='normal'){
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            } else if ($type=='zip') {
  
            }
            // Additional headers
            $headers .= 'To: '.$to. "\r\n";
            $headers .= 'From: '.$from. "\r\n";
            
            // Mail it
            @mail($to, $subject, $message, $headers);
        }
        
}