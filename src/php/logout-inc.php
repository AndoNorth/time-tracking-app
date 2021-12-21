<?php
session_start();
session_unset();
unset($_COOKIE['userid']);
session_destroy();
header('location: /');
exit();
?>