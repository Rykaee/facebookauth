<?php

/*
FACEBOOK AUTH - Config file.
Author: Roosa Kontinen, 2022.
--------------

Add your App ID, App Secret
*/

require_once 'vendor/autoload.php';

if (!session_id())
{
    session_start();
}

// Call Facebook API
// Need to paste App ID, App Secret

$facebook = new \Facebook\Facebook([
  'app_id'      => '',
  'app_secret'     => '',
  'default_graph_version'  => 'v2.10'
]);

?>