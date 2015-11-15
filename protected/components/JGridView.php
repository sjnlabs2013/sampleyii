<?php
Yii::import('zii.widgets.grid.CGridView');

class JGridView extends CGridView{
    public function init (){
        $themeUrl = Yii::app()->theme->baseUrl;
        
        $this->cssFile = $themeUrl.'/css/grid.css';
        
        $this->template = '{items}'."\n".'{pager}'."\n".'{summary}';
        
        
        //$this->beforeAjaxUpdate = 'js:function(id, data){ alertify.log("loading grid data... please wait..."); }';
        //$this->afterAjaxUpdate = 'js:function(id,options){ alertify.log("grid data successfully loaded","success"); }';
        
        return parent::init();
    }
}
