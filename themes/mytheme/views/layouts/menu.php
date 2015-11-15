<?php 

$this->widget('zii.widgets.CMenu',array(
    
        'activeCssClass'=>'active',
        'id'=>'navigation',
        'htmlOptions'=>array('class'=>'nav-main'),
        'encodeLabel'=>false,
        'items'=>array(
                array(
                    'label'=>'<i class="fa fa-home"></i> Home', 
                    'url'=>array('/site/index'),
                    'submenuOptions'=>array('class'=>'nav-sub'),
                    'items'=>array(
                        array('label'=>'<i class="fa fa-info"></i> About', 'url'=>array('/site/page', 'view'=>'about'),'visible' => !Yii::app()->user->isGuest),
                        array('label'=>'<i class="fa fa-phone"></i> Contact', 'url'=>array('/site/contact'),'visible' => !Yii::app()->user->isGuest),
                    )
                ),    
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
                array('label'=>'<i class="fa fa-info"></i> About', 'url'=>array('/site/page', 'view'=>'about'),'visible' => Yii::app()->user->isGuest),
                array('label'=>'<i class="fa fa-phone"></i> Contact', 'url'=>array('/site/contact'),'visible' => Yii::app()->user->isGuest),
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
                array(
                    'label'=>'<i class="fa fa-tachometer"></i> Dashboard', 
                    'url'=>array('/dashboard/index'),
                    'visible' => !Yii::app()->user->isGuest,
                    'submenuOptions'=>array('class'=>'nav-sub'),
                    //'itemOptions'=>array('class'=>'rtr'),  
                    'items' => array(
                        array(
                            'label'=>'<i class="fa fa-arrow-right"></i> i18n',
                            'url' =>array('/i18n/admin'),
                            'visible' => $this->visibilityMenuItem('i18n','admin'),
                            'itemOptions'=>array('title'=>'my title'),
                        ),
                    )
                ),                     
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
                array(  
                    'label' => '<i class="fa fa-sign-out"></i> '.Yii::app()->getModule('user')->t("Sign out") . ' (' . Yii::app()->user->name . ')',
                    //'image' => Yii::app()->request->baseUrl . '/images/logout.png',
                    'url' => Yii::app()->getModule('user')->logoutUrl,
                    'visible' => !Yii::app()->user->isGuest,
                    'itemOptions'=>array('class'=>'rtr'),  
                    //'submenuOptions'=>array('class'=>'nav-sub'),
                    //'items'=>array(
                    //    //array('label'=>'<i class="fa fa-user"></i> Role '.$roleName, 'url'=>'','visible' => !Yii::app()->user->isGuest),
                    //
                    //    array(  
                    //        'label' => '<i class="fa fa-user"></i> '.Yii::app()->getModule('user')->t("Profile"),
                    //        'url' => Yii::app()->getModule('user')->profileUrl,
                    //        'visible' => !Yii::app()->user->isGuest,
                    //        'itemOptions'=>array('class'=>'rtr'),  
                    //    ),
                    //
                    //)
                ),
            
                array(
                    'label' => '<i class="fa fa-user"></i> '.Yii::app()->getModule('user')->t("Please Sign in"),
                    'url' => Yii::app()->getModule('user')->loginUrl,
                    'visible' => Yii::app()->user->isGuest,
                    'itemOptions'=>array('class'=>'rtr'),  
                ),
            
                array(
                    'label' => '<i class="fa fa-user"></i> '.Yii::app()->getModule('user')->t("Register"),
                    'url' => Yii::app()->getModule('user')->registrationUrl,
                    'visible' => Yii::app()->user->isGuest,
                    'itemOptions'=>array('class'=>'rtr'),  
                ),
            
                //array(  
                //    'label' => '<i class="fa fa-user"></i> '.Yii::app()->getModule('user')->t("Profile"),
                //    'url' => Yii::app()->getModule('user')->profileUrl,
                //    'visible' => !Yii::app()->user->isGuest,
                //    'itemOptions'=>array('class'=>'rtr'),  
                //),
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
                array(  
                    //'label' => '<i class="fa fa-language"></i> ',
                    'label' => CHtml::image($baseUrl.'/images/icon_flags/' . strtolower(Yii::app()->language) . '.png', strtoupper(Yii::app()->language), array('style'=>'height:18px')),
                    'url' => '#',
                    'itemOptions'=>array('class'=>'lang-selector lang-selected-current','style'=>'display:block'),  
                    'submenuOptions'=>array('class'=>'nav-sub'),
                    'items'=>array(
                        array(
                            'label'=>CHtml::image($baseUrl.'/images/icon_flags/en.png', 'EN', array()).' English', 
                            'url'=>array('','lang'=>'en'),
                            'itemOptions'=>array('class'=>'lang'),
                        ),
                        array(
                            'label'=>CHtml::image($baseUrl.'/images/icon_flags/fr.png', 'FR', array()).' French', 
                            'url'=>array('','lang'=>'fr'),
                            'itemOptions'=>array('class'=>'lang'),
                        ),
                        array(
                            'label'=>CHtml::image($baseUrl.'/images/icon_flags/de.png', 'DE', array()).' German', 
                            'url'=>array('','lang'=>'de'),
                            'itemOptions'=>array('class'=>'lang'),
                        ),
                    )
                    
                ),

////////////////////////////////////////////////////////////////////////////////      
////////////////////////////////////////////////////////////////////////////////
                array(
                    'label'=>'<i class="fa fa-gavel"></i> Admin', 
                    'url' => 'javascript:void(0)',
                    'submenuOptions'=>array('class'=>'nav-sub'),
                    'itemOptions'=>array('class'=>'rtr'),    
                    //'visible' => $this->checkRoleAvailability('Admin')
                    //            ||$this->checkRoleAvailability('SysAdmin')
                    //            ||$this->checkRoleAvailability('Org_Admin'),
                    'visible' => !Yii::app()->user->isGuest,
                    'items'=>array(
                        
                        array(  
                            'label' => '<i class="fa fa-user"></i> '.Yii::app()->getModule('user')->t("Profile"),
                            'url' => Yii::app()->getModule('user')->profileUrl,
                            'visible' => !Yii::app()->user->isGuest,
                        ),
                        
                        array(
                            'label'=>'<i class="fa fa-life-ring"></i> Admin Settings',
                            'url' =>array('/settings/index'),
                            //'visible' => $this->visibilityMenuItem('settings','index'),
                        ),                     
                    )
                ), 
           

////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////   
        ),
)); 
?>