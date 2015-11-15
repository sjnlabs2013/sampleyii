<?php
return array( 
    'superuserName'=>'AdminRole', // Name of the role with super user privileges. 
    'authenticatedName'=>'Authenticated', // Name of the authenticated user role. 
    'userIdColumn'=> 'id', // Name of the user id column in the database. 
    'userNameColumn'=> 'username', // Name of the user name column in the database. 
    'enableBizRule'=>true, // Whether to enable authorization item business rules. 
    'enableBizRuleData'=>true, // Whether to enable data for business rules. 
    'displayDescription'=>true, // Whether to use item description instead of name. 
    'flashSuccessKey'=>'RightsSuccess', // Key to use for setting success flash messages. 
    'flashErrorKey'=>'RightsError', // Key to use for setting error flash messages. 
    //'install'=>true, // Whether to install rights. 
    'baseUrl'=>'/rights', // Base URL for Rights. Change if module is nested. 
    'layout'=>'rights.views.layouts.main', // Layout to use for displaying Rights. 
    //'appLayout'=>'application.views.layouts.main', // Application layout. 		
    'appLayout'=>'//layouts/column2', 	
    //'cssFile'=>'/rights.css', // Style sheet file to use for Rights.
    'cssFile'=>'/themes/mytheme/css/main.css', // Style sheet file to use for Rights.
    'install'=>false, // Whether to enable installer. 
    'debug'=>false, // Whether to enable debug mode. 
);