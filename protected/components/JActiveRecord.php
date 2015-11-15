<?php

class JActiveRecord extends CActiveRecord{
    
    public static function model($class = __CLASS__){return parent::model($class);}
    
    public function getModelName(){
        return __CLASS__;
    }   
    
    public function getGenericId(){
            return strtoupper(substr(get_class($this),0,3)).str_pad($this->primaryKey, 5, '0', STR_PAD_LEFT);
    }
    
    //public function behaviors() {
    //    return array(
    //            // Classname => path to Class
    //            'JActiveRecordBehavior'=>
    //                    'application.behaviors.JActiveRecordBehavior',
    //    );
    //}
    
    public function defaultFindAll($condition='',$params=array())
    {
            Yii::trace(get_class($this).'.defaultFindAll()','system.db.ar.CActiveRecord');
            $criteria=$this->getCommandBuilder()->createCriteria($condition,$params);
            return $this->query($criteria,true);
    }
    
    public function findAll($condition='',$params=array())
    {
        Yii::trace(get_class($this).'.findAll()','system.db.ar.CActiveRecord');

        $auth = Yii::app()->authManager;
        $currUserId = Yii::app()->user->id;
        $user = User::model()->findByPk($currUserId);

        return $this->defaultFindAll($condition,$params);

        //Refer Project BUILD
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
    
    //public function scopes()
    //{
    //    return array(
    //        'own'=>array(
    //            'condition'=>'created_by=' . Yii::app()->user->id,
    //        ),
    //    );
    //}
    
    
    public function afterFind()
    {
            
        //Yii::app()->params['db_date_format_short']
        //Yii::app()->params['sys_date_format_short']

////MODEL "DefaultAvailability"
//if(get_class($this) == 'DefaultAvailability'){
//
//    if($this->start_date != null || $this->start_date!='0000-00-00'){
//        $d = DateTime::createFromFormat(Yii::app()->params['db_date_format_short'], $this->start_date);
//        if($d != null) { $this->start_date = $d->format(Yii::app()->params['sys_date_format_short']); }
//    } 
//
//    if($this->end_date != null || $this->end_date!='0000-00-00'){
//        $d = DateTime::createFromFormat(Yii::app()->params['db_date_format_short'], $this->end_date);
//        if($d != null) { $this->end_date = $d->format(Yii::app()->params['sys_date_format_short']); }
//    } 
//
//}
            
////MODEL "OngoingTasks"
//if(get_class($this) == 'OngoingTaskDefaultHours'){
//    if($this->ongoing_task_end_date=='9999-01-01'){
//        $this->ongoing_task_end_date = null;
//    }
//}    
            
        return parent::afterFind();
    }
        
    public function beforeSave()
    {
////MODEL "DefaultAvailability"
//if(get_class($this) == 'DefaultAvailability'){
//
//    if($this->start_date != null){
//        $d = DateTime::createFromFormat(Yii::app()->params['sys_date_format_short'], $this->start_date);      
//        if($d != null) { $this->start_date = $d->format(Yii::app()->params['db_date_format_short']); }   
//    }
//
//    if($this->end_date != null){
//        $d = DateTime::createFromFormat(Yii::app()->params['sys_date_format_short'], $this->end_date);      
//        if($d != null) { $this->end_date = $d->format(Yii::app()->params['db_date_format_short']); }   
//    }
//
//}
        
////MODEL "OngoingTasks"
//if(get_class($this) == 'OngoingTaskDefaultHours'){
//    if($this->ongoing_task_end_date==null){
//        //$this->ongoing_task_end_date = '9999-01-01';
//        $this->ongoing_task_end_date = date('Y-m-d',strtotime('+ 365 day'));
//    }
//}
        
if(get_class($this) == 'Task'){
    if($this->task_start_date=='0000-00-00'){
        $this->task_start_date=null;
    }
    if($this->task_deadline=='0000-00-00'){
        $this->task_deadline=null;
    }
    if($this->task_active_deadline=='0000-00-00'){
        $this->task_active_deadline=null;
    }
}
        
            
        return parent::beforeSave();
    }
    
}
