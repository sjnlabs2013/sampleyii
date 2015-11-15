<?php
return array(                    
    'hash' => 'md5',
    'tableUsers' => 'user',
    'tableProfiles' => 'user_profile',
    'tableProfileFields' => 'user_profile_field',

    'registrationUrl' => array('/user/registration'),
    'recoveryUrl' => array('/user/recovery'),
    'loginUrl' => array('/user/login'),
    
    //'returnUrl' => array('/user/profile'),
    'returnUrl' => array('/time/timeline'),
    
    'returnLogoutUrl' => array('/user/login'),
    'captcha' => array('registration'=>false),
);