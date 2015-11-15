<?php

class WebUser extends CWebUser
{

    public function getRole()
    {
        return $this->getState('__role');
    }
    
    public function getId()
    {
        return $this->getState('__id') ? $this->getState('__id') : 0;
    }

//    protected function beforeLogin($id, $states, $fromCookie)
//    {
//        parent::beforeLogin($id, $states, $fromCookie);
//
//        $model = new UserLoginStats();
//        $model->attributes = array(
//            'user_id' => $id,
//            'ip' => ip2long(Yii::app()->request->getUserHostAddress())
//        );
//        $model->save();
//
//        return true;
//    }

    protected function afterLogin($fromCookie)
    {
        parent::afterLogin($fromCookie);
        $this->updateSession();
    }

    public function updateSession() {
        $user = Yii::app()->getModule('user')->user($this->id);
           //$this->name = $user->username;
           $this->setName($user->username);
        $userAttributes = CMap::mergeArray(array(
                                                'email'=>$user->email,
                                                'username'=>$user->username,
                                                'create_at'=>$user->create_at,
                                                'lastvisit_at'=>$user->lastvisit_at,
                                           ),$user->profile->getAttributes());
        foreach ($userAttributes as $attrName=>$attrValue) {
            $this->setState($attrName,$attrValue);
        }
    }

        /**
         * Returns user model by user id.
         * @param integer $id user id. Default - current user id.
         * @return User
         */
    public function model($id=0) {
        return Yii::app()->getModule('user')->user($id);
    }

        /**
         * Returns user model by user id.
         * @param integer $id user id. Default - current user id.
         * @return User
         */
    public function user($id=0) {
        return $this->model($id);
    }

        /**
         * Returns user model by user name.
         * @param string username
         * @return User
         */
    public function getUserByName($username) {
        return Yii::app()->getModule('user')->getUserByName($username);
    }

    public function getAdmins() {
        return Yii::app()->getModule('user')->getAdmins();
    }


        /**
         * @return boolean
         */
    public function isAdmin() {
        return Yii::app()->getModule('user')->isAdmin();
    }

}