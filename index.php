<?php

//index.php

include('config.php');

$facebook_output = '';

$facebook_helper = $facebook->getRedirectLoginHelper();

if(isset($_GET['code']))
{
 if(isset($_SESSION['access_token']))
 {
  $access_token = $_SESSION['access_token'];
 }
 else
 {
  $access_token = $facebook_helper->getAccessToken();

  $_SESSION['access_token'] = $access_token;

  $facebook->setDefaultAccessToken($_SESSION['access_token']);
 }

 $_SESSION['user_id'] = '';
 $_SESSION['user_name'] = '';
 $_SESSION['user_email_address'] = '';
 $_SESSION['user_image'] = '';

 $graph_response = $facebook->get("/me?fields=name,email", $access_token);

 $facebook_user_info = $graph_response->getGraphUser();

 if(!empty($facebook_user_info['id']))
 {
  $_SESSION['user_image'] = 'http://graph.facebook.com/'.$facebook_user_info['id'].'/picture';
 }

 if(!empty($facebook_user_info['name']))
 {
  $_SESSION['user_name'] = $facebook_user_info['name'];
 }

 if(!empty($facebook_user_info['email']))
 {
  $_SESSION['user_email_address'] = $facebook_user_info['email'];
 }
 
}
else
{
 // Get login url
    $facebook_permissions = ['email']; // Optional permissions
    
    $local = 'http://localhost/facb/index.php'; //Place your address.
    $facebook_login_url = $facebook_helper->getLoginUrl($local, $facebook_permissions);
    
    // Render Facebook login button
    $facebook_login_url = '<a href="'.$facebook_login_url.'"><button type="button" class="btn btn-primary btn-lg btn-block">Kirjaudu sisään</button></a>';
}



?>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Facebook Login</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
 </head>
 <body>
 <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/fi_FI/sdk.js#xfbml=1&version=v14.0&appId=795798638116045&autoLogAppEvents=1" nonce="IXHgMayE"></script>
  <div class="container">
   <br />
   <h2 style="align:center">Facebook Login</h2>
   <br />
   <div class="panel panel-default">
    <?php 
    if(isset($facebook_login_url))
    {
     echo $facebook_login_url;
    }
    else
    {
     echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
     echo '<img src="'.$_SESSION["user_image"].'" class="img-responsive img-circle img-thumbnail" />';
     echo '<h3><b>Name :</b> '.$_SESSION['user_name'].'</h3>';
     echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
     echo '<h3><b>Token :</b> '.$_SESSION['access_token'].'</h3>';
     echo '<h3><a href="logout.php">Logout</h3></div>';
    }
    ?>
   </div>
  </div>
 </body>
</html>
