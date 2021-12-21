<?php
session_start();
session_unset();
setcookie("userid",'',time()-3600,'/','.andonorth.xyz');
session_destroy();
header('location: /');
exit();
?>