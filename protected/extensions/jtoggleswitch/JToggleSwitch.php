<?php

Yii::import('zii.widgets.jui.CJuiInputWidget');

class JToggleSwitch extends CJuiInputWidget {
    public $model;
    public $attribute;
    public $name;
    public $value;
    public $selected;
    public $target;
    public $htmlOptions;
    public $data = array(0=>'N/A',1=>'Yes',-1=>'No');
    
    
    /**
     * switch-light -- Use the light switch, instead of a checkbox, for simple “On/Off” options.
     * switch-toggle -- Use the toggle switches, instead of radio buttons, for two or more specific option
     */
    public $type = 'switch-toggle';
    
    /**
     * switch-candy-blue
     * switch-candy-yellow
     * switch-android
     * switch-ios
     */
    public $scheme = 'switch-candy'; //

    public function run()
    {    
/*
<div class="switch-toggle switch-3 switch-ios large-9 columns" data="<?php echo $checked->accepted ?>">
<input id="DataItem_<?php echo $genId ?>_accepted_0" name="DataItem[<?php echo $genId ?>][accepted]" type="radio" value="1" <?php echo $checked->accepted==1?'checked':''?> />
<label for="DataItem_<?php echo $genId ?>_accepted_0" onclick="">Yes</label>

<input id="DataItem_<?php echo $genId ?>_accepted_1" name="DataItem[<?php echo $genId ?>][accepted]" type="radio" value="-1" <?php echo $checked->accepted==-1?'checked':''?> />
<label for="DataItem_<?php echo $genId ?>_accepted_1" onclick="">No</label>

<input id="DataItem_<?php echo $genId ?>_accepted_2" name="DataItem[<?php echo $genId ?>][accepted]" type="radio" value="0" <?php echo $checked->accepted==0?'checked':''?> />
<label for="DataItem_<?php echo $genId ?>_accepted_2" onclick="">N/A</label>

<a></a>
</div>
*/
        $cs = Yii::app()->getClientScript();
        $assets = Yii::app()->getAssetManager()->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'assets');
        $cs->registerCssFile($assets.DIRECTORY_SEPARATOR.'toggle-switch.css');
        $cs->registerScriptFile($assets.DIRECTORY_SEPARATOR.'script.js',CClientScript::POS_BEGIN);

        $nOfItems = count($this->data);
        
        
        if($this->type == 'switch-toggle') {
            
            //You can add up to 5 items by using the .switch-3, .switch-4 and .switch-5 classes.
            echo CHtml::openTag('div',array('class'=>'switch-toggle switch-'.$nOfItems.' '.$this->scheme.' columns'));

            foreach($this->data as $key=>$label){
                $checked = $this->selected==$key;
                echo CHtml::radioButton($this->name, $checked, array('value'=>$key,'id'=>$this->name.'_'.$key));
                echo CHtml::label($label,$this->name.'_'.$key,array('onclick'=>''));
                
            }
            echo CHtml::tag('a',array(),'',true);
            echo CHtml::closeTag('div'); 
        } 
        
        
        if($this->type == 'switch-light') {
            echo CHtml::openTag('label',array('class'=>'switch-light '.$this->scheme,'onclick'=>''));
            echo CHtml::checkBox('');
            echo CHtml::openTag('span');
            
            echo CHtml::tag('span',array(),'Off');
            echo CHtml::tag('span',array(),'On');
            
            echo CHtml::closeTag('span');
            echo CHtml::tag('a',array(),'',true);
            echo CHtml::closeTag('label');
        }
    }
}
