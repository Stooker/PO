<?php

// Make your 'config.php' file based on this

$db_address = '';
$db_port = '';

return array(
    'DbConncection' => "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = " . $db_address . ")(PORT = " . $db_port . ")))(CONNECT_DATA=(SID=orcl)))",
    'db_user' => '',
    'db_password' => ''
);