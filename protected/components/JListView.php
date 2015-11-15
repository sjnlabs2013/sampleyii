<?php

Yii::import('zii.widgets.CListView');

class JListView extends CListView{
    public function init (){
        $themeUrl = Yii::app()->theme->baseUrl;        
        $this->cssFile = $themeUrl.'/css/list.css';        
        return parent::init();
    }
}