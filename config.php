<?php

require_once 'vendor/autoload.php';

if (!session_id())
{
    session_start();
}

// Call Facebook API

$facebook = new \Facebook\Facebook([
  'app_id'      => '588445199458514',
  'app_secret'     => '3b65dc87fa82a552f9d9d59c842a7abc',
  'default_graph_version'  => 'v2.10'
]);

?>