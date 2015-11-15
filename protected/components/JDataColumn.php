<?php
Yii::import('zii.widgets.grid.CDataColumn');

class JDataColumn extends CDataColumn  {
    //public $template = '{update} {delete}';
    
    public function init (){
        
        parent::init();
        //$this->visible = false;//didnt work
        //$this->header = '';

        //if($this->name=='active'||$this->name=='created_on'||$this->name=='created_by'){
        if($this->name=='created_on'||$this->name=='created_by'){
            $this->htmlOptions = array('class'=>'debug');
            $this->headerHtmlOptions = array('class'=>'debug');
            $this->footerHtmlOptions = array('class'=>'debug');
            $this->filterHtmlOptions = array('class'=>'debug');
        }
    }

}