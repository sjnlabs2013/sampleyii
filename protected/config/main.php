<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
        'timeZone'=>'Australia/Melbourne',
        'theme'=>'mytheme',
	// preloading 'log' component
	'preload'=>array('log'),
    
        'sourceLanguage'=>'en',
        'language' => 'en',    

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.modules.user.models.*', //user module 
                'application.modules.user.components.*', //user module			
                'application.modules.rights.*',	//rights module
                'application.modules.rights.components.*', //rights module
	),

	'modules'=>array(
            
                'user'=>require(dirname(__FILE__).'/module_user.php'),
                'rights'=>require(dirname(__FILE__).'/module_rights.php'),
            
		// uncomment the following to enable the Gii tool
		/**/
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		/**/
	),

	// application components
	'components'=>array(
            
                'user'=>require(dirname(__FILE__).'/components_user.php'),
                'authManager'=>require(dirname(__FILE__).'/components_authManager.php'),

                'request' => array(
                    'class' => 'application.components.JHttpRequest',
                    'enableCsrfValidation' => true,
                    'enableCookieValidation' => true,
                    'csrfTokenName' => 'JSECURITYTOKEN',
                ),
            
                //'session' => array(
                //    'timeout' => 10800, //3 Hours
                //),
                'session' => array (
                    'class' => 'system.web.CDbHttpSession',
                    'connectionID' => 'db',
                    'sessionTableName' => 'session',
                    'sessionName' => 'ZOBJ',
                    'timeout' => 31600, //6 Hours
                ), 
            
            
		// uncomment the following to enable URLs in path-format
		/**/
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/**/

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),
                'db2'=>require(dirname(__FILE__).'/database2.php'),

		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/**/
				array(
					'class'=>'CWebLogRoute',
                                        //'levels' => 'error, warning, trace, info',
                                        'levels' => 'error',
				),
				/**/
			),
		),
            
//'messages'=>array(
//    //'class'=>'CGettextMessageSource',
//    //'useMoFile' => false,
//
//    'class'=>'CDbMessageSource',
//    'cacheID'=>'cache',
//    'cachingDuration'=>43200, // 12 hours
//    'connectionID'=>'db',
//    'sourceMessageTable'=>'i18n_source_message',
//    'translatedMessageTable'=>'i18n_translated_message',
//),

	),

	'params'=>require(dirname(__FILE__).'/params.php'),
);
