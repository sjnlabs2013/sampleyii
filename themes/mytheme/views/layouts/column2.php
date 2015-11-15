<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-99">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
    <div id="sidebar">
    <?php
    
try {

$module = '';
try { 
    if(isset(Yii::app()->controller->module)) {
        $module = Yii::app()->controller->module->id; 
    }
    
} catch(Exception $ex){ }
//$module = Yii::app()->controller->module->id;
$ctrl=Yii::app()->controller->id;
$actn=Yii::app()->controller->action->id;


$menu = $this->menu;

$showMenu = true;

foreach($menu as $key=>$item){
    
    if(isset($menu[$key]['label'])){
    
    $menu[$key]['itemOptions']['title'] = $menu[$key]['label'];

    if($this->checkRoleAvailability('Admin')){
        if(0===strpos($item['label'], 'View')){$menu[$key]['label'] = '<i class="fa fa-eye fa-2x"></i>'; }
        if(0===strpos($item['label'], 'List')){$menu[$key]['label'] = '<i class="fa fa-list fa-2x"></i>'; }
    } else {
        //if(0===strpos($item['label'], 'View')){unset($menu[$key]);}
        //if(0===strpos($item['label'], 'List')){unset($menu[$key]);}
        if(0===strpos($item['label'], 'View')){$menu[$key]['itemOptions']['style']='display:none';}
        if(0===strpos($item['label'], 'List')){$menu[$key]['itemOptions']['style']='display:none';}
    }
    
    //$pos = strpos($item['label'], 'View');
    //if($pos===false){}else{ $menu[$key]['label'] = '<i class="fa fa-eye fa-2x"></i>'; }    
    
    ////if(0===strpos($item['label'], 'View')){$menu[$key]['label'] = '<i class="fa fa-eye fa-2x"></i>'; }    
    if(0===strpos($item['label'], 'Create')){$menu[$key]['label'] = '<i class="fa fa-plus fa-2x"></i>'; }
    if(0===strpos($item['label'], 'Update')){$menu[$key]['label'] = '<i class="fa fa-pencil fa-2x"></i>'; }
    if(0===strpos($item['label'], 'Delete')){$menu[$key]['label'] = '<i class="fa fa-times-circle fa-2x"></i>'; }
    ////if(0===strpos($item['label'], 'List')){$menu[$key]['label'] = '<i class="fa fa-list fa-2x"></i>'; }
    if(0===strpos($item['label'], 'Manage')){$menu[$key]['label'] = '<i class="fa fa-star fa-2x"></i>'; }
    
    
    //User Module
    if($item['label']=='Edit'){$menu[$key]['label'] = '<i class="fa fa-pencil fa-2x"></i>'; }
    if($item['label']=='Change password'){$menu[$key]['label'] = '<i class="fa fa-key fa-2x"></i>'; }
    if($item['label']=='Logout'){$menu[$key]['label'] = '<i class="fa fa-sign-out fa-2x"></i>'; }
    if($item['label']=='Profile'){$menu[$key]['label'] = '<i class="fa fa-user fa-2x"></i>'; } 
    
    if($item['label']=='Manage Users'){$menu[$key]['label'] = '<i class="fa fa-users fa-2x"></i>'; }  
    if($item['label']=='Manage Profile Field'){$menu[$key]['label'] = '<i class="fa fa-cube fa-2x"></i>'; }  
    

    
    if($item['label']=='Dashboard'){$menu[$key]['label'] = '<i class="fa fa-tachometer fa-2x"></i>'; }
    if($item['label']=='Timeline'){$menu[$key]['label'] = '<i class="fa fa-clock-o fa-2x"></i>'; }
    
    //$item['visible']=$this->visibilityMenuItem($ctrl,$item['url']);
    
    } else {
        $showMenu = false;
    }
    //if(!isset($item['label'])){ unset($menu[$key]); }
}


if($module=='user'&&$ctrl=='profile'&&$actn=='profile'&&$showMenu==false){
    
    $menu = array(
                array(
                    'label'=>'<i class="fa fa-pencil fa-2x"></i>', 
                    'itemOptions'=>array('title'=>UserModule::t('Edit')), 
                    'url'=>array('profile/edit')),
                 array(
                    'label'=>'<i class="fa fa-key fa-2x"></i>', 
                    'itemOptions'=>array('title'=>UserModule::t('Change password')), 
                    'url'=>array('profile/changepassword')),
            );
    $showMenu= true;
    
} else if($module=='user'&&$ctrl=='profile'&&$actn=='edit'&&$showMenu==false){
    
    $menu = array(
                array(
                    'label'=>'<i class="fa fa-user-secret fa-2x"></i>', 
                    'itemOptions'=>array('title'=>UserModule::t('Profile')), 
                    'url'=>array('profile/profile')),
                 array(
                    'label'=>'<i class="fa fa-key fa-2x"></i>', 
                    'itemOptions'=>array('title'=>UserModule::t('Change password')), 
                    'url'=>array('profile/changepassword')),        
            );
    $showMenu= true;
    
}

if($showMenu){
    $this->beginWidget('zii.widgets.CPortlet', array(
            'title'=>'',
    ));
    $this->widget('zii.widgets.CMenu', array(
            'items'=>$menu,
            'encodeLabel'=>false,
            'htmlOptions'=>array('class'=>'operations'),
    ));
    $this->endWidget();
} 


} catch(Exception $ex){
    
}
    ?>
    </div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>