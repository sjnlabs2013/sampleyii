<?php /* @var $this Controller */ ?>
<?php

$baseUrl = Yii::app()->request->baseUrl;
$themeUrl = Yii::app()->theme->baseUrl;
$cs = Yii::app()->clientScript;

$request = Yii::app()->getRequest();

$ctrl = Yii::app()->controller->id;
$act = Yii::app()->controller->action->id;

$cs->registerCoreScript('jquery')
   ->registerCoreScript('jquery.ui')    
   ->registerScriptFile($baseUrl.'/lib/alertify/lib/alertify.min.js',CClientScript::POS_HEAD)
   ->registerScriptFile($baseUrl.'/lib/jquery.ui.touch-punch.min.js',CClientScript::POS_HEAD)
   //->registerScriptFile($baseUrl.'/lib/alertify/alertify.min.js',CClientScript::POS_HEAD)
   ->registerScript('myHideEffect','$(".flashes").animate({opacity: 1.0}, 60000).fadeOut("slow");',CClientScript::POS_READY)
   ->registerScript('myHelper','$(".helpers-link").on("click",function(){ $(".helper").toggle(); return false; });')
   //->registerScript('myLang','$(".lang").on("click",function(){ $(".helper").toggle(); return false; });')
;

//$cs->scriptMap['jquery.js'] = false;
$cs->registerCssFile($themeUrl.'/css/nav.css');

//Yii::app()->bootstrap->register(); 

$roleName = '';

if(Yii::app()->user->isGuest){
    $roleName = 'Guest';
} else {
    $roles = $this->getRoles(Yii::app()->user->id);
    if(is_array($roles)&&count($roles)>0){        
        $roleName = implode(',',$roles);       
    } else {
        $roleName = 'Authenticated';
    }    
}

?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo $themeUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo $themeUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo $themeUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo $themeUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $themeUrl; ?>/css/form.css" />
        
        <?php /** <link rel="stylesheet" href="<?php echo $themeUrl; ?>/css/social.css" /> */ ?>
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>/lib/font-awesome/css/font-awesome.min.css" />
        
        <?php /** */ ?>
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>/lib/alertify/themes/alertify.core.css" />
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>/lib/alertify/themes/alertify.default.css" />
        <?php /** */ ?>
        
        <?php /** <link rel="stylesheet" href="<?php echo $baseUrl; ?>/lib/alertify/css/alertify.min.css"/>
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>/lib/alertify/css/themes/default.min.css"/>
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>/lib/alertify/css/themes/semantic.min.css"/>
        <link rel="stylesheet" href="<?php echo $baseUrl; ?>/lib/alertify/css/themes/bootstrap.min.css"/> */ ?>     
                
        <link rel="shortcut icon" href="<?php echo $baseUrl; ?>/favicon.ico" type="image/x-icon" />
        
        <link href="<?php echo $baseUrl; ?>/apple-touch-icon.png" rel="apple-touch-icon" /><?php /**57x57*/?>
        <link href="<?php echo $baseUrl; ?>/apple-touch-icon-76x76.png" rel="apple-touch-icon" sizes="76x76" />
        <link href="<?php echo $baseUrl; ?>/apple-touch-icon-120x120.png" rel="apple-touch-icon" sizes="120x120" />
        <link href="<?php echo $baseUrl; ?>/apple-touch-icon-152x152.png" rel="apple-touch-icon" sizes="152x152" />
        <link href="<?php echo $baseUrl; ?>/apple-touch-icon-180x180.png" rel="apple-touch-icon" sizes="180x180" />
        <link href="<?php echo $baseUrl; ?>/icon-hires.png" rel="icon" sizes="192x192" />
        <link href="<?php echo $baseUrl; ?>/icon.png" rel="icon" sizes="128x128" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">
	<div id="mainmenu">
        <?php require(dirname(__FILE__).'/menu.php') ?>
	</div><!-- mainmenu -->
        
        <?php /*if($ctrl=='time'||$ctrl=='otherTask'){ ?>
        <?php } else { ?>
	<div id="header">
            <div id="logo" title="<?php echo CHtml::encode(Yii::app()->name) ?>">
                    <?php //echo CHtml::encode(Yii::app()->name); ?>
                    <?php echo CHtml::image(Yii::app()->request->getBaseUrl(true).'/images/logo.png',Yii::app()->name,array('style'=>'height:50px')) ?>
                </div>
	</div><!-- header -->
        <?php } */?>
        
        <?php 
        if(isset($this->breadcrumbs)):
            $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links'=>$this->breadcrumbs,
                    'homeLink'=>CHtml::link('Home', Yii::app()->homeUrl), 
            ));
        endif;        
         ?><!-- breadcrumbs -->
 
        <div id="global-flashes" class="flashes">        
        <?php
            foreach(Yii::app()->user->getFlashes() as $key => $message) {
                echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
            }
        ?>   
        </div>
	<?php echo $content; ?>
	<div class="clear"></div>
</div><!-- page -->

<?php 
//if(YII_DEBUG && !Yii::app()->user->isGuest){ 
if(!Yii::app()->user->isGuest){ 
?>
<marquee class="notice-s2324"><?php echo CHtml::encode(Yii::app()->name) ?> IS IN DEVELOPMENT MODE</marquee>
<div id="footer-1">
    DEBUG MODE: <?php echo YII_DEBUG?'ON':'OFF'?> 
    USER: #<?php echo Yii::app()->user->id ?> <?php echo Yii::app()->user->name ?>
    ROLE: <?php echo $roleName ?> 
    TRACE LEVEL: <?php echo YII_TRACE_LEVEL ?> 
    SESSION TIMEOUT: <?php echo Yii::app()->session->timeout ?> 
    <?php echo date('Y-m-d H:i:s') ?>
</div>
<?php } ?>

<div id="footer">
Copyright &copy;  
<a href="<?php echo Yii::app()->params['companyUrl'] ?>" target="_blank"><?php echo CHtml::encode(Yii::app()->params['company']) ?> </a>
<?php echo date('Y'); ?> 
&nbsp;&nbsp;&nbsp; 
<?php echo Yii::app()->params['applicationName'] ?> 
&nbsp;
<?php if(isset(Yii::app()->params['applicationVersion'])){ echo 'Release V '.Yii::app()->params['applicationVersion']; } ?> 
<?php //echo CHtml::image(Yii::app()->request->getBaseUrl(true).'/images/logo.png',Yii::app()->name,array('style'=>'height:8px')) ?> 
<?php /** &nbsp;&nbsp;&nbsp; Developed by <a href="<?php echo Yii::app()->params['developerUrl'] ?>" target="_blank"><?php echo Yii::app()->params['developer'] ?></a>.  */ ?>

&nbsp;&nbsp;&nbsp; 
All Rights Reserved.
<?php //echo Yii::powered(); ?>
</div><!-- footer -->

<?php
//if(!Yii::app()->user->isGuest){
//    $this->widget('ext.timeout-dialog.ETimeoutDialog', array(
//        'dialog_width'=>'425',
//        'timeout' => Yii::app()->getSession()->getTimeout(),
//        'keep_alive_url' => $this->createUrl('/user/user/keepAlive'),
//        'logout_redirect_url' => $this->createUrl('/user/logout'),
//    ));
//}
?>
<?php /**<script src="<?php echo $baseUrl; ?>/lib/jquery.ui.touch-punch.min.js"></script>*/ ?>
<script src="<?php echo $baseUrl; ?>/lib/j.js"></script>
</body>
</html>
