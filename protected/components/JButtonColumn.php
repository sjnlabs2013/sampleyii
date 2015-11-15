<?php
Yii::import('zii.widgets.grid.CGridColumn');
Yii::import('Controller');

class JButtonColumn extends CButtonColumn  {

    public function init (){
        $themeUrl = Yii::app()->theme->baseUrl;
        
        $ctrl = Yii::app()->controller->id;
        $act = Yii::app()->controller->action->id;
        
        $this->deleteConfirmation = Yii::t('ui','Do you really want to delete this item?');
        $this->afterDelete = 'function(link,success,data){ if(success){ alertify.log("Record Deleted","success",7000); } }';
        
        if($ctrl=='i18n'&&$act=='admin'){
            $this->template = '{filter} {update} {delete}';
        } else {
            $this->template = '{update} {delete}';
        }
        
        $this->viewButtonImageUrl = $themeUrl . '/images/view16x16.png';
        $this->updateButtonImageUrl = $themeUrl . '/images/update16x16.png';
        $this->deleteButtonImageUrl = $themeUrl . '/images/delete16x16.png';
        
        return parent::init();
    }
    
    
}
