<?php
return array(
    'class'=>'RDbAuthManager',
    'connectionID'=>'db',
    'defaultRoles'=>array('Authenticated', 'Guest'),
    'itemTable' => 'rights_auth_item',
    'itemChildTable' => 'rights_auth_item_child',
    'assignmentTable' => 'rights_auth_assignment',
    'rightsTable' => 'rights',
);