<?php

/*
FACEBOOK AUTH - Logout
Author: Roosa Kontinen, 2022.
--------------

Destroying session
*/

session_destroy();

header('location:index.php');

?>