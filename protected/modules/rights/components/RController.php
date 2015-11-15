<?php
/**
* Rights base controller class file.
*
* @author Christoffer Niska <cniska@live.com>
* @copyright Copyright &copy; 2010 Christoffer Niska
* @since 0.6
*/
class RController extends CController
{
	/**
	* @property string the default layout for the controller view. Defaults to '//layouts/column1',
	* meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	*/
	public $layout='//layouts/column1';
	/**
	* @property array context menu items. This property will be assigned to {@link CMenu::items}.
	*/
	public $menu=array();
	/**
	* @property array the breadcrumbs of the current page. The value of this property will
	* be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	* for more details on how to specify this property.
	*/
	public $breadcrumbs=array();

	/**
	* The filter method for 'rights' access filter.
	* This filter is a wrapper of {@link CAccessControlFilter}.
	* @param CFilterChain $filterChain the filter chain that the filter is on.
	*/
	public function filterRights($filterChain)
	{
		$filter = new RightsFilter;
		$filter->allowedActions = $this->allowedActions();
		$filter->filter($filterChain);
	}

	/**
	* @return string the actions that are always allowed separated by commas.
	*/
	public function allowedActions()
	{
		return '';
	}

	/**
	* Denies the access of the user.
	* @param string $message the message to display to the user.
	* This method may be invoked when access check fails.
	* @throws CHttpException when called unless login is required.
	*/
	public function accessDenied($message=null)
	{
		if( $message===null )
			$message = Rights::t('core', 'You are not authorized to perform this action.');

		$user = Yii::app()->getUser();
		if( $user->isGuest===true )
			$user->loginRequired();
		else
			throw new CHttpException(403, $message);
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
        
        public function getRoles($userId=null){
            $auth = Yii::app()->authManager;
            $roles = $auth->getRoles($userId);
            $list = array();
            //$roles = array_keys($auth->getRoles($userId));
            foreach($roles as $name=>$caithitem){ $list[$name]=$name; }
            return $list;
        }
}
